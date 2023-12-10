<?php

namespace App\Http\Controllers\api;

use App\Events\UploadStory;
use App\Http\Controllers\Controller;
use App\Services\StoryContentService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadStoryController extends Controller
{
    private $storyContentService;

    public function __construct(
        StoryContentService $storyContentService
    ) {
        $this->storyContentService = $storyContentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadStoryByCSVFile(Request $request)
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

        return $this->storyContentService->createStoryContentByCSVFile($request);
    }

    public function uploadStoryWithString(Request $request)
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

        $storyId = $this->storyContentService->createStoryContentByString($request);

        if ($storyId) {
            // event(new UploadStory($storyId, $request->storyContent));
            Log::info("[UploadStoryController]生成語音:" . json_encode([$storyId, $request->storyContent]));
            UploadStory::dispatch($storyId, $request->storyContent);
        }

        return response()->json(['retMsg' => '成功'], 200);
    }
}
