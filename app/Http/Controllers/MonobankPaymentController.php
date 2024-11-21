<?php

namespace App\Http\Controllers;

use App\Mail\MonobankPaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MonobankPayment;
use Illuminate\Support\Facades\Mail;

class MonobankPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {


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
                $email = env('MAIL_TO_ADDRESS');
                Mail::to($email)->queue(new MonobankPaymentMail($reference, $amount, $destination));
            }
        }

    }
}
