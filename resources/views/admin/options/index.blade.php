@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <a href="{{url('admin/quizzes/'.$quizId.'/questions')}}">All Questions</a> >
                        <a href="{{url('admin/quizzes/'.$quizId.'/questions/'.$items->id)}}">{{$items->question}} </a>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('admin/quizzes/'.$quizId.'/questions/'.$items->id.'/options/create') }}" class="btn btn-success btn-sm" title="Add New Option">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/quizzes', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Option</th><th>Image</th><th>Correct</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items->options as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->option }}</td>
                                        <td><img height="45px" src="{{$item->image_url}}"/></td>
                                        <td><code>{{ $item->correct_text }}</code></td>
                                        <td>
                                            <a href="{{ url('/admin/quizzes/' .$quizId . '/questions/'. $item->question_id. '/options/'.$item->id.'/edit') }}" title="Edit Option"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/quizzes/' .$quizId . '/questions/'. $item->question_id.'/options', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Option',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                           </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
