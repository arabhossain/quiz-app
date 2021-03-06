@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Question #{{ $item->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/quizzes/'.$item->quiz_id.'/questions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($item, [
                            'method' => 'PATCH',
                            'url' => ['/admin/quizzes/'.$item->quiz_id.'/questions', $item->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.questions.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.image-uploader')

@push('script')
    <script>
        const $fillGapsInputs = $('#fill-in-the-gaps')

        @if($item->answer_type != 4)
            $fillGapsInputs.hide()
       @endif

        $('input[name="answer_type"]').on('change', function (){
            const type = parseInt($(this).val());
            if (type === 4)
                $fillGapsInputs.show()
            else
                $fillGapsInputs.hide()
        })
    </script>
@endpush
