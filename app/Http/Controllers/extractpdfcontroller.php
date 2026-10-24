<?php

namespace App\Http\Controllers;

use App\Exports\dataexport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat ;
use Smalot\PdfParser\Config;
use Smalot\PdfParser\Parser;
use ZipArchive;

class extractpdfcontroller extends Controller
{
    public function extractpdf(Request $request){
    $request->validate([
    'extract' => 'required|array|min:1|max:5',
    'extract.*' => 'required|file|mimes:pdf|max:10240',
    ]);
    try {
    // Custom config: Recommended when parsing PDFs from untrusted sources
    $config = new Config();
    $parser = new Parser([], $config);
    $extracteddata = [];
    $students = [];
    foreach($request->extract as $pdf){
    $document = $parser->parseFile($pdf);
    $extracteddata =  $document->getText();
    preg_match_all('/#?(\d{4,})\s+(.+?)\s+([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,})\s+(\d{1,2})\s+([\d,]+)\s+([\d,]+)\s+(\d{1,3}(?:\.\d+)?%)/i',
    $extracteddata,$matches,PREG_SET_ORDER);
    foreach($matches as $match){
    $students[] = [
        "roll_no" => $match[1],
        "name" => trim($match[2]),
        "email" => $match[3],
        "age" => (int) $match[4],
        "total" => (int) str_replace(',', '', $match[5]),
        "obtained" => (int) str_replace(',', '', $match[6]),
        "percentage" => (float) $match[7]];
    }
    }
    if(empty($students)){
    return back()->withErrors(['extract' => 'No Data Found.']);
    }
    // array_column() ky zariye hum ny age wali key ko uthaya aur array_count_values() count krta hai ky konsi value kitnio dafa repeat huii hai 
    $agecount = array_count_values(array_column($students,'age'));
    $commonagecount = [];
    $uniqueagecount = [];
    foreach($students as $student){
    $age = $student['age'];
    // agr student ki age ek sy ziada hai to usko $commonagecount[] me store karwa diya hai
    if($agecount[$age] > 1){
    $commonagecount[] = $student;
    }else{
    $uniqueagecount[] = $student;
    }
    }
    $commonagecount = collect($commonagecount)->sortBy('age')->values()->all();
    $uniqueagecount = collect($uniqueagecount)->sortBy('age')->values()->all();
    $zippath = storage_path('app/students-report-'.time().'.zip');
    $zip = new ZipArchive();
    $zip->open($zippath, ZipArchive::CREATE);
    $commonagefile = Excel::raw(new dataexport($commonagecount),ExcelFormat::XLSX);
    $zip->addFromString('Common-Students-Age.xlsx',$commonagefile);
    $uniqueagefile = Excel::raw(new dataexport($uniqueagecount),ExcelFormat::XLSX);
    $zip->addFromString('Unique-Students-age.xlsx',$uniqueagefile);
    $zip->close();
    return response()->download($zippath,'students-report.zip')->deleteFileAfterSend(true);
    }catch(Exception $e){
    return back()->withErrors(['extract' => 'PDF secured or could not be parsed. Please upload an accessible PDF.']);
    }    
    }
}
