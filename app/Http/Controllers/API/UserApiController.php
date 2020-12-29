<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\User;
use App\Models\ProjectMember;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function active($id)
    {
        return ProjectMember::with('project')->where('user_id', $id)->whereHas('project', function($status){
            $status->where('status', 'on-progress');
        })->get();
    }

    public function history($id)
    {
        return ProjectMember::with('project.payment.payment_detail')->where('user_id', $id)->whereHas('project', function($status){
            $status->where('status', 'done')->whereHas('payment', function($paymentdetail){
                $paymentdetail->whereHas('payment_detail', function($userid){
                    $userid->where('user_id', '=', 1);
                });
            });
        })->get();
    }

    public function totin($id)
    {
        $data = PaymentDetail::with('payment.project')->where('user_id', $id)->whereHas('payment', function($project){
            $project->whereHas('project', function($status){
                $status->where('status', 'done');
            });
        })->get();

        $income = $data;

        return $income;
    }
}
