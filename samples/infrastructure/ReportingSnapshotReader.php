<?php

declare(strict_types=1);

namespace A2\Showcase\Crm\Infrastructure;

final class ReportingSnapshotReader
{
    public function chooseSnapshot(array $snapshots, int $maxAgeMinutes): ?array
    {
        foreach ($snapshots as $snapshot) {
            $age = (int) ($snapshot['age_minutes'] ?? PHP_INT_MAX);

            if ($age <= $maxAgeMinutes) {
                return $snapshot;
            }
        }

        return null;
    }
}
