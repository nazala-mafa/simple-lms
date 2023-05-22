<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Master\Entities\School;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::all();
        return dd($school);
    }

    public function show($slug)
    {
        $school = School::where('slug', $slug)->firstOrFail();

    }
}