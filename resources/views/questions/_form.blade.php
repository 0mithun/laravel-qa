@csrf
<div class="form-group">
    <label for="question-title" class="control-label">Questions Title</label>
    <input value="{{ (isset($question)) ? old('title',$question->title) : old('title')  }}" type="text" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid': '' }}" />
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="question-body" class="control-label">Explain your question</label>
    <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid': '' }}">{{ (isset($question)) ? old('body',$question->body) : old('body') }}</textarea>
        @if ($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <button class="btn btn-outline-primary btn-lg" type="submit">{{ $buttonText  }}</button>
</div>