<?php

namespace App\Models;

use App\Models\Relations\FeedBackRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory, FeedBackRelations;

    protected $table = 'feed_backs';
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category',
    ];
}
