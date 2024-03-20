<?php

namespace App\Models;

use App\Models\Relations\FeedBackReplyRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackReply extends Model
{
    use HasFactory, FeedBackReplyRelations;

    protected $table = 'feedback_replies';
    protected $fillable = ['comment', 'user_id', 'feedback_id'];

}
