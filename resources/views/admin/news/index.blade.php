@extends('layouts.template_demo')

@section('content')

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><a href="{{ route('news.index') }}"><h3>News</h3></a></div>
        <div class="title_right">
            <form method="GET" action="{{ route('news.index') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input name="title" type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                                <button id="btn_search" class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="x_panel">
            <div class="x_content">
                <a href="{{ route('news.create') }}" class="btn btn-primary">Create</a>
                <div class="x_title"></div>
            </div>
            <table class="table table-striped projects index_user">
                <thead>
                    <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Summary</th>
                    <th>Image</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $article)
                        @can('index', $article)
                            <tr>
                                <td><a href="{{ route('news.show', $article ) }}"><small>{{ $article->title }}</small></a></td>
                                <td><small>{{ $article->category ? $article->category->name : '' }}</small></td>
                                <td>
                                    <label style="text-overflow: ellipsis; height:75px; width:200px; border:1px solid; padding:2px 5px; overflow:hidden">
                                        <small>{!! $article->summary !!}</small>
                                    </label>
                                </td>
                                <td><img src="{{ asset('images/bai_viet/' . $article->image ) }}" alt="news" style="width:70px; height:70px"></td>
                                <td>
                                    {{ Form::open(['route' => ['news.destroy',$article->id], 'method' => 'delete']) }}
                                        {{-- <a href="{{ route('news.show', $article) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a> --}}
                                        <a href="{{ route('news.edit', $article) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                        {{-- {!! Form::button('<i class="fa fa-trash-o"></i>', ['class'=>'btn btn-danger btn-xs', 'type'=>'submit']) !!} --}}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                </tbody>
            </table>
            <div class="title_right">{{ $news->links() }}</div>
        </div>
    </div>
</div>

@endsection
