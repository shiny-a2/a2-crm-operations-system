# Provider Abstraction For SMS And VoIP

## Problem

SMS and VoIP providers fail in practical ways: delayed delivery, rate limits, changed responses, temporary outages, and partial success.

## Context

Operations teams often experience provider failure as "the CRM is broken." The code has to make provider state visible enough to diagnose without leaking credentials or message content.

## Constraint

Provider credentials and private endpoints must stay out of code and public documentation.

## Decision

Wrap providers behind an adapter interface:

- send requests return structured results;
- provider references are stored only when safe;
- failures are visible to operators;
- swapping provider implementation does not rewrite workflow services.

## Tradeoff

An adapter adds structure for work that can look simple at first. It pays off when the provider changes or fails.

## Failure Mode

The failure is a workflow service that assumes "send" means "delivered" and hides provider uncertainty.

## What I Would Improve Next

Add provider health notes and retry state that operators can understand without reading logs.

