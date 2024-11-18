@extends('layouts.app')
@section('title')
    Manajemen Pengguna
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">

            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Pengguna</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Management</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Pengguna
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            <div class="row mb-3">
                <div class="col-10">

                </div>
                <div class="col-2">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createModal">Tambah
                        Pengguna</button>
                    @include('management.user.create')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Data Pengguna</h6>
                            <div class="table-wrapper table-responsive">
                                <table id="tableUser" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>#</h6>
                                            </th>
                                            <th>
                                                <h6>Nama</h6>
                                            </th>
                                            <th>
                                                <h6>Kode</h6>
                                            </th>
                                            <th>
                                                <h6>Email</h6>
                                            </th>
                                            <th>
                                                <h6>Role</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="min-width">
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $user->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $user->code }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $user->email }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ ucwords($user->roles[0]->name) }}</p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <button class="text-success" type="button" data-toggle="modal"
                                                            data-target="#editModal{{ $user->id }}">
                                                            <i class="lni lni-pencil"></i>
                                                        </button>
                                                        <button class="text-danger" type="button" data-toggle="modal"
                                                            data-target="#deleteUser{{ $user->id }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                    @include('management.user.edit')
                                                    @include('management.user.delete')
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let table = new DataTable('#tableUser', {
                "columnDefs": [{
                    "targets": 5,
                    "orderable": false
                }]
            });
        })
    </script>
@endpush
