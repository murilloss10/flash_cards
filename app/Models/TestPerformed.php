<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPerformed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_list_id',
        'corrects',
        'incorrects',
        'total_questions',
    ];
}
