<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTestList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_list_id'
    ];

    public function test_list()
    {
        return $this->belongsTo(TestList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
