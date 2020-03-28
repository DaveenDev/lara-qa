@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Ask Question</h2>
                        <div class="ml-auto">
                        <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>
                    

                </div>

                <div class="card-body">
                <form action="{{route('questions.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control {{$errors->has('title')?'is-invalid':''}}">

                        @if($errors->has('title'))
                            <div class="invalid-feed">
                            <strong>{{$errors->first('title')}}</strong>
                            </div>
                        @endif  
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" rows="10" class="form-control {{$errors->has('body')?'is-invalid':''}}">
                        </textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feed">
                            <strong>{{$errors->first('body')}}</strong>
                            </div>
                        @endif  
                    </div>
                    <div class="form-group">
                        <button type="Submit" class="btn btn-outline-primary btn-lg">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
