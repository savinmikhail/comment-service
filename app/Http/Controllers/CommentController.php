<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function create(CreateCommentRequest $request): JsonResponse
    {
        $comment = Comment::create($request->all());

        return response()->json(['data' => $comment]);
    }

    public function show(string $id): JsonResponse
    {
        $comment = Comment::with('children')->find($id);

        if(empty($comment))
        {
            return response()->json(['errors' => "Comment with id = $id not found"])->setStatusCode(404);
        }

        return response()->json(['data' => $comment]);
    }

    public function update(UpdateCommentRequest $request, string $id): JsonResponse
    {
        $comment = Comment::find($id);
        if(empty($comment))
        {
            return response()->json(['errors' => "Comment with $id not found"])->setStatusCode(404);
        }

        $comment->update($request->all());

        return response()->json(['data' => $comment]);
    }

    public function delete(string $id): JsonResponse
    {
        $comment = Comment::find($id);
        if(empty($comment))
        {
            return response()->json(['errors' => "Comment with $id not found"])->setStatusCode(404);
        }

        $comment->delete();

        return response()->json(['data' => "Comment with id = $id deleted"]);
    }
}
