# Project Resta: System Rules & Architecture

**Project Name:** Project Resta  
**Type:** Bilingual SaaS POS (Bar/Lounge/Restaurant)  
**Architecture:** Hybrid Online-Offline (PWA + Laravel API)

---

## 1. Core Principles

### Multi-Tenancy (The "Cloud Brain")
*   **Strategy:** Single Database with Column Isolation.
*   **The Golden Rule:** Every query **MUST** be scoped by `tenant_id`.
*   **Security:** Never allow access to records where `tenant_id` does not match the session.
*   **Tenant Identification:** Handled via subdomains (`{tenant}.restapos.com`).

### Offline-First (The "Client Brain")
*   **Tech Stack:** PWA, Service Workers, IndexedDB (Client), Laravel (Server).
*   **Data Flow:**
    1.  Client fetches `Product`, `Price`, `LicenseToken` while online.
    2.  Sales committed to **IndexedDB** first.
    3.  **Sync Queue** handles background pushes when `navigator.onLine` is true.
*   **Constraint:** Logic must assume the server might be unreachable.
*   **Cache:** `/sales` route must be cached for 100% offline availability.

### Anti-Theft Logic (Crucial)
*   **Shift Reconciliation:** Compare `expected_cash` vs `counted_cash` (Blind Close).
*   **Suspicious Activity Flags:**
    *   `void_count` > 5 in a single shift.
    *   "No Sale" (drawer open) without linked transaction.
    *   Price overrides.
*   **Audit Trail:** Log every destructive action (Update/Delete) with `before_data`, `after_data`, `user_id`, `timestamp`.

---

## 2. UI/UX Design Specification

### Brand Color Palette ("Neon-on-Dark")
| Role | Color | Hex | Usage |
| :--- | :--- | :--- | :--- |
| **Main Background** | Deep Navy | `#0A0E1A` | App background, sidebars |
| **Secondary** | Royal Blue | `#1A237E` | Cards, borders, secondary containers |
| **Primary Action** | Bright Blue | `#2979FF` | CTAs, Play buttons |
| **Highlight/Info** | Cyan / Teal | `#00E5FF` | Icons, glows, active toggles |
| **Success/Price** | Vibrant Green | `#76FF03` | Prices, Paid status, Success |
| **Text/Accent** | White | `#FFFFFF` | Typography, high-contrast labels |

### Components & Logic
*   **Responsiveness:** The UI **MUST** be optimized for all media devices (Desktop, Tablet, Mobile) with best-in-class responsive design.
*   **Navigation:** Dark Mode Fixed. Sidebar: Deep Navy + `1px` Royal Blue right border.
*   **Bilingual Toggle:** Switch (EN/SW), glows Cyan when active. No full reload.
*   **POS Sales Grid:**
    *   Item Tiles: Rounded (12px), Royal Blue bg.
    *   Prices: Bold Vibrant Green.
    *   Categories: Horizontal scroll, Cyan underline for active.
*   **Anti-Theft UI (The Guard):**
    *   Audit Log: Monospace font. "Before" (White) vs "After" (Cyan).
    *   Alerts: Royal Blue bg + Vibrant Green border.

### Offline Indicators
*   🟢 **Green Pulse:** Live Sync Active.
*   ⚪ **White Icon:** Offline Mode (Local IndexedDB).
*   **Sync Queue:** Bright Blue progress bar on reconnection.

---

## 3. Database Rules

### Migrations
*   **String Length:** When defining `string` columns, **ALWAYS** specify the length.
    *   *Correct:* `$table->string('name', 255);`
    *   *Incorrect:* `$table->string('name');`

---

## 4. Workflows & Access Control

### Roles
### Roles
*   **Cashier:**
    *   **Allowed:** Sales ("Mauzo tu"), Blind Close.
    *   **Optional:** Basic Stock View (Quantity only).
    *   **Restricted:** Cannot Delete/Void orders without Approval (PIN/Admin).
*   **Manager:** Voids, Refunds, Inventory Adjustments (Requires PIN).
*   **Tenant Admin:**
    *   **Settings:** All system config, Branches, Users, Roles.
    *   **Inventory:** Products, Suppliers, Pricing Rules.
    *   **Approvals:** Configure rules for Voids/Refunds/Price Overrides.
    *   **Monitoring:** Subscription, Device Control, Audit Logs.

### Subscription Lock (License)
*   **Validation:** Check `expires_at` in signed License Token on every app launch (Offline-capable).
*   **Hard Lock:** If expired -> Redirect to `/subscription-expired`. No Sales access.
*   **Grace Period:** 3 days extra before full lock.

### Deployment
*   **Domain:** `{tenant}.restapos.com`
