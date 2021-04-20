<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ScoreExport implements FromView
{
    private $class;
    private $exam;

    public function __construct($class,$exam)
    {
        $this->class = $class;
        $this->exam = $exam;
    }
    
    public function view(): View
    {
        return view('school_admin.exams.exam-scores.table', [
            'class' => $this->class,
            'exam' => $this->exam,
        ]);
    }
}