@extends('dashboard.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card  mt-3 shadow">
                    <div class="card-header bg-gray text-left">
                        <h3>Report Ticket</h3>
                    </div>

                    <div class="card-body">
                        {{-- Input Form for ticket data --}}
                        <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- ticket Title Field --}}
                            <div class="form-group m-3 ">
                                <label for="title" class="form-label">Title <small
                                        class="text-danger">*</small></label>
                                <div class="">
                                    <input type="title" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Message Field --}}
                            <div class="form-group m-3">
                                <label for="message" class="form-label">Message
                                    <small class="text-danger">*</small>
                                </label>
                                <div class="">
                                    <textarea type="message" name="message" class="form-control @error('message') is-invalid @enderror"
                                       " rows="3">{{ old('message') }}
                                    </textarea>
                                    @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Label checkbox Field --}}
                            <div class="form-group m-3">
                                <label for="label_id" class="form-label">Label</label>
                                <div>
                                    @foreach ($labels as $label)
                                        <div class="form-check form-check-inline  @error('label') is-invalid @enderror">
                                            <input type="checkbox" class="form-check-input" name="label_id" value="{{ $label->id }}">
                                            <label class="form-check-label" for="label">{{ $label->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('label_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Category checkbox Field --}}
                            <div class="form-group m-3">
                                <label for="category_id" class="form-label">Category</label>
                                <div>
                                    @foreach ($categories as $category)
                                        <div class="form-check form-check-inline  @error('category') is-invalid @enderror">
                                            <input type="checkbox" class="form-check-input" name="category_id" value="{{ $category->id }}">
                                            <label class="form-check-label" for="category">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Priority --}}
                            <div class="form-group m-3 ">
                                <label for="priority" class="form-label">Priority<small
                                        class="text-danger">*</small></label>
                                <div class="dropdown">
                                    <select name="priority" class="form-control @error('priority') is-invalid @enderror">
                                        <option value="" @selected(true)>Choose Priority</option>
                                        <option value="low">Low</option>
                                        <option value="normal">Normal</option>
                                        <option value="high">High</option>
                                    </select>
                                    @error('priority')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- file upload --}}
                            <div class="form-group m-3">
                                <div class="">
                                    <label for="file" class=" form-label">Upload file</label>
                                    <input class=" form-control-file" type="file" name="file" multiple>
                                  </div>
                            </div>

                            <div class="form-group m-3 row">
                                <div class="mx-auto">
                                  <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">
                                    <i class="far fa-arrow-alt-circle-left fa-lg"></i>
                                  </a>
                                  <button type="submit" class="btn btn-outline-primary">Send</button>
                                </div>
                              </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
