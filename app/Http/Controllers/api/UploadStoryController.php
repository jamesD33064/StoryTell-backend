<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\StoryContentService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UploadStoryController extends Controller
{
    private $storyContentService;

    public function __construct(
        StoryContentService $storyContentService
    )
    {
        $this->storyContentService = $storyContentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'storyContent' => 'required',
            'storyImg' => 'required',
            'storyName' => 'required',
            'storyLang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->storyContentService->createStoryContent($request);
    }
}
