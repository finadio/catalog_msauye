<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Product;

class NewProductSubmittedNotification extends Notification
{
    use Queueable;

    protected $product;

    /**
     * Create a new notification instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
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
        return [
            'title' => 'Produk Baru Diajukan',
            'message' => 'Produk baru "' . $this->product->name . '" telah diajukan oleh ' . $this->product->umkm->name,
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'umkm_name' => $this->product->umkm->name,
            'umkm_id' => $this->product->umkm->id,
            'action_url' => route('admin.produk.edit', $this->product->id),
            'type' => 'product_submission',
            'icon' => 'fas fa-box',
            'color' => 'warning'
        ];
    }
}
