<!-- Modal -->
<div class="modal fade" id="editModal{{ $noRekening->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data No Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('norekenings.update', $noRekening->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="select-style-1">
                        <label>Bank</label>
                        <div class="select-position">
                            <select name="bank_id" id="edit_bank_id" required>
                                <option value="">Pilih Bank</option>
                                @foreach ($banks as $bank)
                                    <option @selected($noRekening->bank_id == $bank->id) value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>No Rekening</label>
                        <input type="number" placeholder="No Rekening" name="name" value="{{ $noRekening->name }}" required>
                    </div>
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush