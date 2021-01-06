<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Project;
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
        // $data = ProjectMember::with('project')->where('user_id', $id)->whereHas('project', function($status){
        //     $status->where('status', 'done');
        // })->get();

        // $data = ProjectMember::with('project.payment.payment_detail')->where('user_id', $id)->whereHas('project', function($status){
        //     $status->where('status', 'done');
        // })->get();

        $data = PaymentDetail::with('payment.project')->where('user_id', $id)->whereHas('payment.project', function($prjid){
            $prjid->where('status', 'done');
        })->get();

        $dat = [];

        foreach ($data as $index => $d) {
            if (isset($dat[$d->payment->project->project_name])) {
                $dat[$d->payment->project->project_name] += $d->nominal;
            } else {
                $dat += [$d->payment->project->project_name => $d->nominal];
            }
        }

        return $dat;
    }

    public function totin($idprj, $idusr)
    {
        $data = PaymentDetail::with('payment.project')->where('user_id', $idusr)->whereHas('payment.project', function($prjid){
            $prjid->where('status', 'done');
        })->get();

        $data2 = Project::with('payment.payment_detail')->where('status', 'done')->whereHas('payment.payment_detail', function($usrid){
            $usrid->where('user_id', request('idusr'));
        })->get();

        $dat = [];

        foreach ($data as $index => $d) {
            if (isset($dat[$d->payment->project->project_name])) {
                $dat[$d->payment->project->project_name] += $d->nominal;
            } else {
                $dat += [$d->payment->project->project_name => $d->nominal];
            }
        }

        // $income = $data->pluck('nominal')->sum();
        $income = $data->pluck('nominal', 'payment.project.project_name')->all();
        $name = $data->pluck('payment.project.project_name');

        $nama = (array)$name;
        // $hasil = (array)$income->all();
        // $go = array_shift(array_values($nomer));;

        // $dat = array_fill_keys($nama, $hasil);
        // $dat = array_fill_keys($nama, $hasil);

        // $dat = array_merge($nama, $nama);

        // $dat = [$income, $name];
        // $dat = ['mobil' => 1];

        // foreach ($data as $index => $d) {
        //     if ($dat[$d[$index]->project_name]) {
        //         $dat[$d[$index]->project_name] += 
        //     }
        // }

        // if (isset($dat['mobil'])) {
        //     $dat['mobil'] += '2';
        // }else{
        //     $dat += ['sepeda' => 5];
        // }

        // $i = 0;

        // for ($i=0; $i < $name->count() ; $i++) { 
        //     $dat = [$name[$i] => $income[$i]];
        // }

        // foreach ($income as $index => $in) {
        //     $dat = [$name[$index] => $income[$index]];
        // }

        // dd($data2);

        return $nama;
    }
}
