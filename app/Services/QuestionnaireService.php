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
        return $answer;
        // return $this->questionnaireRecord->getStoryAudio($answer, $id);
    }
}
