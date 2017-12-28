@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ url( '/posts') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title"
                               value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong class="text-danger">
                                    {{ $errors->first('title') }}
                                </strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="inputBody">Body</label>
                        <textarea name="body" id="inputBody" placeholder="Body text" class="form-control"></textarea>
                            @if ($errors->has('body'))
                            <span class="help-block">
                                <strong class="text-danger">
                                {{ $errors->first('body') }}
                                </strong>
                            </span>
                            @endif
                    </div>

                    <div class="form-group">
                        <input type="file" name="cover_image">
                    </div>

                    <button type="submit" class="btn btn-primary">CREATE</button>

                </form>
            </div>
            <div class="col-md-6"></div>
        </div>

    </div>

@endsection