<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('meta_key') ? 'has-error' : ''}}">
    {!! Form::label('meta_key', 'Meta Key', ['class' => 'control-label']) !!}
    {!! Form::text('meta_key', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('meta_key', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('meta_description') ? 'has-error' : ''}}">
    {!! Form::label('meta_description', 'Meta Description', ['class' => 'control-label']) !!}
    {!! Form::textarea('meta_description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('body') ? 'has-error' : ''}}">
    {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
    {!! Form::textarea('body', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('featured_photo') ? 'has-error' : ''}}">
    {!! Form::label('featured_photo', 'Featured Photo', ['class' => 'control-label']) !!}
    {!! Form::text('featured_photo', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('featured_photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('visible') ? 'has-error' : ''}}">
    {!! Form::label('visible', 'Visible', ['class' => 'control-label']) !!}
    <div class="checkbox">
    <label>{!! Form::radio('visible', '1', true) !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('visible', '0') !!} No</label>
</div>
    {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
