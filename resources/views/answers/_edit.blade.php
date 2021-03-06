@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h1>Editing answer for question: <strong>{{ $question->title }}</strong></h1>
                    <hr>
                    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
                        @csrf 
                        @method('PATCH')
                        <div class="form-group">
                            <label for="body" class="control-lebel">Answers</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control {{ $errors->has('body')? 'is-invalid' : '' }}">{{ old('body', $answer->body)}}</textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>                                
                            @endif
                            
                        </div>
                        <div class="form-group">
                           <button type="submit" class="btn btn-outline-primary">Update Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection