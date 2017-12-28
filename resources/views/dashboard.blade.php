@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <a href="{{ route('posts.create')}}" class="btn btn-primary">Create post</a>
                    <h3>Your Blog Posts</h3>

                        @if(count($posts) > 0)

                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td> <strong>{{$post->title}}</strong> Written by {{$post->user->name}} at {{$post->updated_at}}</td>
                                    <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a></td>

                                    <td>
                                            <a href="#" onclick="event.preventDefault();
                                    this.children[0].submit();">
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete">
        </form>
        <button type="button" class="btn btn-danger">DELETE</button>

    </a>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                                @else <p>You have no posts</p>
                        @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
