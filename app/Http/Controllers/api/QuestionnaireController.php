<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\QuestionnaireService;
use App\Services\StoryAudioService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    private $questionnaireService;

    public function __construct(
        QuestionnaireService $questionnaireService
    )
    {
        $this->questionnaireService = $questionnaireService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'answer' => 'required',
        // ]);

        // foreach($request->answer as $q){
        //     if()
        // }

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        // return $this->questionnaireService->storeAnswer($validator['answer']);
        return $this->questionnaireService->storeAnswer($request->answer);
    }
}
