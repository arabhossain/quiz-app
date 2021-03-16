@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Question: {{ $item->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/quizzes/'.$item->quiz_id.'/questions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/quizzes/' . $item->quiz_id.'/questions/'.$item->id . '/edit') }}" title="Edit Question"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/quizzes/' . $item->quiz_id . '/questions', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Question',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <a href="{{ url('/admin/quizzes/' . $item->quiz_id . '/questions/'. $item->id.'/options') }}" title="Manage Options"><button class="btn btn-success btn-sm"><i class="fa fa-list" aria-hidden="true"></i></button></a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $item->id }}</td>
                                    </tr>
                                    <tr><th> Question </th><td> {{ $item->question }} </td></tr>
                                    <tr><th> Answer Type </th><td> {{ $item->answer_type_text }} </td></tr>
                                    @if($item->answer_type == 4)
                                    <tr><th>Fill Gaps</th><td> {!! $item->fill_gaps_code !!} </td></tr>
                                    @endif
                                    <tr><th> Description </th><td> {!! $item->description !!} </td></tr>
                                    <tr><th> Point </th><td> {{ $item->point }} </td></tr>
                                    <tr><th> Image </th><td><img src="{{$item->image_url}}" height="150px"> </td></tr>
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
