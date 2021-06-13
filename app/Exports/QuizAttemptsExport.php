<?php

namespace App\Exports;

use App\Quiz;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuizAttemptsExport implements FromArray,WithHeadings
{
    protected $id;

 function __construct($id) {
        $this->id = $id;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $quiz = Quiz::findOrFail($this->id);
        $full_marks = 0;
        foreach($quiz->questions as $question){
           $full_marks+=$question->marks;
        }
        $attempts = $quiz->attempts;
        $results = [];
        foreach ($attempts as $attempt) {
        $data = [
            'user' => $attempt->user->name,
            'total_marks' => $attempt->total_marks,
            'full_marks' => $full_marks,

        ];
        foreach ($attempt->attemptAnswers as $key => $answer) {
            $data['Question '.($key+1)] = ''.$answer->marks.'/'.$answer->question->marks;
        }
        array_push($results,$data);

        }

        return $results;

    }

    public function headings():array
    {
        $headings = ["User", "Obtained Marks", "Total Marks"];
        $quiz = Quiz::findOrFail($this->id);
        foreach ($quiz->questions as $key => $question) {
            array_push($headings,'Question '.($key+1));
        }
        return $headings;
    }
}
