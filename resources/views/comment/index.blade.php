<div>
    @foreach ($comments as $comment)
        {{-- each comment  card --}}
        <div class="card rounded-3">
            <div class="card-header-pills profile-username">
                {{ $comment->user->name }}
            </div>
            <div class="card-body">
                {{ $comment->content }}
            </div>
            <small class="card-footer text-small">
                {{ $comment->updated_at }}
            </small>
        </div>
    @endforeach
</div>
