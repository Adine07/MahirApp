<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'nominal',
        'date',
        'image',
        'invoice'
    ];

    public function payment_detail(){
        return $this->hasMany(PaymentDetail::class)->withTrashed();
    }

    public function cash(){
        return $this->hasOne(Kas::class)->withTrashed();
    }

    public function project(){
        return $this->belongsTo(Project::class)->withTrashed();
    }
}
