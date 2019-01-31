<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index()
    {
        $news = Auth::user()->news;
        return view('news.index', ['newsArray' => $news]);
    }

    public function create()
    {
        return view('news.create');
    }

    public function edit(News $news)
    {
        return view('news.edit', ['news' => $news]);
    }

    public function update(Request $request, News $news)
    {
        $news->name = $request->get('name');
        $news->description = $request->get('description');
        $news->is_active = $request->get('is_active') ? 1 : 0;

        $news->update();

        Session::flash('status', 'News successfully created');

        return redirect('news')->with(['status' => 'News successfully updated']);
    }

    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }

    public function delete(News $news)
    {
        try {
            $news->delete();
            return redirect('news')->with(['status' => 'News deleted']);
        } catch (\Exception $e) {
            return view('show.index', ['exception' => $e->getMessage()]);
        }
    }

    public function save(Request $request)
    {
        $news = new News();
        $news->name = $request->get('name');
        $news->description = $request->get('description');
        $news->is_active = $request->get('is_active') ? 1 : 0;
        $news->author_id = Auth::user()->id;
        $news->save();

        Session::flash('status', 'News successfully created');

        return redirect('news')->with(['status' => 'News successfully created']);
    }
}