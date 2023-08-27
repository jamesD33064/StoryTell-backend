<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryContentController;
use App\Http\Controllers\api\StoryAudioController;


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
    Route::get('/getAllStoryInfo', [StoryContentController::class, 'getAllStoryInfo']);
    Route::get('/getStoryDetail/{storyId}', [StoryContentController::class, 'getStoryDetail']);

    Route::prefix('audio')->group(function () {
        Route::get('{storyName}/{id}', [StoryAudioController::class, 'index']);
    });
});
