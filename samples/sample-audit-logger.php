<?php

final class A2_Sample_Audit_Logger {
    private wpdb $db;
    private string $table;

    public function __construct(wpdb $db) {
        $this->db = $db;
        $this->table = $db->prefix . 'a2_crm_audit_sample';
    }

    public function record(string $event, int $actor_id, array $context = array()): void {
        $safe_context = array_intersect_key($context, array_flip(array(
            'customer_id',
            'operator_id',
            'workflow',
            'status',
        )));

        $this->db->insert($this->table, array(
            'event' => sanitize_key($event),
            'actor_id' => $actor_id,
            'context_json' => wp_json_encode($safe_context),
            'created_at' => gmdate('Y-m-d H:i:s'),
        ));
    }
}

