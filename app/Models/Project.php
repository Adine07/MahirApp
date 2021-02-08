<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_name',
        'status',
        'price',
        'start',
        'finish',
        'description',
    ];

    public function client(){
        return $this->belongsToMany(Client::class)->withTrashed();
    }

    public function user(){
        return $this->belongsToMany(User::class)->withTrashed();
    }

    public function client_project(){
        return $this->hasOne(ClientProject::class)->withTrashed();
    }

    public function project_member(){
        return $this->hasMany(ProjectMember::class)->withTrashed();
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
