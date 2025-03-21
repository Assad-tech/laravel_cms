@extends('backend.layout.master')
@section('title', 'Add new Home')
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
                    <h1 class="page-title"> Add new Home </h1>
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
                        <form action="{{ route('admin.store.home') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    {{-- Greeting --}}
                                    <div class="form-group">
                                        <h4>Greeting</h4>
                                        <input type="text" name="greeting" class="form-control" placeholder="Enter Greeting"
                                            value="{{ old('greeting', $content->greeting ?? '') }}">
                                        @error('greeting')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    {{-- Site Name --}}
                                    <div class="form-group">
                                        <h4>Site Name</h4>
                                        <input type="text" name="site_name" class="form-control"
                                            placeholder="Enter Site Name"
                                            value="{{ old('site_name', $content->site_name ?? '') }}">
                                        @error('site_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    {{-- Banner Description --}}
                                    <div class="form-group">
                                        <h4>Banner Description</h4>
                                        <div id="summernote-banner" data-toggle="summernote"
                                            data-placeholder="Enter Banner Description" data-height="150">
                                        </div>
                                        <input type="hidden" name="banner_description" id="banner_description">
                                        @error('banner_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    {{-- Banner --}}
                                    <div class="form-group">
                                        <h4>Banner</h4>
                                        <input type="file" name="banner_image" class="form-control">
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Banner Link -->
                                    <div class="form-group">
                                        <h4>Banner Link</h4>
                                        <input type="url" name="link_on_banner" class="form-control"
                                            placeholder="Enter Banner Link"
                                            value="{{ old('link_on_banner', $content->banner_link ?? '') }}">
                                        @error('link_on_banner')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Link Text -->
                                    <div class="form-group">
                                        <h4>Link Text</h4>
                                        <input type="text" name="link_text" class="form-control"
                                            placeholder="Enter Link Text"
                                            value="{{ old('link_text', $content->link_text ?? '') }}">
                                        @error('link_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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

            // Update the hidden input when the form is submitted
            $('form').on('submit', function () {
                $('#banner_description').val($('#summernote-banner').summernote('code'));
            });
        });
    </script>

@endpush