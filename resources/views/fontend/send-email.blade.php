@extends('layouts.app')

@section('title', 'Gửi email - Allaravel.com')

@section('content')
    {!! Form::open(array('url' => '/admin/email', 'class' => 'form-horizontal')) !!}
        <div class="form-group">
            {!! Form::label('name', 'Email service', array('class' => 'col-sm-3 control-label')) !!}
            <div class="col-sm-3">
                {!! Form::select('email_service', array('1' => 'SMTP GMAIL', '2' => 'MailGun', '3' => 'MailTrap', '4' => 'Sparkpost'), '1', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Tên người gửi', array('class' => 'col-sm-3 control-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('from_name', 'All Laravel Admin', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('from_email', 'Email người gửi', array('class' => 'col-sm-3 control-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('from_email', 'allaravel.com@gmail.com', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('to_email', 'Email người nhận', array('class' => 'col-sm-3 control-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('to_email', '', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('subject', 'Tiêu đề', array('class' => 'col-sm-3 control-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('subject', '', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Nội dung', array('class' => 'col-sm-3 control-label')) !!}
            <div class="col-sm-9">
                {!! Form::textarea('body', '', array('class' => 'form-control', 'rows' => 5)) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Gửi email', array('class' => 'btn btn-success')) !!}
            </div>
        </div>
   {!! Form::close() !!}
@endsection