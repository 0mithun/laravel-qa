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
                        <div class="media post">
                            @include('shared._vote',[
                                'model' => $answer
                            ])
                        
                            <div class="media-body">
                                <div  id="media-body-form">
                                    <form v-if="editing" @submit.prevent="update">
                                        <div class="form-gorup">
                                            <textarea rows="10" v-model="body" class="form-control" requred></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-outline-primary btn-sm" :disabled="isInvalid">Update</button>
                                            <button type="button" @click="cancel" class="btn btn-outline-danger btn-sm">Cancel</button>
                                        </div>
                                    </form>
                                </div> 
                                <div v-if="!editing">
                                    <div v-html="bodyHtml"></div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="ml-auto">
                                                @can('update', $answer)
                                                    <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                                                @endcan
                                                @can('delete', $answer)                                     
                                                    <form class="form-delete" action="{{ route('questions.answers.destroy',  [$question->id, $answer->id])  }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onClick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="col-4"></div>
                                        <div class="col-4">
                                            <user-info :model="{{ $answer }}" label="Answered"></user-info>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </answer>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
