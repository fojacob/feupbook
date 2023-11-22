<div class="post mt-4">
        <div class="card" style="width: 50em;">
            <div class="card-header d-flex justify-content-between fs-5">
                <small><a href="{{ route('user.profile', ['id' => $post->user->user_id]) }}" class="link-primary:hover">{{$post->user->name}}</a></small>
                <small class="text-muted"><span class="text-muted">@</span>{{ $post->user->username }}</small>
                <small class="text-black">{{ \Carbon\Carbon::parse($post->created_at)->format('H:i d-m-y') }}</small>
            </div>
            <a href="{{ route('showPost', ['id' => $post->post_id]) }}" class="text-decoration-none">
                <div class="card-body">
                    <p class="card-text text-black">{{ $post->content }}</p>
                    <p class="card-text text-black">{{ $post->image }}</p>
                </div>
            </a>
            @if (Auth::check() && Auth::id() == $post->owner_id)
                <div class="card-footer d-flex justify-content-end">
                    <!-- Edit Button -->
                    <a href="{{ route('editPost', ['id' => $post->post_id]) }}" class="btn btn-primary me-2">Edit Post</a>

                    <!-- Delete Button Form -->
                    <form action="{{ route('deletePost', ['id' => $post->post_id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                    </form>
                </div>
            @endif

        </div>
</div>
