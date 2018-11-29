{!! Form::open(array('route' => 'user.send-mail')) !!}
    <div>
        <label  class="email">Your email</label>
        {!! Form::text('email', null, ['class' => 'input-text', 'placeholder'=>"Your email"]) !!}
    </div>
    <div class="send">
        {!! Form::submit('Send', ['class' => 'button']) !!}
    </div>
{!! Form::close() !!}