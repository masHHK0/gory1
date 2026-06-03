<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::available()->get();
        return view('instructors.index', compact('instructors'));
    }
    
    public function show(Instructor $instructor)
    {
        return view('instructors.show', compact('instructor'));
    }
}