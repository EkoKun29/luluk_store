@extends('receivable-payment.index')
@section('name')
    TRANSFER
@endsection
@section('create-link')
    <a href="{{ route('receivable-payments.transfer.create') }}" class="btn btn-primary">Tambah</a>
@endsection
@section('table')
<table class="table table-striped" style="width: 100%;" id="tableReceivableTransfer">
    <thead>
        <tr>
            <th>
                <h6>Tanggal</h6>
            </th>
            <th>
                <h6>No Nota Piutang</h6>
            </th>
            <th>
                <h6>Tgl Nota Piutang</h6>
            </th>
            <th>
                <h6>Nominal</h6>
            </th>
            <th>
                <h6>Metode</h6>
            </th>
            <th>
                <h6>Action</h6>
            </th>
        </tr>
        <!-- end table row-->
    </thead>
    <tbody>
        @foreach ($receivablePayments as $receivablePayment)
            <tr>
                <td class="min-width">
                    <p>{{ $receivablePayment->date->isoFormat('dddd, D MMMM YYYY') }}</p>
                </td>
                <td class="min-width">
                    <p>{{ $receivablePayment->sale->note_number }}</p>
                </td>
                <td class="min-width">
                    <p>{{ $receivablePayment->sale->formatted_date }}</p>
                </td>
                <td class="min-width">
                    <p>{{ 'Rp ' . number_format($receivablePayment->amount_paid, 2, ',', '.') }}</p>
                </td>
                <td class="min-width">
                    <p>{{ $receivablePayment->method->name }}</p>
                </td>
                <td>
                    <div class="action">
                        <button class="text-danger" type="button" data-toggle="modal"
                            data-target="#deleteModal{{ $receivablePayment->id }}">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </div>
                    @include('receivable-payment.delete')
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
            let table = new DataTable('#tableReceivableTransfer');
        })
    </script>
@endpush
