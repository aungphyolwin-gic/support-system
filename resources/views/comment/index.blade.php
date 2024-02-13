<div>
    @foreach ($comments as $comment)
        {{-- each comment  card --}}
        <div class="card rounded-5 card-comments p-0 text-center">
            <div class="card-header p-0">

                <span class="profile-username">{{ $comment->user->name }}</span>

                    <div class=" d-inline float-right pe-5 me-5">
                        {{-- menu for comment modification  --}}
                        <div class="dropdown dropleft">
                            <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('comment.edit', $comment->id) }}"><i class="fa fa-pen"></i> Edit</a>
                                <form action="{{ route('comment.destroy',[$ticket_id,$comment->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item text-danger"><i class="fa fa-trash me-3"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="card-body p-o">
                {{ $comment->content }}
            </div>
            <div class="card-footer text-muted text-small p-0">
                {{ $comment->updated_at }}
            </div>
        </div>
    @endforeach
</div>
