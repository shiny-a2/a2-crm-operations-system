<?php

interface A2_Sample_Message_Provider {
    public function send(string $recipient, string $template_key, array $context = array()): A2_Sample_Provider_Result;
}

final class A2_Sample_Provider_Result {
    public function __construct(
        public readonly bool $accepted,
        public readonly string $status,
        public readonly ?string $provider_reference = null
    ) {
    }
}

final class A2_Sample_Null_Message_Provider implements A2_Sample_Message_Provider {
    public function send(string $recipient, string $template_key, array $context = array()): A2_Sample_Provider_Result {
        if ($recipient === '' || $template_key === '') {
            return new A2_Sample_Provider_Result(false, 'invalid_request');
        }

        return new A2_Sample_Provider_Result(true, 'accepted_for_demo');
    }
}

