<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->template = env('THEME').'.admin.index';
    }

    public function index() {
        $this->title = 'Панель администратора';
        return $this->renderOutput();
    }
}
