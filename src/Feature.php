<?php

namespace PatrickRiemer\Feature;

use Illuminate\Support\Str;
use PatrickRiemer\Feature\Jobs\LogFeatureUsage;
use PatrickRiemer\Feature\Models\FeatureUsage;

class Feature
{
    public function __construct()
    {
    }

    public static function create(string $code, string $name): \PatrickRiemer\Feature\Models\Feature
    {
        return \PatrickRiemer\Feature\Models\Feature::create([
            'id' => Str::orderedUuid(),
            'code' => $code,
            'name' => $name
        ]);
    }

    public static function log(\PatrickRiemer\Feature\Models\Feature $feature, string $user_id = null)
    {
        if (!config('feature.log_user')) {
            $user_id = null;
        }

        if (config('feature.no_job')) {
            FeatureUsage::create([
                'id' => Str::orderedUuid(),
                'feature_id' => $feature->id,
                'user_id' => $user_id
            ]);
        } else {
            LogFeatureUsage::dispatch($feature->id, $user_id);
        }
    }
}