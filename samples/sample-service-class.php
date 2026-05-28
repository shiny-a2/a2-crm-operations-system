<?php

final class A2_Sample_CRM_Assignment_Service {
    private wpdb $db;
    private string $table;

    public function __construct(wpdb $db) {
        $this->db = $db;
        $this->table = $db->prefix . 'a2_crm_assignments_sample';
    }

    public function assign_customer(int $customer_id, int $operator_id, int $actor_id): void {
        if (!$this->can_assign($actor_id)) {
            throw new RuntimeException('Current user cannot assign customers.');
        }

        $this->db->replace($this->table, array(
            'customer_id' => $customer_id,
            'operator_id' => $operator_id,
            'assigned_by' => $actor_id,
            'assigned_at' => gmdate('Y-m-d H:i:s'),
        ));

        do_action('a2_sample_crm_customer_assigned', $customer_id, $operator_id, $actor_id);
    }

    private function can_assign(int $actor_id): bool {
        $user = get_user_by('id', $actor_id);
        return $user instanceof WP_User && user_can($user, 'edit_users');
    }
}

