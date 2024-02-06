@extends('dashboard/index')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-3 shadow">
                    <div class="card-header bg-gray text-center">
                        <h3 class="fst-italic">User List</h3>
                    </div>

                    <div class="card-body ">

                        @if (session('create'))
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
                        @endif

                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Account Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $number = 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $number++ }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ decrypt($user->password) }}</td>
                                        @if ($user->role == 0)
                                            <td> Regular </td>
                                        @elseif ($user->role == 1)
                                            <td> Agent </td>
                                        @else
                                            <td> Admin </td>
                                        @endif

                                        <td>
                                            <div class="d-inline">
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-outline-warning "><i class="fa fa-pen"></i></a>
                                                {{-- <a href="{{ route('user.show',$user->id) }}" class="btn btn-outline-info "><i class="fa fa-info"></i></a> --}}
                                            </div>

                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
