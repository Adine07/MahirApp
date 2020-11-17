<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'company_name',
        'provinces_id',
        'cities_id',
        'districts_id',
        'villages_id',
        'address',
    ];

    public function projects(){
        return $this->belongsToMany(Project::class);
    }

    public function client_project(){
        return $this->hasMany(ClientProject::class);
    }
}
