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
        'price',
        'start',
        'finish',
        'description',
    ];

    public function client(){
        return $this->belongsToMany(Client::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function client_project(){
        return $this->hasMany(ClientProject::class);
    }

    public function project_member(){
        return $this->hasMany(ProjectMember::class);
    }
}
