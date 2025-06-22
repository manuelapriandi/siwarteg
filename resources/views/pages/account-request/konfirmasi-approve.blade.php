<div class="modal fade" id="konfirmasiApprove-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiApproveLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/account-request/approval/{{$item->id}}" method="post">
      @csrf
      @method('POST')
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="konfirmasiApproveLabel"><b>Konfirmasi Setuju</b></h4>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="for" value="approve">
            <span>Apakah anda menyetujui akun ini?</span>
            <div class="form-group mt-3">
              <label for="resident_id">Pilih Warga</label>
              <select name="resident_id" id="resident_id" class="form-control">
                <option value="">Tidak ada</option>
                @foreach ($residents as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Ya, saya setuju!</button>
          </div>
        </div>
    </form>
    
  </div>
</div>