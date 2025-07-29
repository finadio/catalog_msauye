<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Product;

class ProductStatusChangedNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Product $product, $status)
    {
        $this->product = $product;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusText = $this->status === 'approved' ? 'disetujui' : 'ditolak';
        $color = $this->status === 'approved' ? 'success' : 'danger';
        $icon = $this->status === 'approved' ? 'fas fa-check-circle' : 'fas fa-times-circle';

        return [
            'title' => 'Status Produk Diperbarui',
            'message' => 'Produk "' . $this->product->name . '" telah ' . $statusText,
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'status' => $this->status,
            'status_text' => $statusText,
            'action_url' => route('umkm_produk'),
            'type' => 'product_status_changed',
            'icon' => $icon,
            'color' => $color
        ];
    }
}
