@if ($answersCount > 0)
<div class="row justify-content-center mt-5" v-cloak>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount." ".str_plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include ('layouts._messages')
                @foreach ($answers as $answer)
                    <answer :answer="{{ $answer }}" inline-template >
                         
                    </answer>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
