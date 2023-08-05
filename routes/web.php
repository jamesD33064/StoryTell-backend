<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamAudioController;
use App\Http\Controllers\StoryContentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/streamAudio', [StreamAudioController::class, 'streamAudio']);

# 故事相關內容
Route::prefix('story')->group(function () {
    Route::get('/getAllStoryNameAndID', [StoryContentController::class, 'getAllStoryNameAndID']);
    Route::get('/getStoryDetail/{storyId}', [StoryContentController::class, 'getStoryDetail']);
});
