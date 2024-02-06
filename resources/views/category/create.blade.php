@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  mt-3 shadow">
                <div class="card-header bg-gray text-left">
                    <h3>Add Category</h3>
                </div>

                <div class="card-body">
                    {{-- Input Form for user data --}}
                    <form method="POST" action="{{ route('category.store') }}" >
                        @csrf

                        {{-- User Name Field --}}
                        <div class="form-group m-3 row">
                            <label for="name" class="col-sm-6 col-form-label">Name <small class="text-danger">*</small></label>
                            <div class="col-sm-6">
                              <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                              @error('name')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>



                          <div class="form-group m-3 row">
                            <div class="mx-auto">
                              <a href="{{ route('category.index') }}" class="btn btn-outline-dark">
                                <i class="far fa-arrow-alt-circle-left fa-lg"></i>
                              </a>
                              <button type="submit" class="btn btn-outline-primary">Add</button>
                            </div>
                          </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
