<?php

namespace App\Http\Controllers;

use App\Exports\dataexport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Smalot\PdfParser\Config;
use Smalot\PdfParser\Parser;

class extractpdfcontroller extends Controller
{
    public function extractpdf(Request $request){
    $request->validate([
    'extract' => 'required|array|min:1|max:5',
    'extract.*' => 'required|file|mimes:pdf|max:10240',
    ]);
    // Custom config: Recommended when parsing PDFs from untrusted sources
    $config = new Config();
    $parser = new Parser([], $config);
    try {
    $extracteddata = [];
    foreach($request->extract as $pdf){
    $document = $parser->parseFile($pdf);
    $extracteddata[] =  $document->getText();
    }
    return view("pdf-extracted-data",['extracteddata' => $extracteddata]);
    }catch(Exception $e){
    return back()->withErrors(['extract' => 'PDF secured or could not be parsed. Please upload an accessible PDF.']);
    }
    




    // if($extracteddata){
    //     preg_match_all('/#?(\d{4,})\s+(.+?)\s+([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,})\s+(\d{1,2})\s+([\d,]+)\s+([\d,]+)\s+(\d{1,3}(?:\.\d+)?%)/i',
    //     $extracteddata,$matches,PREG_SET_ORDER);
    //     $students = [];
    //     foreach($matches as $match){
    //     $students[] = [$match[1],trim($match[2]),(int)$match[3]];
    //     }
    //     if($students){
    //     return Excel::download(new dataexport($students),'data-file.xlsx');
    //     }else{
    //     return back()->withErrors(['getexcel' => 'Cannot download Excel file.']);
    //     }
        
    // }
    
        
    }
}
