@extends('purchase.index')
@section('name')
    Transfer
@endsection
@section('create-link')
    <a href="{{ route('purchases.transfer.create') }}" class="btn btn-primary">Tambah</a>
@endsection
@section('table')
    <table class="table table-striped" id="tableTransferPurchase" style="width: 100%;">
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
                    <h6>Supplier</h6>
                </th>
                <th>
                    <h6>Total</h6>
                </th>
                <th>
                    <h6>Dibayar</h6>
                </th>
                <th>
                    <h6>Aksi</h6>
                </th>
            </tr>
            <!-- end table row-->
        </thead>
        <tbody>
            @foreach ($purchases as $purchase)
                <tr>
                    <td class="min-width">
                        <p>{{ $loop->iteration }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $purchase->formatted_date }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $purchase->note_number }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $purchase->supplier }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ 'Rp ' . number_format($purchase->total, 2, ',', '.') }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ 'Rp ' . number_format($purchase->amount_paid + $purchase->debt_paid_off, 2, ',', '.') }}</p>
                    </td>
                    <td>
                        <div class="action">
                            <a class="text-success" type="button" href="{{ route('purchases.transfer.show', $purchase->id) }}">
                                <i class="lni lni-eye"></i>
                            </a>
                            <button class="text-danger" type="button" data-toggle="modal" data-target="#deletePurchase{{ $purchase->id }}">
                                <i class="lni lni-trash-can"></i>
                            </button>
                            <a class="text-primary" target="_blank" type="button" href="{{ route('purchase.print', $purchase->id) }}">
                                <i class="lni lni-printer"></i>
                            </a>
                        </div>
                        @include('purchase.components.delete')
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
            let table = new DataTable('#tableTransferPurchase', {
                "columnDefs": [{
                    "targets": 6,
                    "orderable": false
                }]
            });
        })
    </script>
@endpush
