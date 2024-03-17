<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use App\Models\FeedbackReply;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = FeedBack::with('user', 'replies.user')->get();
        return response()->json(['status' => 'success', 'feedbacks' => $feedbacks], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function postReply(Request $request)
    {
        $data = $request->all();
        return FeedbackReply::create($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'user_id' => 'required',
        ]);
        return FeedBack::create($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feedback = FeedBack::findOrFail($id);
        return $feedback->delete();
    }
}
