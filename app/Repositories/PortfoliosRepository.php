<?php

namespace Corp\Repositories;

use Corp\Portfolio;

class PortfoliosRepository extends ARepository {
    public function __construct(Portfolio $portfolio) {
        $this->model = $portfolio;
    }
}