<?php

namespace App\Jobs;

use App\Models\DataClientsSales;
use Aws\S3\S3Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadSalesPhotoToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $salesId;
    protected $pathTemp;

    public function __construct($salesId, $pathTemp)
    {
        $this->salesId = $salesId;
        $this->pathTemp = $pathTemp; // simpan path file sementara
    }

    public function handle(): void
    {
        $sales = DataClientsSales::find($this->salesId);
        if (!$sales || !file_exists($this->pathTemp)) return;

        $filename = 'client_photos/foto_depan_' . Str::uuid() . '.' . pathinfo($this->pathTemp, PATHINFO_EXTENSION);

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
                'Body'   => fopen($this->pathTemp, 'r'),
                'ACL'    => 'public-read',
                'ContentType' => mime_content_type($this->pathTemp),
                'ContentDisposition' => 'inline',
            ]);

            // Hapus file sementara
            @unlink($this->pathTemp);

            $sales->update(['foto_depan' => $result['ObjectURL']]);
        } catch (\Exception $e) {
            // Log error jika perlu
        }
    }
}
