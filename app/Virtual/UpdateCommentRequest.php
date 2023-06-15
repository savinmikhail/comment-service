<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *    required={"text",},
 *    description="Request for comment update",
 *    type="object",
 *    title="Example comment updating request"
 * )
 */
class UpdateCommentRequest
{
    /**
     * @OA\Property(
     *     title="text",
     *     description="Text of the comment",
     *     format="string",
     *     example="She bought her daughter a bottle of water"
     * )
     *
     * @var string
     */
    public $text;

    /**
     * @OA\Property(
     *     title="user id",
     *     description="ID of the user, that creates this comment",
     *     format="int64",
     *     example="198"
     * )
     *
     * @var integer
     */
    public $user_id;
}
