<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\KtpSubmissionController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware; // <<< PENTING: Import RoleMiddleware Anda

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

// Route::get('/dasbor', function () {
//     return view('pages.dasbor');
// })->middleware('role:Admin,User');

Route::get('/dasbor', [ComplaintController::class, 'dashboard'])
    ->middleware('role:Admin,User')
    ->name('dasbor');

Route::post('/notification/{id}/read', function($id){
    $notification = \Illuminate\Support\Facades\DB::table('notifications')->where('id', $id);
    $notification->update([
        'read_at' => \Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'),
    ]);

    $dataArray = json_decode($notification->firstOrFail()->data, true);

     if (isset($dataArray['type'])) {
        if ($dataArray['type'] == 'ktp_submission_status_changed' && isset($dataArray['ktp_submission_id'])) {
            // UBAH DARI .show KE .index UNTUK KTP SUBMISSION
            return redirect('ktp-submission');
        }
    }

    if (isset($dataArray['complaint_id'])){
        return redirect('/complaint');
    
    }

    return back();
})->middleware('role:Admin,User');

Route::get('notifications', function(){
    return view('pages.notifications');
});

Route::get('/resident', [ResidentController::class, 'index'])->middleware('role:Admin');
Route::get('/resident/create', [ResidentController::class, 'create'])->middleware('role:Admin');
Route::get('/resident/{id}', [ResidentController::class, 'edit'])->middleware('role:Admin');
Route::post('/resident', [ResidentController::class, 'store'])->middleware('role:Admin');
Route::put('/resident/{id}', [ResidentController::class, 'update'])->middleware('role:Admin');
Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->middleware('role:Admin');

Route::get('/daftar-akun', [UserController::class, 'account_list'])->middleware('role:Admin');

Route::get('/account-request', [UserController::class, 'view_account'])->middleware('role:Admin');
Route::post('/account-request/approval/{id}', [UserController::class, 'account_approval'])->middleware('role:Admin');

Route::get('/profil', [UserController::class, 'profil_view'])->middleware('role:Admin,User');
Route::post('/profil/{id}', [UserController::class, 'update_profil'])->middleware('role:Admin,User');
Route::get('/ubah-pw', [UserController::class, 'ubah_pw'])->middleware('role:Admin,User');
Route::post('/ubah-pw/{id}', [UserController::class, 'ubah_pww'])->middleware('role:Admin,User');


Route::get('/complaint', [ComplaintController::class, 'index'])->middleware('role:Admin,User');
Route::get('/complaint/create', [ComplaintController::class, 'create'])->middleware('role:User');
Route::get('/complaint/{id}', [ComplaintController::class, 'edit'])->middleware('role:User');
Route::post('/complaint', [ComplaintController::class, 'store'])->middleware('role:User');
Route::put('/complaint/{id}', [ComplaintController::class, 'update'])->middleware('role:User');
Route::delete('/complaint/{id}', [ComplaintController::class, 'destroy'])->middleware('role:User');
Route::post('complaint/update-status/{id}', [ComplaintController::class, 'update_status'])->middleware('role:Admin');


// --- Rute untuk Pengajuan KTP (KtpSubmission) ---
// Note: Middleware 'role' menggunakan string nama role, sesuai dengan implementasi RoleMiddleware.php Anda.

// Menampilkan daftar semua pengajuan KTP (Index)
// Bisa diakses oleh 'Admin' dan 'User'
Route::get('/ktp-submission', [KtpSubmissionController::class, 'index'])->middleware('role:Admin,User');

// Menampilkan form untuk membuat pengajuan KTP baru (Create)
// Hanya bisa diakses oleh 'User' (karena admin tidak mengajukan)
Route::get('/ktp-submission/create', [KtpSubmissionController::class, 'create'])->middleware('role:User');

Route::post('/ktp-submission', [KtpSubmissionController::class, 'store'])->middleware('role:User');
Route::get('/ktp-submission/{id}/edit', [KtpSubmissionController::class, 'edit'])->middleware('role:User');

// Memperbarui data pengajuan KTP di database (Update)
// Hanya bisa diakses oleh 'User'
Route::put('/ktp-submission/{id}', [KtpSubmissionController::class, 'update'])->middleware('role:User');

// Menghapus pengajuan KTP (Destroy)
// Hanya bisa diakses oleh 'User'
Route::delete('/ktp-submission/{id}', [KtpSubmissionController::class, 'destroy'])->middleware('role:User');

// Mengubah status pengajuan KTP (khusus Admin)
Route::post('/ktp-submission/update-status/{id}', [KtpSubmissionController::class, 'update_status'])->middleware('role:Admin');