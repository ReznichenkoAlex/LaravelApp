<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     * @property-read User $user
     */

    protected $user;
    protected $product;

    public $tries = 3;

    public function __construct(User $user, Product $product)
    {
        $this->user = $user;
        $this->product = $product;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Order::query()->create([
            'product_id' => $this->product->id,
            'user_email' => $this->user->email
        ]);
    }

    public function failed()
    {
        info(__CLASS__ . "Ошибка выполнения");
    }
}
