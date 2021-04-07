<?php

namespace App\Http\Controllers\Api;

use App\Http\Helpers\TreeHelperController;
use App\Http\Requests\CommentRequest;
use App\Http\Service\UsersService;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        $comments = Comment::with('users')->get();

        $helperTree = new TreeHelperController();

        return $helperTree->buildTree($comments);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     *
     */
    public function store(CommentRequest $request): Comment
    {

        $userService = new UsersService();
        $user = $userService->getUser($request->user);

        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->comment_text = $request->comment['commentText'];
        $comment->parent_id = $request->parentId ?? null;
        $comment->save();

        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->children()->delete();
        $comment->forceDelete();
    }
}
