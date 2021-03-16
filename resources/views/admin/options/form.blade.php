
{!! Form::hidden('question_id', $question->id ) !!}
{!! Form::hidden('quiz_id', $question->quiz_id ) !!}
<div class="form-group{{ $errors->has('option') ? 'has-error' : ''}}">
    {!! Form::label('option', 'Option', ['class' => 'control-label']) !!}
    {!! Form::text('option', null, ['class' => 'form-control']) !!}
    {!! $errors->first('option', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'required' => 'false', 'id' => 'image'])!!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('correct') ? 'has-error' : ''}}">
    {!! Form::label('yesno', 'Correct Answer: ', ['class' => 'control-label']) !!}
    <div class="form-check form-check-inline{{ $errors->has('active') ? ' has-error' : ''}}">
        {!! Form::radio('correct', 1, false ,['class' => 'form-check-input', 'id' => 'active_yes', 'required' => 'required']) !!}
        {!! Form::label('active_yes', 'Yes', ['class' => 'form-check-label']) !!}
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-check form-check-inline{{ $errors->has('correct') ? ' has-error' : ''}}">
        {!! Form::radio('correct', 0, true ,['class' => 'form-check-input', 'id'=>'active_no', 'required' => 'required']) !!}
        {!! Form::label('active_no', 'No', ['class' => 'form-check-label', 'for' =>'active_no']) !!}
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
