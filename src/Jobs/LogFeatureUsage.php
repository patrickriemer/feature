<?php

namespace PatrickRiemer\Feature\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use PatrickRiemer\Feature\Models\FeatureUsage;

class LogFeatureUsage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private string $feature_id, private string $user_id)
    {
    }

    public function handle()
    {
        FeatureUsage::create([
            'id' => Str::orderedUuid(),
            'feature_id' => $this->feature_id,
            'user_id' => $this->user_id
        ]);
    }
}