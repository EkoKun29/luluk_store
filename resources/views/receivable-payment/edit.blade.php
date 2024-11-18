<!-- Modal -->
<div class="modal fade" id="editModal{{ $receivablePayment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Edit Data Pembayaran Piutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('receivable-payments.update', $receivablePayment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-style-1">
                        <label>No Nota Piutang</label>
                        <select name="purchase_id" id="" class="form-control" required>
                            @foreach ($sales as $sale)
                                <option value="{{ $sale->id }}">{{ $sale->nota_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-style-1">
                        <label>Tgl Nota Piutang</label>
                        <input type="date" placeholder="Tgl Nota Piutang" name="date" required>
                    </div>
                    <div class="input-style-1">
                        <label>Nominal</label>
                        <input type="number" min="0" placeholder="Nominal" name="amount_paid" required>
                    </div>
                    <div class="input-style-1">
                        <label>Metode</label>
                        <select name="method" id="" class="form-control" required>
                            <option value="">Cash</option>
                            <option value="">Transfer</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>


@push('js')
@endpush
