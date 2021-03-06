@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Question</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/quizzes/'.$quiz->id.'/questions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/quizzes/'.$quiz->id.'/questions', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.questions.form', ['formMode' => 'create'])

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
    $fillGapsInputs.hide()

   $('input[name="answer_type"]').on('change', function (){
       const type = parseInt($(this).val());
       if (type === 4)
           $fillGapsInputs.show()
       else
           $fillGapsInputs.hide()
   })
</script>
@endpush
