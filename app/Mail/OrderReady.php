<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;

class OrderReady extends Mailable implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your SNK Wellness downloads are ready');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.order-ready');
    }

    public function attachments(): array
    {
        return collect($this->order->items)
            ->filter(fn ($item) => $item->product?->pdf_path && Storage::disk('local')->exists($item->product->pdf_path))
            ->map(fn ($item) => \Illuminate\Mail\Attachment::fromStorageDisk('local', $item->product->pdf_path))
            ->all();
    }
}