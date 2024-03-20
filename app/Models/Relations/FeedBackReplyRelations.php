<?php

namespace App\Models\Relations;

use App\Models\User;

trait FeedBackReplyRelations
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}