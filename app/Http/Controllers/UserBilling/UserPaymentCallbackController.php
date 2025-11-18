<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\DataBilling;
use App\Jobs\JobEmailTaxPaid;

class UserPaymentCallbackController extends Controller
{
    protected $privateKey;

    public function __construct()
    {
        // Ambil private key dari config (bukan env)
        $this->privateKey = config('services.tripay.private_key');
    }

    public function handle(Request $request)
    {
        // ======== Validasi Signature ========
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();

        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ], 403);
        }

        // ======== Validasi Event ========
        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event',
            ], 400);
        }

        // ======== Decode payload JSON ========
        $data = json_decode($json);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid JSON payload',
            ], 422);
        }

        // Ambil data penting
        $merchantRef = $data->merchant_ref ?? null;
        $reference   = $data->reference ?? null;
        $status      = strtoupper($data->status ?? 'UNPAID');

        // ======== Cari Billing ========
        $billing = DataBilling::where('merchant_ref', $merchantRef)
            ->where('reference', $reference)
            ->first();

        if (!$billing) {
            return Response::json([
                'success' => false,
                'message' => 'DataBilling not found or already updated',
            ], 404);
        }

        // ======== Update Status Pembayaran ========
        switch ($status) {

            case 'PAID':
                $billing->status       = $status;
                $billing->billing_paid = now();
                $billing->save();

                // Kirim email menggunakan queue khusus
                JobEmailTaxPaid::dispatch($billing->id)->onQueue('emails');
                break;

            case 'EXPIRED':
            case 'FAILED':
                $billing->status = $status;
                $billing->save();
                break;

            default:
                return Response::json([
                    'success' => false,
                    'message' => 'Unrecognized payment status',
                ], 422);
        }

        return Response::json(['success' => true], 200);
    }
}
