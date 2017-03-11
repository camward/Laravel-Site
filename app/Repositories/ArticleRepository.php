<?php

namespace Corp\Repositories;

use Corp\Article;

class ArticleRepository extends ARepository {
    public function __construct(Article $articles) {
        $this->model = $articles;
    }
}