# Reporting Without Live Query Pressure

## Problem

Reporting dashboards can damage the system they are supposed to explain if every page view rebuilds live data across customers, orders, tasks, and timelines.

## Context

Managers want fresh numbers. Operators need the CRM to stay responsive. Those two needs can conflict on a busy WordPress/WooCommerce database.

## Constraint

Reports should be useful without competing with daily operational screens.

## Decision

Separate reporting paths:

- live views for small scoped data;
- snapshots for expensive aggregates;
- CSV/export paths with bounded date ranges;
- dashboard filters that do not encourage accidental full-table scans.

## Tradeoff

Snapshots introduce freshness delay. That is better than making every manager refresh a production query storm.

## Failure Mode

The failure is a dashboard that looks helpful in testing but becomes the slowest internal screen in production.

## What I Would Improve Next

Add visible "last refreshed" timestamps and a manual refresh flow with rate limits.

