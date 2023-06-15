<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *    required={"user_id", "text",},
 *    description="Request for comment creation",
 *    type="object",
 *    title="Example comment storing request"
 * )
*/
class CreateCommentRequest
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

    /**
     * @OA\Property(
     *     title="parent id",
     *     description="ID of the comment, for which the reply was created",
     *     format="int64",
     *     example="198",
     *     nullable=true
     * )
     *
     * @var integer
     */

    public $parent_id;
}
