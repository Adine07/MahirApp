<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','payment_id', 'category', 'income', 'expense', 'subject', 'date', 'description'];
}
