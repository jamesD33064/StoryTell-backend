<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class QuestionnaireRecord extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'questionnaireRecord';
    protected $fillable = ['Q1', 'Q2', 'Q3'];
}
