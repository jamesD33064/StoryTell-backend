<?php

namespace App\Http\Controllers\api;

use App\Events\UploadStory;
use App\Http\Controllers\Controller;
use App\Services\StoryContentService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            event(new UploadStory($storyId, $request->storyContent));
        }
        //         $storyContent = '從前有個可愛的小姑娘，誰見了都喜歡，但最喜歡她的是她的奶奶，簡直是她要什麼就給她什麼。 一次，奶奶送給小女孩一頂用絲絨做的小紅帽，戴在她的頭上正好合適。 從此，女孩再也不願意戴任何別的帽子，於是大家便叫她"小紅帽"。
        // 有一天，媽媽對小紅帽說：「來，小紅帽，這裡有一塊蛋糕和一瓶葡萄酒，快給奶奶送去，奶奶生病了，身子很虛弱，吃了這些就會好一些的。趁著現在天還沒有 熱，趕緊動身吧。在路上要好好走，不要跑，也不要離開大路，';

        //         event(new UploadStory('6574c84a0d011a0e8a07f272', $storyContent));

        return response()->json(['retMsg' => '成功'], 200);
    }
}
