<?php

namespace App\Jobs;

use App\Models\OTP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteCodeJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $id;
    public function __construct($id)
    {
        $this->id=$id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        OTP::query()->where('id',$this->id)->delete();
    }
}
