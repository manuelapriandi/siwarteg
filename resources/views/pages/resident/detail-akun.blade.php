<div class="modal fade" id="detailAkun-{{ $item->id }}" tabindex="-1" aria-labelledby="detailAkunLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="detailAkunLabel"><b>Detail Akun</b></h4>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="name">Nama</label>
              {{-- <input type="text" name="name" class="form-control" value="{{$item->user->name}}" readonly> --}}
              <input type="text" name="name" class="form-control" value="{{ $item->user?->name ?? 'Tidak ada data' }}" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="email">Email</label>
              {{-- <input type="text" name="email" class="form-control" value="{{ $item->user->email }}" readonly> --}}
              <input type="text" name="email" class="form-control" value="{{ $item->user?->email ?? 'Tidak ada data' }}" readonly>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          </div>
   </div>
  </div>
</div>