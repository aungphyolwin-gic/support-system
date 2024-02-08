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
                                    <div class="row justify-content-around">
                                        <span class="mr-3 text-bold">Label</span> <span class= "justify-content-center">:</span>
                                        <span class="">{{ $ticket->label->name?? "none" }} </span>
                                    </div>
                                    <div class="row justify-content-around">
                                        <span class="mr-3 text-bold">Category</span> <span class= "justify-content-center">:</span>
                                        <span class="">{{ $ticket->category->name }} </span>
                                    </div>
                                    <div class="row justify-content-around mb-3">
                                        <span class="mr-3 text-bold ">Priority</span> <span class= "justify-content-center">:</span>
                                        <span class="">{{ $ticket->priority }}</span>
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
