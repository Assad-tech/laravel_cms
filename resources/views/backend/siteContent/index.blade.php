@extends('backend.layout.master')
@section('title', 'Site Content')
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
                    <h1 class="page-title"> Manage Site Content </h1>
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
                        <form action="{{ route('admin.site-content.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Phone and Logo --}}
                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    <div class="text-center m-2">
                                        <img src="{{asset('front/assets/img/' . $logo->logo)}}" class="img w-25" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Phone</h4>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" id="phone" placeholder="Enter Phone" value="{{ $phone->phone }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h4>Site logo</h4>
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                            name="logo" value="{{$logo->logo}}" id="">
                                    </div>
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Email</h4>
                                        <input type="email" placeholder="Enter Email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- Email and Address --}}
                            <div class="row ob-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Address</h4>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Enter Address">{{ $address->address }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h4>Copyright</h4>
                                        <input type="text" placeholder="Enter Copyright"
                                            class="form-control @error('copyright') is-invalid @enderror" name="copyright"
                                            value="{{ $copyright->copyright }}">
                                        @error('copyright')
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