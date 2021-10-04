<?php

namespace App\Jobs;

use App\Mail\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $product;

    public function __construct(Product $product, User $user)
    {
        $this->product = $product;
        $this->user = $user;

    }
    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $product = $this->product;
        $user = $this->user;
        Mail::to($user->email)->send(new Order($product, $user));
    }
}
