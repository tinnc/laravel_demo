@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><h3><a href="{{ route('news.index') }}">News</a> :: Article Detail</h3></div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ID: {!! $article->id !!} - Title: {!! $article->title !!}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (!isset($article))
                        Article :: Null
                    @else

                        <div class="x_panel">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Category :</label>
                            <b>{{$article->category->name}}</b>
                        </div>

                        <div class="x_panel">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Image :</label>
                            <div><img src="{{ asset('images/bai_viet/' . $article->image) }}" style="width:150px; height:150px"/></div>
                        </div>

                        <div class="x_panel">
                            <div class="x_title">
                                <h5>Detail :</h5>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content"><small>{!! $article->detail !!}</small></div>
                        </div>

                        <div class="x_panel">
                            <div class="x_title">
                                <h5>Summary :</h5>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">{!! $article->summary !!}</div>
                        </div>

                        <div class="x_panel">
                            <a href="{{ route('news.index') }}" class="btn btn-primary">Cancel</a>
                            <a href="{{ route('news.edit', $article) }}" class="btn btn-success">Edit</a>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
