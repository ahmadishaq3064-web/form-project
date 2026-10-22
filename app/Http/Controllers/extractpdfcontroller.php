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
    'extract' => 'required|file|mimes:pdf|max:2048',
    ]);
    // Custom config: Recommended when parsing PDFs from untrusted sources
    $config = new Config();
    $parser = new Parser([], $config);
    try {
    $document = $parser->parseFile($request->extract);
    $extracteddata =  $document->getText();
    }catch(Exception $e){
    return back()->withErrors(['extract' => 'PDF secured or could not be parsed. Please upload an accessible PDF.']);
    }
    $extracteddata =  $document->getText();
    if(empty($extracteddata)){
    return back()->withErrors(['extract' => 'No records were found in the PDF.']);
    }
    if($extracteddata){
        preg_match_all("/#?(\\d{3,})\\s+([A-Za-z][A-Za-z .'-]*?)\\s+(?:[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,}\\s+)?(\\d{1,2})(?=\\s|$)/i",
        $extracteddata,$matches,PREG_SET_ORDER);
        $students = [];
        foreach($matches as $match){
        $students[] = [$match[1],trim($match[2]),(int)$match[3]];
        }
        if($students){
        return Excel::download(new dataexport($students),'data-file.xlsx');
        }else{
        return back()->withErrors(['getexcel' => 'Cannot download Excel file.']);
        }
        
    }
    
        
    }
}
