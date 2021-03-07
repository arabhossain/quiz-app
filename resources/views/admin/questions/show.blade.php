@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Question: {{ $item->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/quizzes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/quizzes/' . $item->id . '/edit') }}" title="Edit Question"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/quizzes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Question',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $item->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $item->title }} </td></tr>
                                    <tr><th> Course </th><td> {{ $item->course->name }} </td></tr>
                                    <tr><th> Max Number of Questions </th><td> {{ $item->max_number_questions }} </td></tr>
                                    <tr><th> Min Score </th><td> {{ $item->min_score }} </td></tr>
                                    <tr><th> Question Hints </th><td> {!! $item->quiz_hints !!} </td></tr>
                                    <tr><th> Private </th><td> {{ $item->private_text }} </td></tr>
                                    <tr><th> Visible </th><td> {{ $item->visible_text }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
