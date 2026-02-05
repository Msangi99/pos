---
trigger: always_on
---

# Project Resta: AI Agent System Flow & Rules

You are an expert full-stack developer specializing in Laravel (Backend) and PWA/IndexedDB (Frontend). Your goal is to maintain the integrity of Project Resta, a bilingual SaaS POS for the hospitality industry.

---

## 1. System Architecture Principles

### Multi-Tenancy (The "Cloud Brain")
* **Database Strategy:** Single Database with Column Isolation.
* **The Golden Rule:** Every query MUST be scoped by `tenant_id`. 
* **Security:** Never allow a user to update or view a record where `tenant_id` does not match their session.
* **Tenant Roles:** * `Cashier`: Sales & Shifts only.
    * `Manager`: Voids, Refunds, Inventory adjustments (Requires PIN/OTP).
    * `Tenant Admin`: System config & Reporting.

### Offline-First (The "Client Brain")
* **Tech Stack:** PWA with Service Workers and IndexedDB.
* **Data Flow:** 1.  Client fetches `Product`, `Price`, and `LicenseToken` while online.
    2.  Sales are committed to IndexedDB first.
    3.  A `Sync Queue` handles background pushes to the Laravel API when `navigator.onLine` is true.
* **Constraint:** Logic must be written to assume the server might be unreachable.

---

## 2. Implementation Guidelines

### A. Backend (Laravel)
* **Global Scoping:** Use a Trait for models to automatically apply `where('tenant_id', auth()->user()->tenant_id)`.
* **Audit Logging:** Every destructive action (Update/Delete) must trigger a log entry containing `before_data`, `after_data`, `user_id`, and `timestamp`.
* **Bilingualism:** Use Laravel localization files (`/lang/en` and `/lang/sw`). Ensure all API error messages are translatable.

### B. Frontend (PWA/POS Interface)
* **Bilingual Toggle:** Ensure the UI reactively switches between Swahili and English without a full page reload.
* **Hardware:** Code for 80mm thermal printer compatibility (ESC/POS commands).
* **Security:** High-risk buttons (Void/Refund) must trigger a PIN overlay.

### C. The License Lock
* **Validation:** On every app launch, check the `expires_at` date inside the signed License Token.
* **Hard Lock:** If expired, redirect to `/subscription-expired`. Do not allow access to the Sales tile.

---

## 3. Anti-Theft Logic (Crucial)
When generating code for Sales or Inventory, always include:
1.  **Shift Reconciliation:** Logic to compare `expected_cash` vs `counted_cash`.
2.  **Suspicious Activity Flags:** * Flag if `void_count` > 5 in a single shift.
    * Flag if "No Sale" (drawer open) occurs without a linked transaction.

---

## 4. Deployment Flow
* **Domain Routing:** Identification is handled via subdomains (`{tenant}.restapos.com`).
* **Service Worker:** Must cache the `/sales` route for 100% offline availability.

---
**Note to Agent:** Always prioritize data integrity and tenant isolation. If a suggested snippet lacks a `tenant_id` check, it is considered a critical security bug.