<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'payment_id', 'nominal', 'image'];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function payment(){
        return $this->belongsTo(Payment::class)->withTrashed();
    }
}
