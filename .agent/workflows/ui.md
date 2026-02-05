---
description: UI
---

# 📱 Project Resta | UI Design Specification

## 🎨 Brand Color Palette
Use these hex codes for all interface elements to maintain the "Neon-on-Dark" professional aesthetic.

| Element | Preview | Hex Code | Design Role |
| :--- | :--- | :--- | :--- |
| **Vibrant Green** | ▉ | `#76FF03` | Success states, active status, "Paid" indicators. |
| **Cyan / Teal** | ▉ | `#00E5FF` | Interactive icons, hover glows, info highlights. |
| **Bright Blue** | ▉ | `#2979FF` | Primary Action Buttons (CTA), Play/Start buttons. |
| **Royal Blue** | ▉ | `#1A237E` | Secondary containers, borders, card backgrounds. |
| **Deep Navy** | ▉ | `#0A0E1A` | **Main App Background**, sidebars, deep surfaces. |
| **White** | ▉ | `#FFFFFF` | Primary typography, high-contrast labels, accents. |

---

## 🛠️ UI Components & Logic

### 1. Navigation & Header
* **Theme:** Dark Mode (Fixed).
* **Sidebar:** Deep Navy (`#0A0E1A`) with a `1px` right border in Royal Blue (`#1A237E`).
* **Bilingual Toggle:** A switch component that slides between **EN** and **SW**, glowing Cyan (`#00E5FF`) when active.

### 2. POS Sales Grid (The "Visual Menu")
* **Item Tiles:** Rounded corners (12px), background Royal Blue (`#1A237E`).
* **Price Tags:** Bold Vibrant Green (`#76FF03`) text for instant visibility in dark lounge environments.
* **Category Filters:** Horizontal scroll with Cyan (`#00E5FF`) underline for the active category (e.g., *Beer, Food, Shisha*).

### 3. "The Guard" (Anti-Theft UI)
* **Audit Trail:** Monospace font for logs; "Before" data in White, "After" data highlighted in Cyan.
* **Alerts:** Critical fraud flags should use a Royal Blue background with a Vibrant Green border to indicate "System is protecting you."

---

## 🏗️ System Architecture (UI Representation)

### A. SaaS Multi-Tenancy
* **Isolation:** The UI must display the **Tenant Brand** (e.g., "Nikao Lounge") alongside the Project Resta logo.
* **Role-Based Access:** * **Cashier:** Restricted view (Sales screen only).
    * **Manager:** Access to Voids/Refunds via PIN-entry Modal.
    * **Admin:** Dashboard view with full reporting.

### B. Offline-First Indicators
* **Connection Status:** * 🟢 **Green Pulse:** Live Sync Active.
    * ⚪ **White Icon:** Offline Mode (Local IndexedDB active).
* **Sync Queue:** A background progress bar in Bright Blue (`#2979FF`) appears when reconnection occurs.

---

## 🔐 License & Security
* **Lock Screen:** When a subscription expires, the UI applies a `backdrop-blur(10px)` over the POS and displays a "License Expired" card using the Royal Blue to Navy gradient.
* **Verification:** Cryptographic tokens are validated locally on every PWA launch.

---

## 📐 Layout Constants
* **Grid Spacing:** 16px (1rem)
* **Corner Radius:** 8px (Small components), 16px (Main Cards)
* **Default Font:** Inter or Roboto (San-Serif) for maximum readability.

## use liveware in all ui

---
**Next Step:** Would you like me to generate the **Tailwind CSS config** or a **Figma-ready CSS stylesheet** for this design?