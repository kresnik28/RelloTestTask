<?php


namespace App\Http\Service;


use App\Models\Comment;
use App\Models\User;


/**
 * Class CommentsService
 * @package App\Http\Service
 */
class CommentsService
{
    /**
     * @param User $user
     * @param $request
     * @return Comment
     */
    public function createComment(User $user, $request): Comment
    {
        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->comment_text = $request->comment['commentText'];
        $comment->parent_id = $request->parentId ?? null;
        $comment->save();

        return $comment;
    }
}
