<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends HelperController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::where('title', 'like', '%'.$request->input('title').'%')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create', [
            'article' => new News,
            'category_id' => self::show_type_news()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image_news')) {

            if ($request->file('image_news')->isValid()) {
                $file = $request->file('image_news');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =time().'.'.$extension;
                $file->move('images/bai_viet/', $filename);

                $article = new News;
                $article->title = $request->get('title');
                $article->category_id = $request->get('category_id');
                $article->image = $filename;
                $article->detail = $request->get('detail');
                $article->summary = $request->get('summary');
                $article->created_at = date('Y-m-d');
                $article->status = 1;
                $article->user_id = 0;
                $article->views = 0;
                $article->save();
            } else {
                echo 'File is invalid';
            }
        } else {
            echo 'Choose file, please !';
        }

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = News::findOrFail($id);
        return view('admin.news.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = News::findOrFail($id);

        return view('admin.news.edit', [
            'article' => $article,
            'category_id' => self::show_type_news()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = News::findOrFail($id);

        if ($request->hasFile('image_news')) {

            if ($request->file('image_news')->isValid()) {
                \File::delete("images/bai_viet/$article->image");
                $file = $request->file('image_news');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =time().'.'.$extension;
                $file->move('images/bai_viet/', $filename);
            } else {
                echo 'File is invalid';
            }
        } else {
            $filename = $article->image;
        }

        if (isset($article) && isset($filename)) {
            $article->title = $request->get('title');
            $article->category_id = $request->get('category_id');
            $article->image = $filename;
            $article->detail = $request->get('detail');
            $article->summary = $request->get('summary');
            $article->updated_at = date('Y-m-d');
            $article->status = 1;
            $article->views = 0;
            $article->user_id = 0;
            $article->save();
        }

        return view('admin.news.show', compact('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $article = News::find($id);
        $filename = $article->image;

        if (isset($filename)) {
            \File::delete("images/bai_viet/$filename");
        }

        News::destroy($id);

        return redirect()->route('news.index');
    }
}
