
{!! Form::hidden('quiz_id', $quiz->id ) !!}

<div class="form-group{{ $errors->has('question') ? 'has-error' : ''}}">
    {!! Form::label('question', 'Question', ['class' => 'control-label']) !!}
    {!! Form::text('question', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('question', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'required' => 'false', 'id' => 'image'])!!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Question Hints', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control crud-richtext']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="row">
    <div class="col col-md-6 form-group{{ $errors->has('point') ? 'has-error' : ''}}">
        {!! Form::label('point', 'Point', ['class' => 'control-label']) !!}
        {!! Form::number('point', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col col-md-6 form-group{{ $errors->has('answer_type') ? 'has-error' : ''}}">
        {!! Form::label('yesno', 'Question Type: ', ['class' => 'control-label']) !!}
        <br/>
        <div class="form-check form-check-inline{{ $errors->has('answer_type') ? ' has-error' : ''}}">
            {!! Form::radio('answer_type', 1,true ,['class' => 'form-check-input', 'id' => 'type-single', 'required' => 'required']) !!}
            {!! Form::label('type-single', 'Single Selection', ['class' => 'form-check-label']) !!}
            {!! $errors->first('answer_type', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-check form-check-inline{{ $errors->has('answer_type') ? ' has-error' : ''}}">
            {!! Form::radio('answer_type', 2, false ,['class' => 'form-check-input', 'id'=>'type-multiple', 'required' => 'required']) !!}
            {!! Form::label('type-multiple', 'Multiple Selection', ['class' => 'form-check-label', 'for' =>'active_no']) !!}
            {!! $errors->first('answer_type', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-check form-check-inline{{ $errors->has('visible') ? ' has-error' : ''}}">
            {!! Form::radio('answer_type', 3, false ,['class' => 'form-check-input', 'id'=>'type-text', 'required' => 'required']) !!}
            {!! Form::label('type-text', 'Text Answer', ['class' => 'form-check-label', 'for' =>'active_no']) !!}
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>

    </div>
</div>

<div class="form-group{{ $errors->has('visible') ? 'has-error' : ''}}">
    {!! Form::label('yesno', 'Visible: ', ['class' => 'control-label']) !!}
    <div class="form-check form-check-inline{{ $errors->has('active') ? ' has-error' : ''}}">
        {!! Form::radio('visible', 1,true ,['class' => 'form-check-input', 'required' => 'required']) !!}
        {!! Form::label('visible', 'Yes', ['class' => 'form-check-label']) !!}
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-check form-check-inline{{ $errors->has('visible') ? ' has-error' : ''}}">
        {!! Form::radio('visible', 0, false ,['class' => 'form-check-input', 'id'=>'active_no', 'required' => 'required']) !!}
        {!! Form::label('visible', 'No', ['class' => 'form-check-label', 'for' =>'active_no']) !!}
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
