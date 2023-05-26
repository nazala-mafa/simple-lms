<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Modules\Master\Entities\School;
use Modules\School\Entities\SchoolOption;

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
        $data = [
            'school' => $school,
            'option' => function ($key, $default) use ($school) {
                return SchoolOption::getOption($school->id, $key, $default);
            }
        ];

        return view('school.show.' . SchoolOption::getOption($school->id, 'template', 'template-1'), $data);
    }
}