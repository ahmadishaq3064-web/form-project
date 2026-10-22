<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class dataexport implements FromArray , WithHeadings
{
    protected $students;
    public function __construct(array $students){
    $this->students = $students; 
    }
    public function headings():array{
    return ['Roll Number','Name','Age'];
    }
    public function array():array{
    return $this->students;
    }
}
