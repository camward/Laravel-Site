<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Menu;

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

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput() {
        $menu = $this->getMenu();
        $navigation = view(env('THEME').'.navigation')->with('menu',$menu)->render();
        $this->vars = array_add($this->vars,'navigation',$navigation);
        if($this->contentRightBar){
            $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar', $this->contentRightBar)->render();
            $this->vars = array_add($this->vars,'rightBar',$rightBar);
        }
        return view($this->template)->with($this->vars);
    }

    protected function getMenu() {
        $menu = $this->m_rep->get();
        $mBuilder = Menu::make('MyNav', function($m) use ($menu) {
            foreach($menu as $item) {
                if($item->parent == 0) {
                    $m->add($item->title,$item->path)->id($item->id);
                }
                else {
                    if($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });

        return $mBuilder;
    }
}
