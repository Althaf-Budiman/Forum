<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait VoteAndBookmarkable
{
    // button vote clicked
    public function addVote($model, $voteType)
    {
        $user = Auth::user();

        // check if user already voted
        $existingVote = $model->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            // if user voted the given vote type, then delete the vote
            if ($existingVote->vote_type === $voteType) {
                $existingVote->delete();
            } else {
                // else update the vote type with determined vote type
                $existingVote->update([
                    'vote_type' => $voteType,
                    'vote_status' => $voteType,
                ]);
            }
        } else {
            // create new vote by using model relation with votes
            $model->votes()->create([
                'user_id' => $user->id,
                'vote_type' => $voteType,
                'vote_status' => $voteType
            ]);
        }
    }

    // calculate total vote
    public function calculateTotalVotes($model)
    {
        // update the total votes of model
        $model->update([
            'total_votes' => $model->votes()->where('vote_type', 'upvote')->count() - $model->votes()->where('vote_type', 'downvote')->count()
        ]);
    }

    // when bookmark btn clicked
    public function addBookmark($model)
    {
        $user = Auth::user();

        $existingBookmark = $model->bookmarks()->where('user_id', $user->id)->first();

        if ($existingBookmark) {
            // if existing bookmark then delete the bookmark
            $existingBookmark->delete();
        } else {
            // create new bookmark and update the bookmark status
            $model->bookmarks()->create([
                'user_id' => $user->id,
                'bookmark_status' => 'bookmark'
            ]);
        }
    }
}
