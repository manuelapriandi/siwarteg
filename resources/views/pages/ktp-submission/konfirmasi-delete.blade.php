<div class="modal fade" id="konfirmasiDelete-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/ktp-submission/{{$item->id}}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="konfirmasiDeleteLabel"><b>HAPUS DATA!</b></h4>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <span>Apakah anda ingin menghapus pengajuan berkas ini?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-danger">Ya, hapus!</button>
                </div>
            </div>
        </form>
    </div>
</div>