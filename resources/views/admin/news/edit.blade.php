@extends('layouts.template_demo')

@section('content')
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left"><h3><a href="{{ route('news.index') }}">News</a> :: Article Update</h3></div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><small>Update Article:: </small>{!! $article->title !!} / <small>ID:: </small> {!! $article->id !!}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                @if (!isset($article))
                    Article :: Null
                @else
                    <ul class="validation_error"></ul>
                    {{ Form::open(['route' => ['news.update',  $article], 'method' => 'put', 'files' => true]) }}

                        <div class="x_panel">
                            {!! Form::label('title', 'Title :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                            {!! Form::text('title', $article->title, ['required', 'placeholder' => 'Title', 'class' => 'col-md-9 col-sm-9 col-xs-9']) !!}
                        </div>

                        <div class="x_panel">
                            {!! Form::label('category', 'Category :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                            {!! Form::select('category_id', $category_id, sprintf($article->category_id), ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!}
                        </div>

                        <div class="x_panel">
                            {!! Form::label('image', 'Image :', ['class' => 'control-label col-md-3 col-sm-3 col-xs-1']) !!}
                            {!! Form::file('image_news', ['accept'=>'.png,.jpg,.gif', 'class' => 'image_news col-md-9 col-sm-9 col-xs-12 x_panel']) !!}
                            <div id="image-holder" style="text-align: center;"><img src="{{ asset("images/bai_viet/{$article->image}" ) }}" /></div>
                        </div>

                        <div class="x_panel">
                            {!! Form::label('detail', 'Detail :', ['class' => 'x_title control-label col-md-12 col-sm-12 col-xs-12']) !!}
                            <div class="x_content">
                                {!! Form::textarea('detail', $article->detail, [
                                                                'id' => 'detail',
                                                                'placeholder' => 'Detail',
                                                                'cols' => '70', 'rows' => '3',
                                                                'style' => 'visibility: hidden; display: none',
                                                                'class' => 'ckeditor col-md-9 col-sm-9 col-xs-12'])
                                !!}
                            </div>
                        </div>

                        <div class="x_panel">
                            {!! Form::label('summary', 'Summary :', ['class' => 'x_title control-label col-md-12 col-sm-12 col-xs-12']) !!}
                            <div class="x_content">
                                {!! Form::textarea('summary', $article->summary, [
                                                                'class' => 'col-md-9 col-sm-9 col-xs-12',
                                                                'id' => 'summary',
                                                                'placeholder' => 'Summary',
                                                                'cols' => '70', 'rows' => '3',
                                                                'style' => 'visibility: hidden; display: none',
                                                                'class' => 'ckeditor'])
                                !!}
                            </div>
                        </div>

                        <div class="x_panel">
                            <a href="{{ route('news.index') }}" class="btn btn-primary">Cancel</a>
                            {!! Form::submit('Save', ['class'=>'btn btn-success', 'type'=>'submit']) !!}
                        </div>

                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
</div>



{{ Html::script ('ckeditor/ckeditor.js') }}

<script type="text/javascript">CKEDITOR.replace( ['detail','summary'], { customConfig: '{{ asset("ckeditor/baiviet_config.js") }}' } ); </script>

<script>
    $('.image_news').on('change', function () {
        if (typeof(FileReader) != 'undefined') {
            var image_holder = $( '#image-holder' );
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $( '<img />', {
                    'src': e.target.result,
                    'class': 'thumb-image'
                } ).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
        else {
            alert('This browser does not support FileReader.');
        }
    });
</script>

@endsection
