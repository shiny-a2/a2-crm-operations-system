<?php

declare(strict_types=1);

namespace A2\Showcase\Crm\Infrastructure;

final class OperatorAssignmentPolicy
{
    public function canAssign(array $item, int $operatorId): bool
    {
        if ($operatorId <= 0) {
            return false;
        }

        if (($item['state'] ?? '') !== 'open') {
            return false;
        }

        return empty($item['assigned_to']) || (int) $item['assigned_to'] === $operatorId;
    }
}
