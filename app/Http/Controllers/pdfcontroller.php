<?php

namespace App\Http\Controllers;
use App\Models\user;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class pdfcontroller extends Controller
{
    public function createpdf($id){
    $users = user::find($id);
    $pdf = Pdf::loadView('pdf', ['users' => [$users]])->setPaper('a4', 'portrait');
    return $pdf->download('user-'.$id.'.pdf');
    }   
}
