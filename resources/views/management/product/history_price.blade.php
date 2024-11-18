<!-- Modal -->
<div class="modal fade" id="pricesModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Harga Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product->productPrices as $productPrice)
                        <tr>
                            <td>{{ $productPrice->local_created_at }}</td>
                            <td>{{ "Rp. " . number_format($productPrice->price, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@push('js')
@endpush
