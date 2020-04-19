@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{$question->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media">
                <!-- Show Each Question Vote Control -->
                <vote :model="{{$question}}" name="question"></vote>  
                
                <div class="media-body">
                   {!! $question->body_html !!}
                   
                        @if(Gate::allows('update-question',$question))
                            <a href="{{route('questions.edit',$question->id)}}" class="btn btn-sm btn-outline-info"> Edit</a>
                            <form class="form-delete " method="post" action="{{route('questions.destroy',$question->id)}}">
                                            @method('DELETE')
                                            @csrf
                                        <button type="Submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif  
                            <div class="row mb-3">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">

                                    <!-- Show Each Question Author -->
                                    <user-info :model="{{$question}}" :user="{{$question->user}}" label="Asked"></user-info>

                                </div>
                            </div>

                </div>
                </div>
            </div>
        </div>
      
    <answers :question="{{$question}}"></answers>
        
    </div>
</div>
@endsection
