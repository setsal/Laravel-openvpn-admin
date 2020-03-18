<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('username', 'Username: ', ['class' => 'control-label']) !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('attribute', 'Attribute: ', ['class' => 'control-label']) !!}<br />
    {!! Form::select('attribute', array('Crypt-Password' => 'Crypt-Password', 'Cleartext-Password' => 'Cleartext-Password', 'Auth-Type' => 'Reject (無須填密碼)'), 'Crypt-Password') !!}
    {!! $errors->first('attribute', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('value', 'Password: ', ['class' => 'control-label']) !!}
    {!! Form::password('value', ['class' => 'form-control']) !!}
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
