<?php

namespace Corp\Repositories;

use Corp\Comment;

class CommentsRepository extends ARepository {
    public function __construct(Comment $comment) {
        $this->model = $comment;
    }
}