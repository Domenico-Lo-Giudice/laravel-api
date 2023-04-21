<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $recent_projects = Project::where('is_published', 1)->orderBy('updated_at', 'DESC')->limit(9)->get();
        return view('guest.home', compact('recent_projects'));
    }
}
