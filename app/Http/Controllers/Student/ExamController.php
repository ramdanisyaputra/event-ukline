<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamScore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function boarding(Exam $exam)
    {
        return view('student.exam.boarding', compact('exam'));
    }

    public function access(Exam $exam, Request $request)
    {
        if ($exam->access_code == $request->access_code) {
            $current_exams = [];
            if (session()->has('current_exams')) {
                $current_exams = session()->get('current_exams');
            }

            $randomString = uniqid();

            $currentExam[$exam->id] = [
                'exam_id' => $exam->id,
                'token' => $randomString,
                'start_at' => Carbon::now(),
                'finish_at' => Carbon::now()->addMinutes($exam->duration)
            ];

            array_push($current_exams, $currentExam);

            session()->put('current_exams', $currentExam);

            return redirect()->route('student.exam.start', [$exam->id, $randomString]);
        } else {
            return redirect()->back()->with('alert', 'Maaf kode akses yang Anda masukkan salah! Silahkan coba kembali.');
        }
    }

    public function restart(Exam $exam)
    {
        ExamScore::where('exam_id', $exam->id)
                    ->where('student_id', auth()->guard(session()->get('role'))->user()->id)->first()->delete();

        return redirect()->route('student.exam.boarding', $exam->id);
    }

    public function start(Exam $exam, $token)
    {
        $current_exams = session()->get('current_exams');
        if (isset($current_exams[$exam->id]) && isset($current_exams[$exam->id]) ? 
                                                $current_exams[$exam->id]['token'] == $token : false ) {
            

            $view = request()->mode == 'paper' ? 'student.exam.paper' : 'student.exam.index';
            
            return view($view, compact('exam', 'token'));
        }

        return redirect()->route('student.index')
                        ->with('alert', 'Maaf kode token salah, silahkan ulangi kembali!');
    }

    public function finish(Exam $exam, $token, Request $request)
    {
        $current_exams = session()->get('current_exams');
        if (isset($current_exams[$exam->id]) && isset($current_exams[$exam->id]) ? 
                                                $current_exams[$exam->id]['token'] == $token : false ) {

            $details = [];
            $is_essay_exists = false;
            $total_poin = 0;
            foreach ($request->question as $key => $answer) {
                $original = $exam->examQuestions()->find($answer['question_id']);

                $details[$key] = [
                    'question_id' => $original->id,
                    'right_answer' => $original->answer,
                    'answer' => ($answer['answer'] ?? null),
                    'poin' => $original->poin,
                    'type' => $original->question_type,
                ];

                if ($original->answer == ($answer['answer'] ?? null) && $original->question_type == 'PG') {
                    $details[$key]['is_correct'] = true;

                    $total_poin += $original->poin;

                } elseif ($original->question_type == 'ESAI') {
                    $details[$key]['is_correct'] = null;

                    $is_essay_exists = true;
                    
                } else {
                    $details[$key]['is_correct'] = false;

                }
            }

            $data = [
                'student_id' => auth()->guard(session()->get('role'))->user()->id,
                'exam_id' => $exam->id,
                'class_id' => auth()->guard(session()->get('role'))->user()->class_id,
                'school_id' => auth()->guard(session()->get('role'))->user()->school_id,
                'score' => $is_essay_exists ? null : $total_poin,
                'time_start' => Carbon::now(),
                'time_finish' => Carbon::now(),
                'detail' => json_encode($details),
            ];

            ExamScore::create($data);

            $currentExam = session()->get('current_exams');

            unset($currentExam[$exam->id]);

            session()->put('current_exams', $currentExam);

            return redirect()->route('student.index')
                            ->with('success', 'Selamat Anda sudah selesai mengerjakan ujian!')
                            ->with('exam_finish', true);
        }

        return redirect()->route('student.index')
                        ->with('alert', 'Maaf kode token salah, silahkan ulangi kembali!');
    }

    public function exit(Exam $exam, $token)
    {
        $current_exams = session()->get('current_exams');
        if (isset($current_exams[$exam->id]) && isset($current_exams[$exam->id]) ? 
                            $current_exams[$exam->id]['token'] == $token : false ) {

            unset($current_exams[$exam->id]);

            session()->put('current_exams', $current_exams);

            return redirect()->route('student.index')
                            ->with('alert', 'Anda sudah keluar dari ujian!')
                            ->with('exam_finish', true);
        }

        return redirect()->route('student.index')
                        ->with('alert', 'Maaf kode token salah, silahkan ulangi kembali!');
    }
}
