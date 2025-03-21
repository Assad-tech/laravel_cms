@extends('backend.layout.master')
@section('title', 'About Us')
@push('custom_css')

@endpush
@section('content')

    {{-- AboutUs Section --}}
    <!-- .page -->
    <div class="page bg-white">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex justify-content-between">
                    <h1 class="page-title"> Manage About Us </h1>
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
                        <form action="{{ route('admin.update.about-us') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row pb-3">
                                <div class="col-sm-12">
                                    {{-- Heading --}}
                                    <div class="form-group">
                                        <h4>Heading</h4>
                                        <div id="summernote-heading" data-toggle="summernote"
                                            data-placeholder="Enter Heading" data-height="100">
                                            {!! old('heading', $about->heading ?? '') !!}
                                        </div>
                                        <input type="hidden" name="heading" id="heading">
                                        @error('heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-sm-12">
                                    {{-- Description --}}
                                    <div class="form-group">
                                        <h4>Description</h4>
                                        <div id="summernote-description" data-toggle="summernote"
                                            data-placeholder="Enter Description" data-height="150">
                                            {!! old('description', $about->description ?? '') !!}
                                        </div>
                                        <input type="hidden" name="description" id="description">
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    {{-- Image --}}
                                    <div class="form-group">
                                        <h4>Image</h4>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            name="image">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 text-center">
                                    @if(!empty($about->image))
                                        <div class="mt-2">
                                            <img src="{{ asset('front/assets/img/' . $about->image) }}" class="img rounded"
                                                width="220" alt="Current Image">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div><!-- /.card-body -->

                </div><!-- /.card -->
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->

    {{-- About Stats Section --}}
    <!-- .page -->
    <div class="page bg-white">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <h1 class="page-title">Manage Stats & Clients</h1>
                <p class="text-muted"></p><!-- /title -->
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid bg-light">
                    <!-- .card-header -->
                    <div class="card-header nav-scroller">
                        <!-- .nav-tabs -->
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#about-stats">About Stats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#about-clients">About Clients</a>
                            </li>
                        </ul><!-- /.nav-tabs -->
                    </div><!-- /.card-header -->
                    <!-- .card-body -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="about-stats" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <a href="{{route('admin.about-us.create.stats')}}" class="btn btn-primary mb-2">Add
                                            New
                                            Stats</a>
                                    </div>
                                    <div class="col-sm-12">
                                        @php
                                            $i = 1;
                                        @endphp
                                        <!-- Stats table -->
                                        <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Stats Title </th>
                                                    <th> Icon</th>
                                                    <th> Value</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stats as $data)
                                                    {{-- @dd($data) --}}
                                                    <tr>
                                                        <td> {{ $i++ }} </td>
                                                        <td> {{ $data->stats_title ?? 'N/A' }}</td>
                                                        <td>
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ $data->stats_icon }}">
                                                                {{ Str::limit($data->stats_icon ?? 'N/A', 20, '...') }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            {{ $data->stats_value ?? 'N/A' }}
                                                        </td>
                                                        <td class="m-3">
                                                            <div>
                                                                <a href="{{route('admin.about-us.edit.stats', $data->id)}}"
                                                                    class="btn btn-info">Edit</a>
                                                                <a href="{{route('admin.about-us.delete.stats', $data->id)}}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Stats Title </th>
                                                    <th> Icon</th>
                                                    <th> Value </th>
                                                    <th> Action</th>
                                                </tr>
                                            </tfoot>
                                        </table><!-- /.table -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="about-clients" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <a href="{{route('admin.about-us.create.client')}}" class="btn btn-primary mb-2">
                                            Add New Logo
                                        </a>
                                    </div>
                                    <div class="col-sm-12">
                                        @php
                                            $j = 1;
                                        @endphp
                                        <!-- Client Logos table -->
                                        <table id="dt-clients" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Client Logo</th>
                                                    <th> Link</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                    {{-- @dd($client) --}}
                                                    <tr>
                                                        <td> {{ $j++ }} </td>
                                                        <td>
                                                            <img width="100"
                                                                src="{{ asset('front/assets/img/clients/' . $client->company_logo) }}"
                                                                alt="" class="img rounded">
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ $client->company_link }}">
                                                                {{ Str::limit($client->company_link ?? 'N/A', 50, '...') }}
                                                            </span>
                                                        </td>
                                                        <td class="m-3">
                                                            <div>
                                                                <a href="{{route('admin.about-us.edit.client', $client->id)}}"
                                                                    class="btn btn-info">Edit</a>
                                                                <a href="{{route('admin.about-us.delete.client', $client->id)}}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Client Logo</th>
                                                    <th> Link</th>
                                                    <th> Action</th>
                                                </tr>
                                            </tfoot>
                                        </table><!-- /.table -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->

@endsection

@push('custom_js')

    <script src="{{asset('admin/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/javascript/pages/dataTables.bootstrap.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#dt-responsive').DataTable({
                responsive: true,
                autoWidth: false,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'table-responsive'tr>" +
                    "<'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                language: {
                    paginate: {
                        previous: '<i class="fa fa-lg fa-angle-left"></i>',
                        next: '<i class="fa fa-lg fa-angle-right"></i>'
                    }
                },
            });
            $('#dt-clients').DataTable({
                responsive: true,
                autoWidth: false,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'table-responsive'tr>" +
                    "<'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                language: {
                    paginate: {
                        previous: '<i class="fa fa-lg fa-angle-left"></i>',
                        next: '<i class="fa fa-lg fa-angle-right"></i>'
                    }
                },
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Initialize summernote
            $('#summernote-heading').summernote();
            $('#summernote-description').summernote();

            // Sync summernote data on submit
            $('form').on('submit', function () {
                $('#heading').val($('#summernote-heading').summernote('code'));
                $('#description').val($('#summernote-description').summernote('code'));
            });
        });
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush