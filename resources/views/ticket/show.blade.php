@extends('dashboard/index')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-3 shadow">
                    <div class="card-header bg-gray text-center">
                        <h3 class="fst-italic">{{ $ticket->user->name }}</h3>
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


                            {{-- Data cards --}}
                            <div class="card mb-3">
                                <div class="card-header text-center text-monospace text-bold text-uppercase">
                                    <h5 class="d-inline">Title : {{ $ticket->title }}</h5>

                                    <div class=" d-inline float-right">
                                        {{-- menu  --}}
                                        <div class="dropdown dropleft">
                                            <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('ticket.edit', $ticket->id) }}"><i class="fa fa-pen"></i>Edit</a>
                                                <a class="dropdown-item" href="#">Case</a>
                                                <form action="{{ route('ticket.destroy',$ticket->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item"><i class="fa fa-trash me-3"></i>Delete</button>
                                                </form>
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
                                    <div class="row justify-content-start border-1 mb-3">
                                        <div class= "col-md-2 text-bold ">Priority</div>
                                        <div class= "col-md-1 justify-content-center">:</div>
                                        <div class= "col-md-3 text-start">{{ $ticket->priority }}</div>
                                    </div>
                                    {{-- <div class="embed-responsive embed-responsive-16by9"> --}}<div>
                                        <iframe src="{{ asset('storage/upload_file/'.$ticket->file) }}" frameborder="0" class="embed-responsive-item"></iframe>
                                    </div>
                                </div>

                                {{-- card footer as comment session --}}
                                <div class="card-footer text-muted justify-content-between row">
                                    <div class="">post a comment</div>
                                    <div class="">
                                        {{-- <a href="{{ route('comment.index') }}">Comments</a> --}}
                                    </div>
                                </div>

                            </div>

                            @include('comment.index',['ticket_id'=>$ticket->id])

                    </div>
                </div>
            </div>

        </div>

        @include('comment.create',['ticket_id'=>$ticket->id])
    </div>

@endsection
