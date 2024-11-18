@extends('debt-payment.index')
@section('name')
    CASH
@endsection
@section('create-link')
    <a href="{{ route('debt-payments.cash.create') }}" class="btn btn-primary">Tambah</a>
@endsection
@section('table')
    <table class="table table-striped" style="width: 100%;" id="tableDebtPaymentCash">
        <thead>
            <tr>
                <th>
                    <h6>Tanggal</h6>
                </th>
                <th>
                    <h6>Supplier</h6>
                </th>
                <th>
                    <h6>No Nota Hutang</h6>
                </th>
                <th>
                    <h6>Tgl Nota Hutang</h6>
                </th>
                <th>
                    <h6>Nominal</h6>
                </th>
                <th>
                    <h6>Action</h6>
                </th>
            </tr>
            <!-- end table row-->
        </thead>
        <tbody>
            @foreach ($debtPayments as $debtPayment)
                <tr>
                    <td class="min-width">
                        <p>{{ $debtPayment->date->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $debtPayment->purchase->supplier }}</p>
                    <td class="min-width">
                        <p>{{ $debtPayment->purchase->note_number }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ $debtPayment->purchase->formatted_date }}</p>
                    </td>
                    <td class="min-width">
                        <p>{{ 'Rp ' . number_format($debtPayment->amount_paid, 2, ',', '.') }}</p>
                    </td>
                    <td>
                        <div class="action">
                            <button class="text-danger" type="button" data-toggle="modal"
                                data-target="#deleteModal{{ $debtPayment->id }}">
                                <i class="lni lni-trash-can"></i>
                            </button>
                        </div>
                        @include('debt-payment.delete')
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
        let table = new DataTable('#tableDebtPaymentCash', {
            "columnDefs": [{
                "targets": 4,
                "orderable": false
            }]
        });
    })
</script>
@endpush
