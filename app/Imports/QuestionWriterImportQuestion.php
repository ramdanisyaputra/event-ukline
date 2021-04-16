<?php

namespace App\Imports;

use App\Models\ExamQuestion;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionWriterImportQuestion implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $examId;
    function __construct($examId)
    {
        $this->examId = $examId;
    }

    public function collection(Collection $rows)
    {
        $questions = [];
        foreach ($rows as $key => $row) 
        {
            if($key != 0){
                $question = $row[0];
                $questionFile = $row[1];
                $poin = $row[2];
                $questionType = $row[3];
                $option = null;
                $answer = $row[9];

                if (strtoupper($questionType) == "PG") {
                    $option = [];
                    for ($i=4; $i <= 8; $i++) {
                        if ($row[$i] !== null)
                        {
                            $option[] = $row[$i];
                        }
                        $answer = trim(strtoupper($answer));
                    }

                    if(count($option) < 4)
                    {
                        throw new Exception("Error");
                    }

                    $option = json_encode($option);
                } elseif (strtoupper($questionType) !== "ESAI") {
                    throw new Exception("Error");
                }

                $questions[] = [
                    'exam_id' => $this->examId,
                    'question' => $question,
                    'question_file' => $questionFile,
                    'poin' => $poin,
                    'question_type' => $questionType,
                    'answer' => trim(strtoupper($answer)),
                    'option' => $option,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        return DB::table('exam_questions')->insert($questions);
    }
}
