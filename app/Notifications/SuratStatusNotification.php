<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SuratStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $alasan;
    protected $tipeSurat;

    public function __construct($status, $alasan = null, $tipeSurat = null)
    {
        $this->status = $status;
        $this->alasan = $alasan;
        $this->tipeSurat = $tipeSurat; // contoh: 'sktm', 'sd', 'sdu', 'skbm', 'sk'
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $pesan = $this->status == 'disetujui'
            ? 'Selamat, pengajuan surat Anda telah disetujui. Silahkan Cek Di link '
            : 'Maaf, pengajuan surat Anda ditolak.';

        $mail = (new MailMessage)
            ->subject('Status Pengajuan Surat')
            ->greeting('Halo, ' . $notifiable->name)
            ->line($pesan);

        if ($this->status == 'disetujui' && $this->tipeSurat) {
            $mail->action('Lihat Surat Anda', url('/user/' . $this->tipeSurat));
        }

        if ($this->status == 'ditolak' && $this->alasan) {
            $mail->line('Alasan penolakan: ' . $this->alasan);
        }

        $mail->line('Terima kasih telah menggunakan layanan KelurahanApp.');
        $mail->salutation('Hormat kami, KelurahanSupport');

        return $mail;
    }
}
