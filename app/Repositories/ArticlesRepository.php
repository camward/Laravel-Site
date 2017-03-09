<?php

namespace Corp\Repositories;

use Corp\Articles;

class ArticlesRepository extends ARepository {
    public function __construct(Articles $articles) {
        $this->model = $articles;
    }
}