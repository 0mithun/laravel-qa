@if ($model instanceOf App\Question)
    @php 
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif($model instanceOf App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif
<div class="d-flex flex-column vote-controls">
    <a title="This {{ $name }} is useful" class="vote-up {{ Auth::guest()? 'off' : '' }}"
        onClick="event.preventDefault(); document.getElementById('up-vote-{{ $name }}-{{ $model->id }}').submit();"
    >
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{ $name }}-{{ $model->id }}" action="/{{ $firstURISegment }}/{{ $model->id }}/vote" method="post" style="display:none">
        @csrf
        <input type="hidden" name="vote" value="1" />
    </form>

    <span class="votes-count">{{ $model->votes_count }}</span>

    <a title="This {{ $name }} is not useful" class="vote-down  {{ Auth::guest()? 'off' : '' }}" 
        onClick="event.preventDefault(); document.getElementById('down-vote-{{ $name }}-{{ $model->id }}').submit();"
    >
            <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form id="down-vote-{{ $name }}-{{ $model->id }}" action="/{{ $firstURISegment }}/{{ $model->id }}/vote" method="post" style="display:none">
        @csrf
        <input type="hidden" name="vote" value="-1" />
    </form>
    @if($model instanceOf App\Question)
        <favorite :question="{{ $model }}"></favorite>


    @elseif($model instanceOf App\Answer)
        @include('shared._accept', [
            'model' =>  $model
        ])
    @endif
</div> 