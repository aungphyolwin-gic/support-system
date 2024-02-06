@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  mt-3 shadow">
                <div class="card-header bg-gray text-left">
                    <h3>Add User</h3>
                </div>

                <div class="card-body">
                    {{-- Input Form for user data --}}
                    <form method="POST" action="{{ route('user.update',$user->id) }}" >
                        @csrf
                        @method('PUT')

                        {{-- User Name Field --}}
                        <div class="form-group m-3 row">
                            <label for="name" class="col-sm-6 col-form-label">Name <small class="text-danger">*</small></label>
                            <div class="col-sm-6">
                              <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $user->name }}">
                              @error('name')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          {{-- Email Field --}}
                          <div class="form-group m-3 row">
                            <label for="email" class="col-sm-6 col-form-label">Email <small class="text-danger">*</small></label>
                            <div class="col-sm-6">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email')?? $user->email }}">
                              @error('email')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          {{-- Password Field --}}
                          <div class="form-group m-3 row">
                            <label for="password" class="col-sm-6 col-form-label">Password <small class="text-danger">*</small></label>
                            <div class="col-sm-6">
                              <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password')?? decrypt($user->password) }}">
                              @error('password')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          {{-- User Role [0 : normal user, 1 : agent, *2: admin] --}}
                          <div class="form-group m-3 row">
                            <label for="role" class="col-sm-6 col-form-label">User Type <small class="text-danger">*</small></label>
                            <div class="col-sm-6 dropdown">
                                <select name="role" class="form-control @error('role') is-invalid @enderror" >
                                    <option value=0 @if ($user->role == 0) @@selected(true) @endif  >Regular User</option>
                                    <option value=1  @if ($user->role == 1) @@selected(true) @endif>Agent User</option>
                                    <option value=2  @if ($user->role == 2) @@selected(true) @endif>Admin</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                          </div>


                          <div class="form-group m-3 row">
                            <div class="mx-auto">
                              <a href="{{ route('user.index') }}" class="btn btn-outline-dark">
                                <i class="far fa-arrow-alt-circle-left fa-lg"></i>
                              </a>
                              <button type="submit" class="btn btn-outline-primary">Update</button>
                            </div>
                          </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
