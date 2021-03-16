@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><a href="{{url('admin/quizzes')}}">Quizzes</a> > <a href="{{url('admin/quizzes/'.$items->id)}}">{{$items->title}} </a> > Questions</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/quizzes/'.$items->id.'/questions/create') }}" class="btn btn-success btn-sm" title="Add New Question">
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
                                        <th>ID</th><th>Question</th><th>Type</th><th>Options</th><th>Point</th><th>Visible</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items->questions as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->question }}</td>
                                        <td>{{ $item->answer_type_text }}</td>
                                        <td>{{ $item->options()->count() }}</td>
                                        <td><code>{{ $item->point }}</code></td>
                                        <td><code>{{ $item->visible_text }}</code></td>
                                        <td>
                                            <a href="{{ url('/admin/quizzes/' . $item->quiz_id . '/questions/'. $item->id) }}" title="View Question"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/quizzes/' . $item->quiz_id . '/questions/'. $item->id. '/edit') }}" title="Edit Question"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/quizzes/' . $item->quiz_id . '/questions', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Question',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                            @if(!in_array($item->answer_type, [3,4]))
                                                <a href="{{ url('/admin/quizzes/' . $item->quiz_id . '/questions/'. $item->id.'/options') }}" title="Manage Options"><button class="btn btn-success btn-sm"><i class="fa fa-list" aria-hidden="true"></i></button></a>
                                            @endif
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
