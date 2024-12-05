<?php

namespace App\Http\Controllers\Api\v1;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RazorpayController extends Controller
{
    public function index()
    {
        return view('razorpay');
    }
    public function store()
    {
        return "Payment success";
    }

    public function webhookStore(Request $request)
    {
        try {
            $webhookSecret = env('WEBHOOK_SECRET_KEY');
            $webhookSignature = $request->header('X-Razorpay-Signature');
            Log::info("webhookSignature :" . $webhookSignature);
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $data = json_encode($request->all());
            Log::info("data: ". $data);
            Log::alert("Event ".$request->event);
            // $request->payload->payment->id
            $api->utility->verifyWebhookSignature($data, $webhookSignature, $webhookSecret);
        } catch (\Exception $th) {
            Log::error($th->getMessage());
        }
        return Response::json(true);
    }
}
