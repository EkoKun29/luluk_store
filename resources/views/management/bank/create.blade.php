<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Data Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('banks.store') }}" method="POST">
                    @csrf
                    <div class="input-style-1">
                        <label>Nama</label>
                        <input type="text" placeholder="Nama" name="name" required>
                    </div>
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
