<?php

namespace App\Http\Controllers\Api\v1;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RazorpayController extends Controller
{
    public function webhookStore(Request $request)
    {
        try {
            // validate webhook
            $webhookSecret = 'WEBHOOK_SECRET_KEY';
            $webhookSignature = $request->header('X-Razorpay-Signature');
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $api->utility->verifyWebhookSignature($request->all(), $webhookSignature, $webhookSecret);

            Log::info(json_encode($request->all()));
            Log::alert($request->event);
        } catch (\Exception $th) {
            $errorMessage = $th->getMessage();
        }
    }
}
