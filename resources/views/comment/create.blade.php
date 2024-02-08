<footer>
    <div class="container">
        <form method="POST" action="{{ route('comment.store') }}">
            @csrf

            <input type="hidden" name="ticket_id" value="{{ $ticket_id }}">
            {{-- comment input Field --}}
            <div class="input-group mb-3 ">
                <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Comment something"
                    aria-label="Comment" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Post</button>
                </div>
            </div>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </form>
    </div>
</footer>
