<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
/**
 * @OA\Tag(
 *     name="Comment",
 *     description="Authentication endpoints"
 * )
 */
class CommentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/comments",
     *     tags={"Comment"},
     *     summary="Create a new comment",
     *     operationId="createComment",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateCommentRequest")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Comment created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={})
     *         )
     *     )
     * )
     */

    public function create(CreateCommentRequest $request): JsonResponse
    {
        $comment = Comment::create($request->all());

        return response('', 201)->json(['data' => $comment]);
    }
    /**
     * @OA\Get(
     *     path="/comments/{id}",
     *     tags={"Comment"},
     *     summary="Get a comment by ID",
     *     operationId="getCommentById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Comment ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Comment retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Comment not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="string", example="Comment not found")
     *         )
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        $comment = Comment::with('children')->find($id);

        if(empty($comment))
        {
            return response()->json(['errors' => "Comment with id = $id not found"])->setStatusCode(404);
        }

        return response()->json(['data' => $comment]);
    }
    /**
     * @OA\Put(
     *     path="/comments/{id}",
     *     tags={"Comment"},
     *     summary="Update a comment",
     *     operationId="updateComment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Comment ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCommentRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Comment updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Comment not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="string", example="Comment not found")
     *         )
     *     )
     * )
     */
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
    /**
     * @OA\Delete(
     *     path="/comments/{id}",
     *     tags={"Comment"},
     *     summary="Delete a comment",
     *     operationId="deleteComment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Comment ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Comment deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="Comment with id = {id} deleted")
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Comment not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="string", example="Comment not found")
     *         )
     *     )
     * )
     */
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
