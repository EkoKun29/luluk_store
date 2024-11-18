<!-- Modal -->
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-style-1">
                        <label>Nama Barang</label>
                        <input type="text" placeholder="Nama Barang" name="name" value="{{ $product->name }}"
                            required>
                    </div>
                    <div class="select-style-1">
                        <label>Ukuran</label>
                        <div class="select-position">
                            <select name="unit" required>
                                @foreach (['METER', 'BIJI', 'LUSIN', 'GROSS', 'ONS', 'MASS', 'LITER', 'PIS', 'PASANG', 'PAK', 'ROL', 'KG', 'BUNGKUS'] as $item)
                                    <option value="{{ $item }}" {{ $product->unit == $item ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-style-1">
                        <label>Stok Awal</label>
                        <input type="number" min="0" step="0.01" placeholder="Stok Awal Barang" name="stock" value="{{ $product->stock }}" required>
                    </div>
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>


@push('js')
@endpush
