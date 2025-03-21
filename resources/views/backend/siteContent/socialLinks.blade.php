@extends('backend.layout.master')
@section('title', 'Social Links')
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
                    <h1 class="page-title"> Manage Social Links </h1>
                    <div class="btn-toolbar">
                        {{-- <button type="button" class="btn btn-primary">Add team</button> --}}
                    </div>
                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid bg-light">
                    <!-- .card-header -->
                    {{-- <div class="card-header nav-scroller">
                        <!-- .nav-tabs -->
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#project-myteams">My teams</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#project-explore-teams">Explore public teams</a>
                            </li>
                        </ul><!-- /.nav-tabs -->

                    </div><!-- /.card-header --> --}}
                    <!-- .card-body -->
                    <div class="card-body">
                        <form action="{{ route('admin.social-links.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Social Links and Site Logo --}}
                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Facebook</h4>
                                        <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                            name="facebook" id="" placeholder="Enter Facebook Link"
                                            value="{{ $fb->facebook ?? '' }}">
                                        @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Instagram</h4>
                                        <input type="url" class="form-control @error('instagram') is-invalid @enderror"
                                            name="instagram" id="" placeholder="Enter Instagram Link"
                                            value="{{ $insta->instagram ?? '' }}">
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>LinkedIn</h4>
                                        <input type="url" class="form-control @error('linkedin') is-invalid @enderror"
                                            name="linkedin" id="" placeholder="Enter LinkedIn Link"
                                            value="{{ $linkedin->linkedin ?? '' }}">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Twitter</h4>
                                        <input type="url" class="form-control @error('twitter') is-invalid @enderror"
                                            name="twitter" id="" placeholder="Enter Twitter Link"
                                            value="{{ $twitter->twitter ?? '' }}">
                                        @error('twitter')
                                            <div class="invalid-feedback">{{ $message }}</div>
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

@endpush