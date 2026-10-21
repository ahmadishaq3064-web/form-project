<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class extractpdfcontroller extends Controller
{
    public function extractpdf(Request $request){
    $request->validate([
    'extract' => 'required|file|mimes:pdf|max:2048',
    ]);

    }
}
