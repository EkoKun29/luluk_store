<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Masukkan Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="input-style-1">
                        <label>Nama</label>
                        <input type="text" placeholder="Nama Pengguna" name="name" required>
                    </div>
                    <div class="input-style-1">
                        <label>Kode</label>
                        <input type="text" placeholder="Kode Pengguna" onkeydown="return /[a-z]/i.test(event.key)" maxlength="5" name="code" required>
                    </div>
                    <div class="input-style-1">
                        <label>Email</label>
                        <input type="email" placeholder="Alamat Email" name="email" required>
                    </div>
                    <div class="input-style-1">
                        <label>Kata Sandi</label>
                        <input type="password" placeholder="Kata Sandi" name="password" required>
                    </div>
                    <div class="input-style-1">
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" placeholder="Konfirmasi Kata Sandi" name="password_confirmation" required>
                    </div>
                    <div class="select-style-1">
                        <label>Role</label>
                        <div class="select-position">
                            <select name="role" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="main-btn primary-btn rounded-md btn-hover">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
