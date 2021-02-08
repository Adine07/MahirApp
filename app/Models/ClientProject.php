<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'client_id'
    ];

    public function client(){
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function project(){
        return $this->belongsTo(Project::class)->withTrashed();
    }
}
