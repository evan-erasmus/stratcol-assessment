<?php

namespace App\Jobs;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Order $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(5);

        if ($this->order->status === 'cancelled') {
            return;
        }

        if ($this->order->currency()->get()->should_notify) {
            $this->sendEmail();
        }

        $this->order->update([
            'status' => 'completed',
        ]);
    }

    private function sendEmail()
    {
        $email = auth()->user()->email;
        Mail::to($email)->send(new OrderConfirmationMail($this->order));
    }
}
