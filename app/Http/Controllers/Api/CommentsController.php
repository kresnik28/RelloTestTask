<?php

namespace App\Http\Controllers\Api;

use App\Http\Helpers\TreeHelper;
use App\Http\Requests\CommentRequest;
use App\Http\Service\CommentsService;
use App\Http\Service\UsersService;
use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * Class CommentsController
 * @package App\Http\Controllers\Api
 */
class CommentsController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        $comments = Comment::with('users')->get();

        $helperTree = new TreeHelper();

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
     * Store a newly created comment in storage.
     *
     * @param CommentRequest $request
     * @return Comment
     */
    public function store(CommentRequest $request): Comment
    {
        $userService = new UsersService();
        $user = $userService->getUser($request->user);

        $commentsService = new CommentsService();

        return $commentsService->createComment($user, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->children()->delete();
        $comment->forceDelete();
    }
}
