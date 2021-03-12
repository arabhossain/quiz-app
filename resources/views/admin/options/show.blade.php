@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Option: {{ $item->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/quizzes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/quizzes/' . $item->id . '/edit') }}" title="Edit Option"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/quizzes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Option',
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
                                    <tr><th> Question </th><td> {{ $item->question }} </td></tr>
                                    <tr><th> answer_type </th><td> {{ $item->answer_type }} </td></tr>
                                    <tr><th> description </th><td> {!! $item->description !!} </td></tr>
                                    <tr><th> point </th><td> {{ $item->point }} </td></tr>
                                    <tr><th> image </th><td> {!! $item->image !!} </td></tr>
                                    <tr><th> Options </th><td> {{ $item->options_count }} </td></tr>
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
