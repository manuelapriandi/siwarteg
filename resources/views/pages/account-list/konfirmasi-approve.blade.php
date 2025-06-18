<div class="modal fade" id="konfirmasiApprove-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiApproveLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/account-request/approval/{{$item->id}}" method="post">
      @csrf
      @method('POST')
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="konfirmasiApproveLabel"><b>Konfirmasi Aktivasi</b></h4>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="for" value="activate">
            <span>Apakah anda ingin mengaktifkan akun ini?</span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Ya, aktifkan akun!</button>
          </div>
        </div>
    </form>
    
  </div>
</div>