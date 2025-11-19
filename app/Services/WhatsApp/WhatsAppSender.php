<?php

namespace App\Services\WhatsApp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\DataClients;

class WhatsAppSender
{
    protected string $apiUrl;
    protected string $token;

    public function __construct()
    {
        $this->apiUrl = rtrim(config('services.whatsapp.api_url'), '/');
        $this->token = config('services.whatsapp.token');
    }

    public function sendText(string $phone, string $message): array
    {
        $payload = [
            'recipient_type' => 'individual',
            'to' => $phone,
            'type' => 'text',
            'text' => [
                'body' => $message,
            ],
        ];

        return $this->sendRequest('/messages', $payload);
    }

    public function sendImage(string $phone, string $caption, string $imageUrl): array
    {
        $payload = [
            'recipient_type' => 'individual',
            'to' => $phone,
            'type' => 'image',
            'image' => [
                'link' => $imageUrl,
                'caption' => $caption,
            ],
        ];

        return $this->sendRequest('/messages', $payload);
    }

    public function sendDocument(string $phone, string $caption, string $documentUrl): array
    {
        $payload = [
            'recipient_type' => 'individual',
            'to' => $phone,
            'type' => 'document',
            'document' => [
                'link' => $documentUrl,
                'caption' => $caption,
            ],
        ];

        return $this->sendRequest('/messages', $payload);
    }

    protected function sendRequest(string $endpoint, array $payload): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl . $endpoint, $payload);

        $status = $response->status();
        $body = $response->json();

        return [
            'status' => $status,
            'data'   => $body,
        ];
    }

    public function sendToClient(DataClients $client, string $message): array
    {
        return $this->sendText($client->no_hp, $message);
    }

    public function sendPaymentSuccess(DataClients $client, string $nominal, string $tagihan): array
    {
        $msg = "Halo {$client->nama},\n\nPembayaran Anda sebesar Rp " . number_format($nominal, 0, ',', '.') . " untuk tagihan {$tagihan} telah kami terima.\n\nTerima kasih telah melakukan pembayaran tepat waktu. 🙏";
        return $this->sendToClient($client, $msg);
    }
}
