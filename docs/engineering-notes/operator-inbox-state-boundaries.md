# Operator Inbox State Boundaries

## Problem

CRM inboxes become unreliable when "assigned", "open", "waiting", "done", and "needs follow-up" are treated as labels instead of workflow state.

## Context

Operators need to know what belongs to them, what changed recently, and what is safe to act on. Managers need to understand workload without reading every conversation.

## Constraint

The system must protect customer data and keep state changes auditable.

## Decision

Use explicit assignment rules, state transitions, and audit logs:

- operators see scoped work;
- important changes record actor and context;
- reports read structured state instead of reconstructing meaning from free text.

## Tradeoff

More state rules make the system less flexible. They also make it more reviewable.

## Failure Mode

The failure is two operators acting on the same customer while management sees a dashboard that looks correct but is built from unclear state.

## What I Would Improve Next

Add advisory locking or "currently viewed by" signals for sensitive customer workflows.

