<?php

namespace App\Services;

use App\Models\QuestionnaireRecord;
use Illuminate\Support\Facades\Log;

class QuestionnaireService
{
    private $questionnaireRecord;

    public function __construct(
        QuestionnaireRecord $questionnaireRecord
    )
    {
        $this->questionnaireRecord = $questionnaireRecord;
    }

    public function storeAnswer($answer)
    {
        $data = [
            "Q1" => $answer['Q1'][0]??"",
            "Q2" => $answer['Q2'][0]??"",
            "Q3" => $answer['Q3']??"",
            "Q4" => $answer['Q4']??"",
            "Q5" => $answer['Q5']??"",
        ];
        Log::channel('survey')->info(json_encode($data));
        // Log::channel('survey')->info($answer['Q5']);
        $result = $this->questionnaireRecord->fill($data)->save();

        return response()->json(['result' => $result, 'answer' => $answer]);
        // return $this->questionnaireRecord->($answer, $id);
    }
}
