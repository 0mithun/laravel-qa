<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                    <hr>
                    <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                        @csrf 
                        <div class="form-group">
                            <label for="body" class="control-lebel">Answers</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control {{ $errors->has('body')? 'is-invalid' : '' }}"></textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>                                
                            @endif                            
                        </div>
                        <div class="form-group">
                           <button type="submit" class="btn btn-outline-primary">Submit Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>