<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class StoryContent extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'storyContent';
    protected $fillable = ['storyName', 'storyContent'];

}
