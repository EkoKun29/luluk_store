@extends('sale.index')
@section('name')
@section('name')
    CASH
@endsection
@endsection
@section('create-link')
    <a href="{{ route('sales.cash.create') }}" class="btn btn-primary">Tambah</a>
@endsection
@section('table')
    <table class="table table-striped" id="tableCashSale" style="width: 100%;">
        <thead>
            <tr>
                <th>
                    <h6>#</h6>
                </th>
                <th>
                    <h6>Tanggal</h6>
                </th>
                <th>
                    <h6>Nota</h6>
                </th>
                <th>
                    <h6>Konsumen</h6>
                </th>
                <th>
                    <h6>Total</h6>
                </th>
                <th>
                    <h6>Dibayar</h6>
                </th>
                <th>
                    <h6>Kembalian</h6>
                </th>
                <th>
                    <h6>Aksi</h6>
                </th>
            </tr>
            <!-- end table row-->
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td class="min-width">
                        <p>{{ $loop->iteration }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $sale->formatted_date }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $sale->note_number }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $sale->consumer }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ 'Rp ' . number_format($sale->total, 2, ',', '.') }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ 'Rp ' . number_format($sale->amount_paid, 2, ',', '.') }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ 'Rp ' . number_format($sale->amount_paid - $sale->total, 2, ',', '.') }}</p>
                    <td>
                        <div class="action">
                            <a class="text-success" type="button" href="{{ route('sales.cash.show', $sale->id) }}">
                                <i class="lni lni-eye"></i>
                            </a>
                            <button class="text-danger" type="button" data-toggle="modal" data-target="#deleteSale{{ $sale->id }}">
                                <i class="lni lni-trash-can"></i>
                            </button>
                            <a class="text-primary" target="_blank" type="button" href="{{ route('sale.print', $sale->id) }}">
                                <i class="lni lni-printer"></i>
                            </a>
                        </div>
                        @include('sale.components.delete')
                    </td>
                </tr>
            @endforeach
            <!-- end table row -->
        </tbody>
    </table>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        let table = new DataTable('#tableCashSale', {
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }]
        });
    })
</script>
@endpush
