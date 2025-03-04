<!-- Modal -->
<div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus User {{ $user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="main-btn danger-btn rounded-md btn-hover">Hapus</button>
                    <button type="button" data-dismiss="modal"
                        class="main-btn secondary-btn rounded-md btn-hover">Batal</button>
                </form>
            </div>

        </div>
    </div>
</div>


@push('js')
@endpush
