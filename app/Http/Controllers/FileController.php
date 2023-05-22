<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $request->file->store;
    }
}