<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\KtpSubmission; // Import model KtpSubmission

class KtpSubmissionStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected KtpSubmission $ktpSubmission, // Tipe hint untuk KtpSubmission
        protected string $oldStatusLabel,
        protected string $newStatusLabel
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Hanya simpan ke database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Status pengajuan KTP Anda telah berubah.')
                    ->action('Lihat Pengajuan KTP', url('/ktp-submission/' . $this->ktpSubmission->id))
                    ->line('Terima kasih telah menggunakan layanan kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // app/Notifications/KtpSubmissionStatusChanged.php

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'ktp_submission_status_changed',
            'ktp_submission_id' => $this->ktpSubmission->id,
            'submission_type' => $this->ktpSubmission->submission_type_label,
            'old_status' => $this->oldStatusLabel,
            'new_status' => $this->newStatusLabel,
            'message' => "Status pengajuan berkas '{$this->ktpSubmission->submission_type_label}' Anda berubah dari {$this->oldStatusLabel} menjadi {$this->newStatusLabel}.",
        ];
    }
}