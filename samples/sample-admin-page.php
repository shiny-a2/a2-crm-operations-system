<?php

final class A2_Sample_CRM_Admin_Page {
    public function boot(): void {
        add_action('admin_menu', array($this, 'register_menu'));
    }

    public function register_menu(): void {
        add_menu_page(
            'CRM Operations',
            'CRM Operations',
            'read',
            'a2-sample-crm',
            array($this, 'render'),
            'dashicons-groups',
            56
        );
    }

    public function render(): void {
        if (!current_user_can('read')) {
            wp_die(esc_html__('Access denied.', 'a2-sample'));
        }

        echo '<div class="wrap">';
        echo '<h1>CRM Operations</h1>';
        echo '<p>This public sample omits production customer data and provider credentials.</p>';
        echo '</div>';
    }
}

