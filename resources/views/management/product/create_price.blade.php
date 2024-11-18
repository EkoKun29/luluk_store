<!-- Modal -->
<div class="modal fade" id="createPrice{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Harga Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.price.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="input-style-1">
                        <label>Harga</label>
                        <input type="number" min="0" placeholder="Harga" name="price">
                    </div>
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>


@push('js')
@endpush
