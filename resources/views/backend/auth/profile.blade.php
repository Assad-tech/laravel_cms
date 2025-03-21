@extends('backend.layout.master')
@section('title', 'Profile')
@push('custom_css')

@endpush
@section('content')
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            {{-- <header class="page-title-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="user-profile.html"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                        </li>
                    </ol>
                </nav>
            </header><!-- /.page-title-bar --> --}}
            <!-- .page-section -->
            <div class="page-section">
                <!-- grid row -->
                <div class="row tex">
                    <!-- grid column -->
                    <div class="col-lg-12">
                        <!-- .card -->
                        <div class="card card-fluid">
                            <h6 class="card-header"> Public Profile </h6><!-- .card-body -->
                            <div class="card-body">
                                <form action="{{ route('admin.profile.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- .media -->
                                    <div class="media mb-3">
                                        <!-- avatar -->
                                        <div class="user-avatar user-avatar-xl fileinput-button">
                                            <div class="fileinput-button-label"> Change photo </div>
                                            <img src="{{ $admin->image ? asset('admin/assets/images/avatars/' . $admin->image) : asset('admin/assets/images/avatars/profile.jpg') }}"
                                                alt="Profile Image">

                                            <input id="fileupload-avatar" type="file" name="profile_image">
                                        </div><!-- /avatar -->
                                        <!-- .media-body -->
                                        <div class="media-body pl-3">
                                            <h3 class="card-title"> Profile Photo </h3>
                                            <h6 class="card-subtitle text-muted"> Click the current avatar to change your
                                                photo.
                                            </h6>
                                            <p class="card-text">
                                                <small>JPG, GIF or PNG 400x400, &lt; 2 MB.</small>
                                            </p><!-- The avatar upload progress bar -->
                                            <div id="progress-avatar" class="progress progress-xs fade">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div><!-- /avatar upload progress bar -->
                                        </div><!-- /.media-body -->
                                    </div><!-- /.media -->
                                    <!-- form row -->
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="input01">Full Name</label>
                                            <input type="text" class="form-control" id="input01" name="name"
                                                value="{{ old('name', $admin->name) }}" >
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="input03">Email</label>
                                            <input type="email" class="form-control" id="input03" name="email"
                                                value="{{ old('email', $admin->email) }}" >
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="input04">Current Password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                placeholder="Enter Current Password" id="input04">
                                            @error('current_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="input04">New Password</label>
                                            <input type="password" name="new_password" class="form-control" id="input04"
                                                placeholder="Enter New Password">
                                            @error('new_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="input04">Confirm Password</label>
                                            <input type="password" class="form-control" name="new_password_confirmation"
                                                id="input04" placeholder="Enter Confirm Password">
                                            @error('new_password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div><!-- /form row -->
                                    <hr>
                                    <!-- .form-actions -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary text-nowrap ml-auto">
                                            Update Profile
                                        </button>
                                    </div><!-- /.form-actions -->
                                </form><!-- /form -->

                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                        <!-- .card -->

                    </div><!-- /grid column -->
                </div><!-- /grid row -->
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
@endsection

@push('custom_js')

@endpush