<?php

declare(strict_types=1);

namespace A2\Showcase\Crm\Infrastructure;

final class AuditTrailWriter
{
    public function sanitizeEvent(string $action, array $context): array
    {
        unset($context['phone'], $context['message'], $context['customer_name'], $context['provider_payload']);

        return array(
            'action' => $action,
            'context' => $context,
            'created_at' => gmdate('c'),
        );
    }
}
