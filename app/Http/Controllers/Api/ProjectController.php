<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
class ProjectController extends Controller
{
    public function index(Request $request){
        $projects = Project::with('type', 'technologies')->paginate(3);
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
