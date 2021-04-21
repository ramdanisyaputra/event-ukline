<?php

namespace App\Exports;

use App\Models\ExamQuestion;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportQuestion implements FromCollection, WithHeadings
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
		$question = ExamQuestion::where('exam_id', $this->examId)->get();
		$tempStorage = [];
		foreach ($question as $key => $question) {
			$tempStorage[$key] = [
				'question' => $question->question,
				'poin' => $question->poin,
				'question_type' => $question->question_type,
			];

			$option_columns = [
				'A' => 'opsi_a', 
				'B' => 'opsi_b', 
				'C' => 'opsi_c', 
				'D' => 'opsi_d', 
				'E' => 'opsi_e'
			];
			
			$options = [];
			if ($question->question_type == 'PG') {
				
				foreach ($option_columns as $alpha => $option_column) {
					$options[$option_column] = ((Array) json_decode($question->option))[$alpha] ?? '';
				}
			} else {
				foreach ($option_columns as $alpha => $option_column) {
					$options[$option_column] = '';
				}
			}
			
			$tempStorage[$key] = array_merge($tempStorage[$key], $options);
			$tempStorage[$key]['answer'] = $question->answer;
		}

		return collect($tempStorage);
	}

	public function headings(): array
	{
		return [
			'Soal',
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
