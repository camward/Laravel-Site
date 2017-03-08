<?php

namespace Corp\Repositories;

use Corp\Slider;

class SlidersRepository extends ARepository {
    public function __construct(Slider $slider) {
        $this->model = $slider;
    }
}