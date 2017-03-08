<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $p_rep; // портфолил
    protected $s_rep; // слайдер
    protected $a_rep; // статьи
    protected $m_rep; // меню
    protected $template; // шаблон
    protected $vars = []; // переменные передаваемые в шаблон
    protected $bar = FALSE; // наличие колонки
    protected $contentRightBar = FALSE; // правая колонка
    protected $contentLeftBar = FALSE; // левая колонка

    public function __construct()
    {

    }

    protected function renderOutput(){

        return view($this->template)->with($this->vars);
    }
}
