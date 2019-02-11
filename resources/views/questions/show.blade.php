@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <div class="d-flex align-items-center">
                        <h2>{{ $question->title }}</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all question</a>
                        </div>
                    </div>
                </div>
                <hr> 
                <div class="media">
                    @include('shared._vote',[
                        'model'     =>  $question,
                    ])
                   <div class="media-body">
                        {!! $question->body_html !!}
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                @include('shared._author',[
                                    'label' =>  'asked',
                                    'model' =>  $question
                                ])
                            </div>
                        </div>
                   </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    @include ('answers._index',[
        'answers'       =>   $question->answers,
        'answersCount'  =>   $question->answers_count
    ])
    @include ('answers._create')
</div>
@endsection
