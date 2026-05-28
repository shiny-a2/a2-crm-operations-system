<?php

declare(strict_types=1);

namespace A2\Showcase\Crm\Infrastructure;

final class EventIngestionGuard
{
    public function accept(array $event, callable $exists): array
    {
        $key = hash('sha256', implode('|', array(
            (string) ($event['source'] ?? 'unknown'),
            (string) ($event['external_id'] ?? ''),
            (string) ($event['occurred_at'] ?? ''),
        )));

        if ($exists($key)) {
            return array('accepted' => false, 'reason' => 'duplicate', 'idempotency_key' => $key);
        }

        return array('accepted' => true, 'reason' => 'new-event', 'idempotency_key' => $key);
    }
}
