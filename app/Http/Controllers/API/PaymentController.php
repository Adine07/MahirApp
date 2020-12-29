<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function store(Request $request)
    {
        // $request->validate([
        //     'income' => 'required|integer',
        //     'cash' => 'required|integer',
        //     'user_id' => 'required',
        //     'nominal' => 'required|integer',
        //     'project_id' => 'required|integer',
        //     'project_name' => 'required|string',
        // ]);

        $payment = Payment::create([
            'nominal' => $request->income,
            'project_id' => $request->project_id,
            'date' => $request->date,
        ]);

        // $describ = "pembayaran project $request->project_name";

        $payment->cash()->create([
            'user_id' => $request->bio,
            'date' => $request->date,
            'income' => $request->cashs,
            'expense' => 0,
            'category' => 'Pembayaran',
            'subject' => $request->project_name,
            'description' => $request->project_name,
        ]);

        for ($i=0; $i < count($request->user_id) ; $i++) { 
            $payment->payment_detail()->create([
                'user_id' => $request->user_id[$i],
                'nominal' => $request->nominal[$i]
            ]);
        }

    }
}
