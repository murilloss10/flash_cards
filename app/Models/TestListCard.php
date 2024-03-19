<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestListCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_list_id',
        'card_id',
    ];
}
