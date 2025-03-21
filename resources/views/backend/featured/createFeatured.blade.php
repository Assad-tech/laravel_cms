@extends('backend.layout.master')
@section('title', 'Add new featured')
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
                    <h1 class="page-title"> Add new Featured </h1>
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
                        <form action="{{ route('admin.store.featured') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    {{-- Title --}}
                                    <div class="form-group">
                                        <h4>Title</h4>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title"
                                            value="{{ old('title', $content->title ?? '') }}">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    {{-- Icon --}}
                                    <div class="form-group">
                                        <h4>Icon Tag</h4>
                                        <input type="text" name="icon" class="form-control"
                                            placeholder="Paste icon code here">
                                        @error('icon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    {{-- Description --}}
                                    <div class="form-group">
                                        <h4>Description</h4>
                                        <div id="summernote-description" data-toggle="summernote"
                                            data-placeholder="Enter Description" data-height="150">
                                        </div>
                                        <input type="hidden" name="description" id="description">
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Image --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Image</h4>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
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