@extends('layouts.app')
@section('title')
    Manajemen Barang
@endsection
@section('content')
    <section class="table-components">
        <div class="container-fluid">

            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Barang</h2>
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
                                        Barang
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
                        Barang</button>
                    @include('management.product.create')
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
                            <h6 class="mb-10">Data Barang</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>#</h6>
                                            </th>
                                            <th>
                                                <h6>Nama</h6>
                                            </th>
                                            <th>
                                                <h6>Satuan</h6>
                                            </th>
                                            <th>
                                                <h6>Harga Terbaru</h6>
                                            </th>
                                            <th>
                                                <h6>Stok Tersedia</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="min-width">
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $product->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $product->unit }}</p>
                                                </td>
                                                <td class="min-width">
                                                    @if ($product->productPrice?->price == null)
                                                        <button class="btn btn-sm btn-primary" role="button"
                                                            data-toggle="modal"
                                                            data-target="#createPrice{{ $product->id }}">Tetapkan
                                                            Harga</button>
                                                    @else
                                                        <p>{{ 'Rp ' . number_format($product->productPrice->price, 2, ',', '.') }}
                                                        </p>
                                                        <button class="btn btn-sm btn-danger"
                                                            style="padding: 1.5px 3px !important;" role="button"
                                                            data-toggle="modal"
                                                            data-target="#createPrice{{ $product->id }}">Tambah
                                                            Harga</button>
                                                    @endif
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $product->current_stock }}</p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <button class="text-info" type="button" data-toggle="modal"
                                                            data-target="#pricesModal{{ $product->id }}">
                                                            <i class="lni lni-clipboard"></i>
                                                        </button>
                                                        <button class="text-success" type="button" data-toggle="modal"
                                                            data-target="#editModal{{ $product->id }}">
                                                            <i class="lni lni-pencil"></i>
                                                        </button>
                                                        <button class="text-danger" type="button" data-toggle="modal"
                                                            data-target="#deleteProduct{{ $product->id }}">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                    @include('management.product.edit')
                                                    @include('management.product.history_price')
                                                    @include('management.product.create_price')
                                                    @include('management.product.delete')
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                            {{-- Paginate --}}
                            <div class="d-flex justify-content-end mt-2">
                                {{ $products->links() }}
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
@endpush
