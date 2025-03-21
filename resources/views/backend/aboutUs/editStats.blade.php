@extends('backend.layout.master')
@section('title', 'Update Stats')
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
                    <h1 class="page-title"> Update Stats </h1>
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
                        <form action="{{ route('admin.about-us.update.stats', $stats->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    {{-- Stats Icon --}}
                                    <div class="form-group">
                                        <h4>Stats Icon</h4>
                                        <input type="text" name="stats_icon" class="form-control"
                                            placeholder="Paste icon code here" value="{{ $stats->stats_icon }}">
                                        @error('stats_icon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    {{-- Stats Title --}}
                                    <div class="form-group">
                                        <h4>Stats Title</h4>
                                        <input type="text" name="stats_title" class="form-control"
                                            placeholder="Enter Stats Title" value="{{ $stats->stats_title }}">
                                        @error('stats_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    {{-- Stats Value --}}
                                    <div class="form-group">
                                        <h4>Stats Value</h4>
                                        <input type="number" name="stats_value" class="form-control"
                                            placeholder="Enter Stats Value" value="{{ $stats->stats_value }}">
                                        @error('stats_value')
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