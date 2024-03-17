<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackReply extends Model
{
    use HasFactory;

    protected $table = 'feedback_replies';
    protected $fillable = ['comment', 'user_id', 'feedback_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
