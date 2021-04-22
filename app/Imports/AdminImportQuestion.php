<?php

namespace App\Imports;

use App\Models\ExamQuestion;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class AdminImportQuestion implements ToCollection
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
                $poin = $row[1];
                $questionType = $row[2];
                $option = null;
                $answer = $row[8];

                if (strtoupper($questionType) == "PG") {
                    $option = [];
                    for ($i=3; $i < 8; $i++) {
                        if ($row[$i] !== null)
                        {
                            $option[] = $row[$i];
                        }
                        $answer = trim(strtoupper($answer));
                    }

                    if(count($option) < 2)
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
