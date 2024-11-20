<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MonobankPayment;

class MonobankPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       Log::info('Webhook payload:', $request->json()->all());

        $invoiceId = $request->invoiceId;
        $status = $request->status;
        $amount =  (int)substr($request->amount, 0, -2);
        $reference = $request->reference;
        $destination = $request->destination;

        $payment = MonobankPayment::where('invoiceId', $invoiceId)->first();
        if (is_null($payment)) {
                MonobankPayment::create([
                    'invoiceId' => $invoiceId,
                    'status' => $status,
                    'amount' => $amount,
                    'reference' => $reference,
                    'destination' => $destination
                ]);
        }
        else {
            $payment->update([
                'status' => $status,
            ]);
            if ($payment->status == 'success') {
                Log::info('Webhook Success:');
            }
        }

    }
}
