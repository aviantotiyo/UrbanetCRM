<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\DataBilling;

class UserPaymentCallbackController extends Controller
{
    // URL call back [domain]/api/payment/callback

    protected $privateKey;

    public function __construct()
    {
        $this->privateKey = env('TRIPAY_PRIVATE_KEY');
    }

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ], 403);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event',
            ], 400);
        }

        $data = json_decode($json);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid JSON payload',
            ], 422);
        }

        $merchantRef = $data->merchant_ref ?? null;
        $reference = $data->reference ?? null;
        $status = strtoupper($data->status ?? 'UNPAID');

        // Cari billing yang belum selesai
        $billing = DataBilling::where('merchant_ref', $merchantRef)
            ->where('reference', $reference)
            ->first();

        if (!$billing) {
            return Response::json([
                'success' => false,
                'message' => 'DataBilling not found or already updated',
            ], 404);
        }

        // Update status
        switch ($status) {
            case 'PAID':
                $billing->status = $status;
                $billing->billing_paid = now(); // Set waktu pembayaran
                $billing->save();
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
