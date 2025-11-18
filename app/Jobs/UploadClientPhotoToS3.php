<?php

namespace App\Jobs;

use App\Models\DataClients;
use Aws\S3\S3Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class UploadClientPhotoToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $clientId;
    protected $tempPath;

    public function __construct($clientId, $tempPath)
    {
        $this->clientId = $clientId;
        $this->tempPath = $tempPath;
    }

    public function handle(): void
    {
        $client = DataClients::find($this->clientId);
        if (!$client || !file_exists($this->tempPath)) return;

        $filename = 'client_photos/foto_depan_' . Str::uuid() . '.' . pathinfo($this->tempPath, PATHINFO_EXTENSION);

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => config('filesystems.disks.s3.region'),
            'endpoint' => config('filesystems.disks.s3.endpoint'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
            'use_path_style_endpoint' => config('filesystems.disks.s3.use_path_style_endpoint'),
        ]);

        try {
            $result = $s3->putObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $filename,
                'Body'   => fopen($this->tempPath, 'r'),
                'ACL'    => 'public-read',
                'ContentType' => mime_content_type($this->tempPath),
                'ContentDisposition' => 'inline',
            ]);

            @unlink($this->tempPath);
            $client->update(['foto_depan' => $result['ObjectURL']]);
        } catch (\Exception $e) {
            // kamu bisa log jika mau
        }
    }
}
