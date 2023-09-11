<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function bookmarkView()
    {
        $bookmarkedQuestions = Bookmark::where('user_id', auth()->user()->id)->with('question')->get();
        return view('bookmark-list', compact('bookmarkedQuestions'));
    }
}
