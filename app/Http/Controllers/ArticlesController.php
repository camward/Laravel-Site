<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticleRepository;
use Corp\Repositories\CommentsRepository;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticleRepository $a_rep, CommentsRepository $c_rep) {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;
        $this->bar = 'right';
        $this->template = env('THEME').'.articles';
    }

    public function index($cat_alias = FALSE)
    {
        $articles = $this->getArticles($cat_alias);
        $content = view(env('THEME').'.articles_content')->with('articles',$articles)->render();
        $this->vars = array_add($this->vars,'content',$content);
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments,'portfolios' => $portfolios]);
        return $this->renderOutput();
    }

    public function getComments($take) {
        $comments = $this->c_rep->get(['text','name','email','site','article_id','user_id'],$take);
        if($comments) {
            $comments->load('article','user');
        }
        return $comments;
    }

    public function getPortfolios($take) {
        $portfolios = $this->p_rep->get(['title','text','alias','customer','img','filter_alias'],$take);
        return $portfolios;
    }

    public function getArticles($alias = FALSE) {
        $where = FALSE;
        if($alias) {
            $id = Category::select('id')->where('alias',$alias)->first()->id;
            $where = ['category_id',$id];
        }
        $articles = $this->a_rep->get(['id','title','alias','created_at','img','desc','user_id','category_id','keywords','meta_desc'],FALSE,TRUE,$where);
        if($articles) {
            $articles->load('user','category','comments');
        }
        return $articles;
    }

    public function show($alias = FALSE) {
        $article = $this->a_rep->one($alias,['comments' => TRUE]);
        if($article) {
            $article->img = json_decode($article->img);
        }

        $this->title = $article->title;
        $this->keywords = $article->keywords;
        $this->meta_desc = $article->meta_desc;

        $content = view(env('THEME').'.article_content')->with('article',$article)->render();
        $this->vars = array_add($this->vars,'content',$content);
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments,'portfolios' => $portfolios]);
        return $this->renderOutput();
    }
}