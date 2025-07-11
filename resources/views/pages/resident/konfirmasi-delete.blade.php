<style>
    /* Variabel Warna Global (pastikan sama dengan layouts.app atau tempat lain yang terpusat) */
    :root {
        --primary-main: #3F51B5; /* Deep Indigo (Biru dominan) */
        --primary-light: #7986CB;
        --primary-dark: #303F9F;
        --accent-color: #FFC107; /* Amber (Oranye aksen) */
        --accent-dark: #FFA000;

        --background-body: #EFEFEF; /* Latar belakang abu-abu muda */
        --card-bg: #FFFFFF; /* Latar belakang kartu putih */
        --text-dark: #212121; /* Teks gelap */
        --text-medium: #616161; /* Teks sedang */
        --text-light: #9E9E9E; /* Teks terang */
        --shadow-color-1: rgba(0, 0, 0, 0.08); /* Bayangan ringan */
        --shadow-color-2: rgba(0, 0, 0, 0.15); /* Bayangan sedang */
        --border-main: #DEDEDE; /* Warna border */

        /* Override Bootstrap colors for consistency */
        --bs-danger: #DC3545; /* Merah untuk bahaya */
        --bs-secondary: #6c757d; /* Abu-abu untuk sekunder */
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px; /* Sudut modal lebih membulat */
        box-shadow: 0 10px 30px var(--shadow-color-2); /* Bayangan yang lebih kuat */
        border: none; /* Hilangkan border default modal */
        overflow: hidden; /* Pastikan konten tidak keluar dari radius */
    }

    .modal-header {
        background-color: var(--primary-main); /* Header modal dengan warna biru primer */
        color: white; /* Teks header putih */
        border-bottom: none; /* Hilangkan border bawah header */
        padding: 1.5rem 2rem; /* Padding lebih besar */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-weight: 700 !important; /* Judul modal lebih tebal */
        font-size: 1.5rem; /* Ukuran font judul lebih besar */
        color: white; /* Pastikan warna teks judul putih */
    }

    .modal-header .btn-close,
    .modal-header .btn-default { /* Target button close di header */
        background-color: transparent;
        border: none;
        color: white; /* Ikon close putih */
        opacity: 0.8;
        font-size: 1.2rem;
        padding: 0.5rem;
        transition: opacity 0.2s ease;
    }

    .modal-header .btn-close:hover,
    .modal-header .btn-default:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 2rem; /* Padding konten modal lebih besar */
        font-size: 1.1rem; /* Ukuran font teks pesan */
        color: var(--text-medium); /* Warna teks pesan */
        line-height: 1.5;
        text-align: center; /* Teks pesan rata tengah */
    }

    .modal-footer {
        border-top: none; /* Hilangkan border atas footer */
        padding: 1.5rem 2rem; /* Padding footer lebih besar */
        background-color: var(--background-body); /* Latar belakang footer abu-abu muda */
        display: flex;
        justify-content: center; /* Rata tengah tombol-tombol */
        gap: 15px; /* Jarak antar tombol */
    }

    /* Tombol Batal */
    .modal-footer .btn-secondary {
        background-color: var(--bs-secondary); /* Warna abu-abu Bootstrap */
        border-color: var(--bs-secondary);
        color: white;
        border-radius: 8px; /* Sudut tombol lebih membulat */
        padding: 0.8rem 1.5rem; /* Padding tombol */
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.2);
    }

    .modal-footer .btn-secondary:hover {
        background-color: #5a6268; /* Sedikit lebih gelap saat hover */
        border-color: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(108, 117, 125, 0.3);
    }

    /* Tombol Ya, hapus! */
    .modal-footer .btn-outline-danger {
        background-color: var(--bs-danger); /* Menggunakan warna merah solid */
        border-color: var(--bs-danger);
        color: white; /* Teks putih */
        border-radius: 8px; /* Sudut tombol lebih membulat */
        padding: 0.8rem 1.5rem; /* Padding tombol */
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
    }

    .modal-footer .btn-outline-danger:hover {
        background-color: #bd2130; /* Merah sedikit lebih gelap saat hover */
        border-color: #bd2130;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
    }
</style>

<div class="modal fade" id="konfirmasiDelete-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <form action="/resident/{{$item->id}}" method="post">
      @csrf
      @method('DELETE')
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="konfirmasiDeleteLabel"><b>HAPUS DATA!</b></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span>Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-danger">Ya, Hapus!</button>
          </div>
        </div>
    </form>
  </div>
</div>