<?php

namespace App\Http\Controllers;

use App\Models\KtpSubmission;
use App\Models\Role; // Assuming Role model exists for ROLE_ADMIN, ROLE_USER
use App\Models\User; // To send notifications to user (optional)
use App\Notifications\KtpSubmissionStatusChanged; // You'll create this notification later
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KtpSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $residentId = Auth::user()->resident->id ?? null; // Null if no resident linked

        $ktpSubmissions = KtpSubmission::when(Auth::user()->role_id == Role::ROLE_USER, function ($query) use ($residentId) {
            // Only show submissions for the logged-in resident
            $query->where('resident_id', $residentId);
        })
        ->orderByDesc('created_at') // Sort by latest
        ->paginate(5); // Pagination, adjust as needed

        return view('pages.ktp-submission.index', compact('ktpSubmissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/ktp-submission')->with('error', 'Akun Anda belum terhubung dengan data warga manapun. Silakan lengkapi profil warga Anda terlebih dahulu.');
        }

        $submissionTypes = [
            'KK' => 'KK',
            'KTP' => 'KTP',
            'akta kelahiran' => 'Akta Kelahiran',
            'akta kematian' => 'Akta Kematian',
            'SKCK' => 'SKCK',
        ];

        return view('pages.ktp-submission.create', compact('submissionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'submission_type' => ['required', Rule::in([
                'KK',
                'KTP',
                'akta kelahiran',
                'akta kematian',
                'SKCK'
            ])],
            'notes' => ['nullable', 'string', 'max:2000'],
            'document_proof' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // Max 5MB for documents
        ]);

        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/ktp-submission')->with('error', 'Akun Anda belum terhubung dengan data warga manapun.');
        }

        $ktpSubmission = new KtpSubmission();
        $ktpSubmission->resident_id = $resident->id;
        $ktpSubmission->submission_type = $request->input('submission_type');
        $ktpSubmission->notes = $request->input('notes');
        $ktpSubmission->status = 'baru'; // Default status

        if ($request->hasFile('document_proof')) {
            // Store the file in 'public/ktp_documents'
            $filePath = $request->file('document_proof')->store('ktp_documents', 'public');
            $ktpSubmission->document_proof = $filePath;
        } else {
             // Handle case where document_proof is required but not uploaded (should be caught by validation)
             return redirect()->back()->withInput()->with('error', 'Dokumen bukti wajib diunggah.');
        }

        $ktpSubmission->save();

        return redirect('/ktp-submission')->with('success', 'Berhasil membuat pengajuan berkas.');
    }


    public function show($id)
    {
        $ktpSubmission = KtpSubmission::findOrFail($id);
        if (Auth::user()->role_id == Role::ROLE_USER && $ktpSubmission->resident->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('pages.ktp-submission.show', compact('ktpSubmission'));
    }

    public function edit($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/ktp-submission')->with('error', 'Akun Anda belum terhubung dengan data warga manapun.');
        }

        $ktpSubmission = KtpSubmission::findOrFail($id);

        if ($ktpSubmission->status != 'baru' || $ktpSubmission->resident_id != $resident->id) {
            return redirect('/ktp-submission')->with('error', "Gagal mengubah pengajuan, karena statusnya sudah {$ktpSubmission->status_label} atau bukan pengajuan Anda.");
        }

        $submissionTypes = [
            'KK' => 'KK',
            'KTP' => 'KTP',
            'akta kelahiran' => 'Akta Kelahiran',
            'akta kematian' => 'Akta Kematian',
            'SKCK' => 'SKCK',
        ];

        return view('pages.ktp-submission.edit', compact('ktpSubmission','submissionTypes'));
    }

    //Buat update fi storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'submission_type' => ['required', Rule::in([
                'KK',
                'KTP',
                'Akta Kelahiran',
                'Akta Kematian',
                'SKCK'
            ])],
            'notes' => ['nullable', 'string', 'max:2000'],
            'document_proof' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/ktp-submission')->with('error', 'Akun Anda belum terhubung dengan data warga manapun.');
        }

        $ktpSubmission = KtpSubmission::findOrFail($id);

        if ($ktpSubmission->status != 'baru' || $ktpSubmission->resident_id != $resident->id) {
            return redirect('/ktp-submission')->with('error', "Gagal mengubah pengajuan, karena statusnya sudah {$ktpSubmission->status_label} atau bukan pengajuan Anda.");
        }

        $ktpSubmission->submission_type = $request->input('submission_type');
        
        $ktpSubmission->notes = $request->input('notes');

        if ($request->hasFile('document_proof')) {
            // Ngehapus file yang percuma
            if ($ktpSubmission->document_proof) {
                Storage::disk('public')->delete($ktpSubmission->document_proof);
            }
            // Menampilkan file baru
            $filePath = $request->file('document_proof')->store('ktp_documents', 'public');
            $ktpSubmission->document_proof = $filePath;
        }

        $ktpSubmission->save();

        return redirect('/ktp-submission')->with('success', 'Berhasil mengubah pengajuan berkas.');
    }

    //Hapus Foto
    public function destroy($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/ktp-submission')->with('error', 'Akun Anda belum terhubung dengan data warga manapun.');
        }

        $ktpSubmission = KtpSubmission::findOrFail($id);

        if ($ktpSubmission->status != 'baru' || $ktpSubmission->resident_id != $resident->id) {
            return redirect('/ktp-submission')->with('error', "Gagal menghapus pengajuan, karena statusnya sudah {$ktpSubmission->status_label} atau bukan pengajuan Anda.");
        }

        if ($ktpSubmission->document_proof) {
            Storage::disk('public')->delete($ktpSubmission->document_proof);
        }

        $ktpSubmission->delete();

        return redirect('/ktp-submission')->with('success', 'Berhasil menghapus pengajuan berkas.');
    }

    //Buat Admin
    public function update_status(Request $request, $id)
    {
        // Only Admin can update status
        if (Auth::user()->role_id != Role::ROLE_ADMIN) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => ['required', Rule::in(['baru', 'diproses', 'selesai', 'ditolak'])],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $ktpSubmission = KtpSubmission::findOrFail($id);
        $oldStatusLabel = $ktpSubmission->status_label; // Get old label before update

        $ktpSubmission->status = $request->input('status');
        $ktpSubmission->admin_notes = $request->input('admin_notes'); // Save admin notes
        $ktpSubmission->save();

        $newStatusLabel = $ktpSubmission->status_label; // Get new label after update

        // Send notification to the user whose submission status changed
        $userToNotify = User::where('id', $ktpSubmission->resident->user_id)->firstOrFail();
        $userToNotify->notify(new KtpSubmissionStatusChanged($ktpSubmission, $oldStatusLabel, $newStatusLabel)); // <<< Panggil notifikasi baru

        return redirect('/ktp-submission')->with('success', 'Berhasil mengubah status pengajuan berkas.');
    }

}