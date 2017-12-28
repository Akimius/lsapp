@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>

    <div>
        {{$post->body}}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)

            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default">Edit</a>

        {{--    <a href="#" onclick="event.preventDefault();
                                            this.children[0].submit();">
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                </form>
                <button type="button" class="btn btn-warning">DELETE</button>

            </a>--}}

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="pull-right">
                {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                <div class="form-group">
                    <button type="submit" class="btn btn-warning">DELETE</button>
                </div>

            </form>
        @endif
    @endif

@endsection