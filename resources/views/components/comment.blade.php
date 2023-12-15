<div class="alert alert-light" role="alert">
    <h4>{{ $comment->user->name }}</h4>
    <p>{{ $comment->content }}</p>
    @if (auth()->id() === $comment->user_id)
        <a href="/deletecomment/{{ $comment->id }}"><button class="btn btn-primary">Delete</button></a>
    @endif
</div>