@extends('dashboard/index')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-3 shadow">
                    <div class="card-header bg-gray text-center">
                        <h3 class="fst-italic">Tickets</h3>
                    </div>

                    <div class="card-body ">

                        {{-- @if (session('create'))
                            <div class="alert alert-success  alert-dismissible  " role="alert">
                                <i class="fas fa-check-circle"> </i>
                                {{ session('create') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if (session('update'))
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <i class="fas fa-exclamation-circle"> </i>
                                {{ session('update') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if (session('delete'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <i class="fas fa-exclamation-circle"> </i>
                                {{ session('delete') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif --}}

                        @foreach ($tickets as $ticket)
                            {{-- Data cards --}}
                            <div class="card mb-3 shadow">
                                <div class="card-header text-center text-monospace text-bold text-uppercase">
                                    <h5 class="d-inline">Title : {{ $ticket->title }}</h5>

                                    <div class=" d-inline float-right">
                                        {{-- menu  --}}
                                        <div class="dropdown dropleft">
                                            <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if (Auth::user()->role == 2)
                                                    <a class="dropdown-item text-warning" href="{{ route('ticket.edit', $ticket->id) }}"><i class="fa fa-pen"></i> Edit</a>
                                                    <form action="{{ route('ticket.destroy',$ticket->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger"><i class="fa fa-trash me-3"></i> DELETE</button>
                                                    </form>
                                                @elseif (Auth::user()->role == 1)
                                                    <a class="dropdown-item text-warning" href="{{ route('ticket.edit', $ticket->id) }}"><i class="fa fa-pen"></i> Edit</a>
                                                @endif

                                                <a class="dropdown-item text-primary" href="{{ route('ticket.show', $ticket->id) }}"><i class="fa fa-comment-dots"></i> Comment</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- card data  --}}
                                <div class="card-body">
                                    <p class="border-1 text-start">{{ $ticket->message }}</p>
                                    <div class="row justify-content-start border-1">
                                        <div class= "col-md-2 text-bold">Label</div>
                                        <div class= "col-md-1 justify-content-center">:</div>
                                        <div class= "col-md-3 ">{{ $ticket->label->name?? "none" }} </div>
                                    </div>
                                    <div class="row justify-content-start border-1">
                                        <div class= "col-md-2 text-bold">Category  </div>
                                        <div class= "col-md-1 justify-content-center">:</div>
                                        <div class= "col-md-3 text-start">{{ $ticket->category->name }} </div>
                                    </div>
                                    <div class="row justify-content-start border-1">
                                        <div class= "col-md-2 text-bold ">Priority</div>
                                        <div class= "col-md-1 justify-content-center">:</div>
                                        <div class= "col-md-3 text-start">{{ $ticket->priority }}</div>
                                    </div>
                                    <div class="row justify-content-start border-1 ">
                                        <div class= "col-md-2 text-bold ">Status</div>
                                        <div class= "col-md-1 justify-content-center">:</div>
                                        <div class= "col-md-3 text-start">{{ $ticket->status }}</div>
                                    </div>
                                    <div class="row justify-content-start border-1 mb-3">
                                        <div class= "col-md-2 text-bold ">Assigned to </div>
                                        <div class= "col-md-1 justify-content-center">:</div>
                                        <div class= "col-md-3 text-start">
                                            @if ($ticket->assigned_id != null)
                                                {{ $ticket->agent->name }}
                                            @else
                                                no agent
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <iframe src="{{ asset('storage/upload_file/'.$ticket->file) }}" frameborder="0" height="200px" width="100%"></iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
