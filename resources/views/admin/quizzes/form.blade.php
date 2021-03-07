<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('course_id') ? ' has-error' : ''}}">
    {!! Form::label('course_id', 'Course: ', ['class' => 'control-label']) !!}
    {!! Form::select('course_id', $courses, isset($item) ? [$item->course_id] : [], ['class' => 'form-control', 'required' => true, 'multiple' => false]) !!}
    {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="row">
    <div class="col col-md-6 form-group{{ $errors->has('min_score') ? 'has-error' : ''}}">
        {!! Form::label('min_score', 'Min Score', ['class' => 'control-label']) !!}
        {!! Form::number('min_score', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('min_score', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group{{ $errors->has('negative_point') ? 'has-error' : ''}}">
        {!! Form::label('yesno', 'Negative Point: ', ['class' => 'control-label']) !!}
        <br>
        <div class="form-check form-check-inline{{ $errors->has('active') ? ' has-error' : ''}}">
            {!! Form::radio('negative_point', 1, false ,['class' => 'form-check-input', 'id' => 'negative_point', 'required' => 'required']) !!}
            {!! Form::label('negative_point', 'Yes', ['class' => 'form-check-label']) !!}
            {!! $errors->first('negative_point', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-check form-check-inline{{ $errors->has('visible') ? ' has-error' : ''}}">
            {!! Form::radio('negative_point', 0, true ,['class' => 'form-check-input', 'id'=>'active_no', 'required' => 'required']) !!}
            {!! Form::label('active_no', 'No', ['class' => 'form-check-label', 'for' =>'active_no']) !!}
            {!! $errors->first('negative_point', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('quiz_hints') ? 'has-error' : ''}}">
    {!! Form::label('quiz_hints', 'Quiz Hints', ['class' => 'control-label']) !!}
    {!! Form::textarea('quiz_hints', null, ['class' => 'form-control crud-richtext']) !!}
    {!! $errors->first('quiz_hints', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group{{ $errors->has('private') ? 'has-error' : ''}}">
    {!! Form::label('yesno', 'Private: ', ['class' => 'control-label']) !!}
    <div class="form-check form-check-inline{{ $errors->has('active') ? ' has-error' : ''}}">
        {!! Form::radio('private', 1,false ,['class' => 'form-check-input', 'id' => 'private', 'required' => 'required']) !!}
        {!! Form::label('private', 'Yes', ['class' => 'form-check-label']) !!}
        {!! $errors->first('private', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-check form-check-inline{{ $errors->has('visible') ? ' has-error' : ''}}">
        {!! Form::radio('private', 0, true ,['class' => 'form-check-input', 'id'=>'private_no', 'required' => 'required']) !!}
        {!! Form::label('private_no', 'No', ['class' => 'form-check-label', 'for' =>'private_no']) !!}
        {!! $errors->first('private', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group{{ $errors->has('visible') ? 'has-error' : ''}}">
    {!! Form::label('yesno', 'Visible: ', ['class' => 'control-label']) !!}
    <div class="form-check form-check-inline{{ $errors->has('active') ? ' has-error' : ''}}">
        {!! Form::radio('visible', 1,true ,['class' => 'form-check-input', 'id' => 'visible_yes', 'required' => 'required']) !!}
        {!! Form::label('visible_yes', 'Yes', ['class' => 'form-check-label']) !!}
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-check form-check-inline{{ $errors->has('visible') ? ' has-error' : ''}}">
        {!! Form::radio('visible', 0, false ,['class' => 'form-check-input', 'id'=>'visible_no', 'required' => 'required']) !!}
        {!! Form::label('visible_no', 'No', ['class' => 'form-check-label', 'for' =>'visible_no']) !!}
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
