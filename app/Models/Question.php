<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation to votes table
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get all of the bookmarks for the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    // get the vote status
    public function upvoteStatusIcon()
    {
        $user = Auth::user();

        $existingVote = $this->votes()->where('user_id', $user->id)->first();
        if ($existingVote && $existingVote->vote_status === 'upvote') {
            return 'bi bi-caret-up-fill';
        } else {
            return 'bi bi-caret-up';
        }
    }

    public function downvoteStatusIcon()
    {
        $user = Auth::user();

        $existingVote = $this->votes()->where('user_id', $user->id)->first();
        if ($existingVote && $existingVote->vote_status === 'downvote') {
            return 'bi bi-caret-down-fill';
        } else {
            return 'bi bi-caret-down';
        }
    }

    // Fungsi untuk mengubah icon bookmark
    public function bookmarkStatusIcon()
    {
        $user = Auth::user();

        $bookmarked = $this->bookmarks()->where('user_id', $user->id)->first();
        if ($bookmarked) {
            return 'bi bi-bookmark-fill';
        } else {
            return 'bi bi-bookmark';
        }
    }
}
