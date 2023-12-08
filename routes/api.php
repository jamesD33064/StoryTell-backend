<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryContentController;
use App\Http\Controllers\api\StoryAudioController;
use App\Http\Controllers\api\UploadStoryController;
use App\Http\Controllers\api\QuestionnaireController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 故事相關
Route::prefix('story')->group(function () {
    // 取得所有故事資訊
    Route::get('/getAllStoryInfo', [StoryContentController::class, 'getAllStoryInfo']);
    // 取得單一故事內容
    Route::get('/getStoryDetail/{storyId}', [StoryContentController::class, 'getStoryDetail']);
    // 上傳故事
    Route::post('uploadStoryWithCsv', [UploadStoryController::class, 'index']);

    Route::prefix('audio')->group(function () {
        Route::get('{storyName}/{lang}/{speaker}/{emotion}/{id}', [StoryAudioController::class, 'index']);
    });
});

// 問卷相關
Route::post('uploadSurvery', [QuestionnaireController::class, 'index']);
