<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'topic',
        'question',
        'question_answer',
    ];

    public $appends = ['updatedDate'];

    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->format('d/m/Y H:m');
    }

    public function test_list_card()
    {
        return $this->hasOne(TestListCard::class);
    }
}
