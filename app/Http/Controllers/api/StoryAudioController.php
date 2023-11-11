<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\StoryAudioService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StoryAudioController extends Controller
{
    private $storyAudioService;

    public function __construct(
        StoryAudioService $storyAudioService
    )
    {
        $this->storyAudioService = $storyAudioService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($storyName, $lang, $speaker, $emotion, $id)
    {
        $validator = Validator::make(compact('storyName', 'lang', 'speaker', 'emotion', 'id'), [
            'storyName' => 'required',
            'lang' => 'required',
            'speaker' => 'required',
            'emotion' => 'required',
            'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->storyAudioService->getStoryAudio($storyName, $lang, $speaker, $emotion, $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
