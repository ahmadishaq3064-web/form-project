<?php

namespace App\Http\Controllers;

use Smalot\PdfParser\Config;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;

class extractpdfcontroller extends Controller
{
    public function extractpdf(Request $request){
    $request->validate([
    'extract' => 'required|file|mimes:pdf|max:2048',
    ]);
    // Custom config: Recommended when parsing PDFs from untrusted sources
    $config = new Config();
    $parser = new Parser([], $config);
    $document = $parser->parseFile($request->extract);
    $extracteddata =  $document->getText();
    return view('extracted-pdf-data',['extracteddata' => $extracteddata]);
    }
}
