@extends('layouts.app')

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')
    <section class="d-flex justify-content-center" style="margin-left: 280px;">
        <div class="post mt-4">
            <div class="card" style="width: 50em;">
                <div class="card-header d-flex justify-content-between fs-5">
                    <small><a href="{{ route('user.profile', ['id' => $post->user->user_id]) }}" class="link-primary:hover">{{$post->user->name}}</a></small>
                    <small class="text-muted"><span class="text-muted">@</span>{{ $post->user->username }}</small>
                    <small class="text-black">{{ \Carbon\Carbon::parse($post->created_at)->format('H:i d-m-y') }}</small>
                </div>

                <div class="card-body">
                    <h5 class="card-text text-black">{{ $post->content }}</h5>
                </div>

                <div class="card-footer d-flex justify-content-around">
                    <div class="d-flex align-items-center">
                        <button class="btn bi bi-heart custom-btn-like"></button>
                        <span id="likesCount">{{ $post->likesCount() }}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('showPost', ['id' => $post->post_id]) }}" class="btn bi bi-chat custom-btn-comment"></a>
                        <span id="commentsCount">{{ $post->commentsCount() }}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <button class="btn bi bi-bookmark custom-btn-bookmark"></button>
                        <span id="bookmarksCount">{{ $post->bookmarksCount() }}</span>
                    </div>

                    @canany(['update', 'delete'], $post)
                        <div class="ms-auto">
                                <a href="{{ route('editPost', ['id' => $post->post_id]) }}" class="btn btn-primary me-2">Edit Post</a>
                                <form action="{{ route('deletePost', ['id' => $post->post_id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                                </form>
                        </div>
                    @endcanany
                </div>

                <div class="card-body">
                    <form style="display:flex; justify-content: center" action="{{ route('storeComment') }}" method="POST">
                        @csrf
                        <textarea style="resize:none" id="content" name="content" cols="30" rows="1"
                            placeholder="Adicione um comentário..."></textarea> 
                        <input type="hidden" name="post_id" id="post_id" value="{{ $post->post_id }}">
                        <input type="hidden" name="comment_id" id="comment_id" value="{{ NULL }}">
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </form>

                    @forelse($post->comments as $comment)
                    @include('partials.comment', ['comment' => $comment])
                    @empty
                        <p style="color: gray; font-size: 0.8rem">There are no comments on this post.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </section>
@endsection
