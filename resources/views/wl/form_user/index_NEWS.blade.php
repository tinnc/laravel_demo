@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
  <div class="">
      <div class="page-title">
          <div class="title_left">
            <h3>News</h3>
          </div>
          <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                      </span>
                  </div>
              </div>
          </div>
      <div class="clearfix"></div>
      <div class="row">
          <div class="x_panel">
              <div class="x_content">
                  <a href="{{ route('news.create') }}" class="btn btn-primary">Create</a>
                <div class="x_title"><h2></h2></div>
                </div>
                <!-- start project list -->
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                      <th style="width: 20%">Title</th>
                      <th style="width: 15%; text-align: center;">Type</th>
                      <th style="width: 20%; text-align: center;">Summary</th>
                      <th style="width: 10%; text-align: center;">Image</th>
                      <th style="width: 15%; text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($news as $article)
                        <tr>
                          <td>
                            <a href="{{ route('news.show', $article ) }}"><small>{{ $article->title }}</small></a>
                          </td>
                          <td align="center">
                            <small>{{ $article->category ? $article->category->name : '' }}</small>
                          </td>
                          <td align="center">
                            <label style="text-overflow: ellipsis;height:75px; width: 200px;border: 1px solid;padding: 2px 5px;overflow: hidden;">
                              <small>{!!$article->summary!!}</small>
                            </label>
                          </td>
                          <td>
                            <img src="{{ asset("images/bai_viet/{$article->image}" ) }}" class="avatar" alt="new" style="width:70px; height:70px">
                          </td>
                          <td align="center">
                          {{ Form::open([
                                'route' => ['news.destroy',$article->id],
                                'method' => 'delete',
                          ]) }}
                              <a href="{{ route('news.show', $article) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a>
                              <a href="{{ route('news.edit', $article) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                              {!! Form::button('<i class="fa fa-trash-o"></i>', [
                                'class'=>'btn btn-danger btn-xs',
                                'type'=>'submit',
                              ]) !!}
                          {{ Form::close() }}
                          </td>
                        </tr>
                      @endforeach
                    {{-- @endif --}}
                  </tbody>
                </table>
                <!-- end project list -->
                <div class="title_right">{{ $pages }}</div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
