<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Master\Entities\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('school.index', compact('schools'));
    }

    public function show($slug)
    {
        $school = School::where('slug', $slug)->firstOrFail();
        return view('school.show', compact('school'));
    }
}