@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Quiz: {{ $item->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/quizzes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/quizzes/' . $item->id . '/edit') }}" title="Edit Quiz"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/quizzes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Quiz',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <a href="{{ url('/admin/quizzes/' . $item->id . '/questions') }}" title="Manage Questions"><button class="btn btn-success btn-sm"><i class="fa fa-file-text-o" aria-hidden="true"></i> Questions</button></a>
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
                                    <tr><th> Negative Point </th><td> {{ $item->negative_point_text }} </td></tr>
                                    <tr><th> Total Point </th><td> {{ $item->total_point }} </td></tr>
                                    <tr><th> Passing Score </th><td> {{ $item->min_score }} </td></tr>
                                    <tr><th> Quiz Hints </th><td> {!! $item->quiz_hints !!} </td></tr>
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
