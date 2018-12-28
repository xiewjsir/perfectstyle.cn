<?php

namespace App\Http\Controllers;

use App\Lib\Models\Columns;
use App\Lib\Models\Posts;
use App\Lib\Models\Tags;
use App\Markdown\Markdown;
use Illuminate\Http\Request;

class BlogController extends Controller {
	protected $markdown;
	public function __construct(Markdown $markdown) {
		$this->markdown = $markdown;
	}

	public function index(Request $request) {
		$data = [];
		$data['columns'] = Columns::where('status', 1)->get();
		$data['tags'] = Tags::where('status', 1)->get();

		$posts_query = Posts::where('status', 1)->where('released', 1);

		$slug = '';
		if ($slug) {
			$posts_query->where('column_id', Columns::where('status', 1)->where('slug', $slug)->value('id'));
		}

		$tag = $request->get('tag');
		if ($tag) {
			$posts_query->whereHas('tags', function ($query) {
				$query->where('tag', $tag);
			});
		}

		$keyword = $request->get('keyword');
		if ($keyword) {
			$posts_query->whereRaw("title like '%{$keyword}%' or content_html like '%{$keyword}%'");
		}

		$data['posts'] = $posts_query->orderBy('sort', 'asc')->paginate(10);
		$data['profile'] = Posts::where('slug', 'profile')->firstOrFail();
		$data['posts_by_views'] = Posts::where('status', 1)->where('released', 1)->orderBy('views', 'desc')->limit(8)->get();
		$data['keyword'] = $keyword;
		$data['slug'] = $slug;
		$layout = $slug ? Columns::getLayout($slug) : 'index';
		return view($layout, $data);
	}

	public function detail($slug, Request $request) {
		$data = [];
		$data['columns'] = Columns::where('status', 1)->get()->keyBy('id');
		$data['tags'] = Tags::where('status', 1)->get();
		$data['post'] = Posts::with('tags')->whereSlug($slug)->firstOrFail();
		// 解析Markdown 内容
		$data['post']['content_html'] = $this->markdown->markdown($data['post']['content_html']);
		$data['slug'] = $data['columns'][$data['post']['column_id']]['slug'];
		Posts::with('tags')->whereSlug($slug)->increment('views');
		return view($data['post']->layout, $data);
	}
}
