<?php

namespace App\Exports;

use App\Models\ExamQuestion;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminExportQuestion implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $examId;
    function __construct($examId)
    {
        $this->examId = $examId;
    }
    public function collection()
    {
        $question = ExamQuestion::where('exam_id',$this->examId)->get();
		$tempStorage = [];
		$alpa = ['A', 'B', 'C', 'D', 'E'];
		foreach ($question as $key => $question ) {
		$tempStorage[] = [
			'question' => $question->question,
			'question_file' => $question->question_file,
			'poin' => $question->poin,
			'question_type' => $question->question_type,
		];

		if ($question->question_type == "ESAI") {
			$opsi = [];
			for ($i=0; $i < count($alpa); $i++) { 
				$opsi["opsi_$i"] = json_decode($question->option)[$i] ?? '';
			}
			$answer = [];
				$answer["answer_$i"] =$question->answer;
		} elseif ($question->question_type == "PG") {
			$opsi = [];
			for ($i=0; $i < count($alpa); $i++) { 
				$opsi["opsi_$i"] = json_decode($question->option)[$i] ?? '';
			}

			$answer = [];
			for ($i=0; $i < count($alpa); $i++) { 
				$answer["answer_$i"] = '';
			}
			
			$answer["answer_0"] = $question->answer;
		}
			$tempStorage[$key] = array_merge($tempStorage[$key], $opsi);
			$tempStorage[$key] = array_merge($tempStorage[$key], $answer);
		}
		return collect($tempStorage);
    }

    public function headings(): array
    {
    	return [
            'Soal',
    		'Gambar Soal',
    		'Poin',
    		'Tipe Soal',
    		'Opsi A',
    		'Opsi B',
    		'Opsi C',
    		'Opsi D',
            'Opsi E',
            'Jawaban',
    	];
    }
}
