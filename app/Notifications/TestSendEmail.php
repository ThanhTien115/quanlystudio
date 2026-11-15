<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestSendEmail extends Notification
{
    use Queueable;

    private $data;

    // Nhận dữ liệu truyền từ Controller qua constructor (Trang 21)[cite: 19, 20]
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    // Cấu hình nội dung hiển thị trong Email (Trang 13)[cite: 12]
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Xác nhận đặt lịch chụp thành công - 22FotoholicStudio')
            ->line('Cảm ơn bạn đã đặt lịch chụp tại 22FotoholicStudio.')
            ->line('Mã hóa đơn của bạn là: ' . ($this->data->MaHoaDon ?? 'N/A'))
            ->line('Số tiền thanh toán: ' . number_format($this->data->SoTienDaThanhToan ?? 0) . ' VNĐ');
    }
}