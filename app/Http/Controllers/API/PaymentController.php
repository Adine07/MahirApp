<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment($id)
    {
        return Project::with('payment.payment_detail.user')->where('id', $id)->firstOrFail();
    }

    public function paymentCash($id)
    {
        return Project::with('payment.cash')->where('id', $id)->firstOrFail();
    }

    public function fullpay($id)
    {
        $fullpay = Payment::with('payment_detail')->where('project_id', $id)->get();
        $payed = 0;

        foreach ($fullpay as $pay) {
            $payed = $payed + $pay->nominal;
        }

        $fullpayed = ['payed' => $payed];

        return json_encode($fullpayed);
    }
}
