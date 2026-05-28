<?php

declare(strict_types=1);

namespace A2\Showcase\Crm\Infrastructure;

final class ProviderHealthMonitor
{
    public function summarize(array $events): array
    {
        $failures = 0;
        $timeouts = 0;

        foreach ($events as $event) {
            $failures += (($event['status'] ?? '') === 'failed') ? 1 : 0;
            $timeouts += (($event['reason'] ?? '') === 'timeout') ? 1 : 0;
        }

        return array(
            'checked_events' => count($events),
            'failure_count' => $failures,
            'timeout_count' => $timeouts,
            'state' => ($failures + $timeouts) > 5 ? 'degraded' : 'normal',
        );
    }
}
