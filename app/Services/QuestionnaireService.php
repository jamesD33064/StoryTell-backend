<?php

namespace App\Services;

use App\Models\QuestionnaireRecord;

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
        // foreach($answer as $q){
            
        // }
        $result = $this->questionnaireRecord->fill([
                "Q1" => $answer['Q1'],
                "Q2" => $answer['Q2'],
                "Q3" => $answer['Q3'],
            ])->save();

        return response()->json(['result' => $result, 'answer' => $answer]);
        // return $this->questionnaireRecord->($answer, $id);
    }
}
