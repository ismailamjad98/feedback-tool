<?php

namespace App\Models\Relations;

use App\Models\FeedbackReply;
use App\Models\User;

trait FeedBackRelations
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(FeedbackReply::class, 'feedback_id', 'id');
    }
}