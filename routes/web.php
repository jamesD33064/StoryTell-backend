<?php

use Illuminate\Support\Facades\Route;
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

# 故事相關內容
// Route::prefix('story')->group(function () {
//     Route::get('/getAllStoryInfo', [StoryContentController::class, 'getAllStoryInfo']);
//     Route::get('/getStoryDetail/{storyId}', [StoryContentController::class, 'getStoryDetail']);
// });
