@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  mt-3 shadow">
                <div class="card-header bg-gray text-left">
                    <h3>Edit Label</h3>
                </div>

                <div class="card-body">
                    {{-- Input Form for label data --}}
                    <form method="POST" action="{{ route('label.update',$label->id) }}" >
                        @csrf
                        @method('PUT')

                        {{-- label Name Field --}}
                        <div class="form-group m-3 row">
                            <label for="name" class="col-sm-6 col-form-label">Name <small class="text-danger">*</small></label>
                            <div class="col-sm-6">
                              <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $label->name }}">
                              @error('name')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                        </div>


                          <div class="form-group m-3 row">
                            <div class="mx-auto">
                              <a href="{{ route('label.index') }}" class="btn btn-outline-dark">
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
