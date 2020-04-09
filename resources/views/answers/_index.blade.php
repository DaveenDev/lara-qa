
   @if($answersCount>0)
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{$answersCount. " " . Str::plural('Answer',$answersCount)}}</h3>
                    </div>
                    <hr>
                    @include('layouts._messages')
                    @foreach($answers as $answer)
                    <div class="media">
                        @include('shared._vote',[
                            'model'=>$answer
                        ])
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    @can('update',$answer)
                                                <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-sm btn-outline-info"> Edit</a>
                                    @endcan
                                    @can('delete',$answer)
                                                <form class="form-delete " method="post" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}">
                                                    @method('DELETE')
                                                    @csrf
                                                <button type="Submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                    @endcan
                                </div>
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                   @include('shared._author',[
                                        'model'=>$answer,
                                        'label'=>'Answered'
                                    ])
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
 @endif

