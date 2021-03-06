<?php

namespace OFFLINE\LaravelCSP;

use OFFLINE\LaravelCSP\Exceptions\InvalidCspPolicy;
use OFFLINE\LaravelCSP\Policies\Policy;

class PolicyFactory
{
    public static function create(string $className): Policy
    {
        $policy = app($className);

        if (! is_a($policy, Policy::class, true)) {
            throw InvalidCspPolicy::create($policy);
        }

        if (! empty(config('csp.report_uri'))) {
            $policy->reportTo(config('csp.report_uri'));
        }

        return $policy;
    }
}
