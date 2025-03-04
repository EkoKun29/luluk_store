@extends('layouts.app')
@section('title')
    Manajemen Bank
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">

            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Bank</h2>
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
                                        Bank
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
                        Bank</button>
                    @include('management.bank.create')
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
                            <h6 class="mb-10">Data Bank</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>#</h6>
                                            </th>
                                            <th>
                                                <h6>Nama</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @foreach ($banks as $bank)
                                            <tr>
                                                <td class="min-width">
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $bank->name }}</p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <button class="text-success" type="button" data-toggle="modal"
                                                            data-target="#editModal{{ $bank->id }}">
                                                            <i class="lni lni-pencil"></i>
                                                        </button>
                                                        <button class="text-danger" type="button" data-toggle="modal"
                                                            data-target="#deleteUser{{ $bank->id }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                    @include('management.bank.edit')
                                                    @include('management.bank.delete')
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
        
    </script>
@endpush
