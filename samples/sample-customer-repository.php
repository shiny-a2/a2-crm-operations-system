<?php

final class A2_Sample_Customer_Repository {
    private wpdb $db;
    private string $table;

    public function __construct(wpdb $db) {
        $this->db = $db;
        $this->table = $db->prefix . 'a2_crm_customers_sample';
    }

    public function find_for_operator(int $customer_id, int $operator_id): ?array {
        $row = $this->db->get_row(
            $this->db->prepare(
                "SELECT customer_id, display_name, assigned_operator_id, last_activity_at
                 FROM {$this->table}
                 WHERE customer_id = %d AND assigned_operator_id = %d
                 LIMIT 1",
                $customer_id,
                $operator_id
            ),
            ARRAY_A
        );

        return is_array($row) ? $row : null;
    }

    public function touch_activity(int $customer_id): void {
        $this->db->update(
            $this->table,
            array('last_activity_at' => gmdate('Y-m-d H:i:s')),
            array('customer_id' => $customer_id),
            array('%s'),
            array('%d')
        );
    }
}

