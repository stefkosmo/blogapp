<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Carbon\Carbon;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Auth;

class ArticlesController extends Controller {

	public function __construct()
	{

		$this->middleware('auth', ['except' => 'index']);

	}

	public function index()
	{

		$articles = Article::latest('published_at')->published()->get();

		return view('articles.index', compact('articles'));

	}

	public function show(Article $article)
	{

		return view('articles.show', compact('article'));

	}

	public function create()
	{

		return view('articles.create');

	}

	public function store(ArticleRequest $request)
	{

		$article = new Article($request->all());

		Auth::user()->articles()->save($article);

		return redirect('articles');

	}

	public function edit(Article $article)
	{

		return view('articles.edit', compact('article'));

	}

	public function update(Article $article, ArticleRequest $request)
	{

		$article->update($request->all());

		return redirect('articles');

	}

}
