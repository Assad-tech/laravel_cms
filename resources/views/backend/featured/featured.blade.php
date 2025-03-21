@extends('backend.layout.master')
@section('title', 'Featured')
@push('custom_css')

@endpush
@section('content')

    <!-- .page -->
    <div class="page bg-white">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <h1 class="page-title"> Manage Featured</h1>
                {{-- <p class="text-muted"> Resize your browser window to see it in action. </p><!-- /title --> --}}
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid bg-light">
                    <!-- .card-header -->
                    <div class="card-header">
                        <a href="{{route('admin.add.featured')}}" class="btn btn-primary ">Add New Featured</a>
                    </div>
                    @php
                        $i = 1;
                    @endphp
                    <!-- .card-body -->
                    <div class="card-body">
                        <!-- .table -->
                        <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th> Icon</th>
                                    <th> Slug</th>
                                    {{-- <th> Image </th> --}}
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allFeatured as $data)
                                    {{-- @dd($data) --}}
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ $data->title ?? 'N/A' }}</td>
                                        <td>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ strip_tags($data->description) }}">
                                                {{ Str::limit(strip_tags($data->description ?? 'N/A'), 40, '...') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $data->icon }}">
                                                {{ Str::limit($data->icon ?? 'N/A', 20, '...') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $data->slug }}">
                                                {{ Str::limit($data->slug ?? 'N/A', 20, '...') }}
                                            </span>

                                        </td>
                                        {{-- <td>
                                            <img class="img rounded" width="100"
                                                src="{{asset('front/assets/img/banners/' . $data->banner)}}"
                                                alt="{{$data->site_name}}">
                                        </td> --}}
                                        <td class="m-3">
                                            <div>
                                                <a href="{{route('admin.edit.featured', $data->id)}}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{route('admin.delete.featured', $data->id)}}"
                                                    class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th> Icon</th>
                                    <th> Slug</th>
                                    {{-- <th> Image </th> --}}
                                    <th> Action</th>
                                </tr>
                            </tfoot>
                        </table><!-- /.table -->
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
        });
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush