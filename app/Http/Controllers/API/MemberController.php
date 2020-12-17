<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class MemberController extends Controller
{
    public function member($id)
    {
        return Project::with('project_member.user')->where('id', $id)->firstOrFail();
    }
}
