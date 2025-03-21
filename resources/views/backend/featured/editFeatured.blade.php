@extends('backend.layout.master')
@section('title', 'Update feature')
@push('custom_css')

@endpush
@section('content')

    <!-- .page -->
    <div class="page bg-white">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex justify-content-between">
                    <h1 class="page-title"> Update Feature </h1>
                    <div class="btn-toolbar">
                        {{-- <button type="button" class="btn btn-primary">Add team</button> --}}
                    </div>
                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid bg-light">
                    <!-- .card-body -->
                    <div class="card-body">
                        <form action="{{ route('admin.update.featured', $featured->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Title -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Title</h4>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title"
                                            value="{{ old('title', $featured->title) }}">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Icon -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Icon Tag</h4>
                                        <input type="text" name="icon" class="form-control"
                                            placeholder="Paste icon code here" value="{{ old('icon', $featured->icon) }}">
                                        @error('icon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h4>Description</h4>
                                        <div id="summernote-description" data-toggle="summernote"
                                            data-placeholder="Enter Description" data-height="150">
                                            {!! old('description', $featured->description) !!}
                                        </div>
                                        <input type="hidden" name="description" id="description"
                                            value="{{ old('description', $featured->description) }}">
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Image -->
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Image</h4>
                                        <input type="file" name="image" class="form-control">
                                        @if ($featured->image)
                                            <small>Current Image:</small><br>
                                            <img src="{{ asset('uploads/featured/images/' . $featured->image) }}"
                                                alt="Current Image" width="100">
                                        @endif
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Status -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Status</h4>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status', $featured->status) == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ old('status', $featured->status) == 0 ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>


                    </div><!-- /.card-body -->

                </div><!-- /.card -->
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->


@endsection

@push('custom_js')
    <script>
        $(document).ready(function () {
            $(document).on('theme:init', function () {
                new SummernoteDemo();
            });
            $('#summernote-description').summernote({
                placeholder: 'Enter Description',
                height: 150
            });

            // Fix here: sync summernote-description to description input
            $('form').on('submit', function () {
                $('#description').val($('#summernote-description').summernote('code'));
            });
        });
    </script>

@endpush