---
description: POP
---

# Documentation: Pro-Level Hybrid POS System (Bar/Lounge/Restaurant)
**Project Name:** [Insert Name, e.g., ApexPOS]  
**Version:** 1.0.0  
**Framework:** Hybrid Online-Offline (SQLite + Central API)  
**Language Support:** Bilingual (Swahili & English)

---

## 1. Lengo Kuu la System (Core Objective)
Lengo ni kutengeneza mfumo wa kisasa wa POS ambao ni **mwepesi na wa haraka** kwa Cashier, lakini wenye **ulinzi mkali (Anti-Theft)** na udhibiti wa mapato. Mfumo lazima ufanye kazi bila intaneti (**Offline-first**) huku ukisawazisha data (Sync) intaneti ikirudi.

---

## 2. UI/UX Strategy: Visual & Adaptive Design
Mfumo umeundwa kufanya kazi kwenye **Touchscreen** (Kiosk/Tablets) na **Normal PC** (Laptop/Desktop).

### Kanuni za Design
* **Touch Mode:** Buttons kubwa (min 48px), spacing pana, na miamala ya "tap-to-finish".
* **Normal Mode:** Shortcuts za keyboard kwa ajili ya kasi (F2-Search, F4-Pay, Ctrl+P-Print).
* **Visual Menu:** Bidhaa zinaonyeshwa kwa picha na rangi kulingana na kategoria (mfano: Beer - Brown, Soft Drinks - Blue).
* **Bilingual Toggle:** Kitufe cha kubadili lugha (SW/EN) kinapatikana juu kulia wakati wote.

### Muonekano wa Screen (Screens Layout)
| Screen | Sifa Kuu |
| :--- | :--- |
| **Login** | Access kupitia PIN (kasi zaidi) au Password. |
| **Sales Screen** | Grid ya bidhaa, search bar, barcode support, na cart ya upande wa kulia. |
| **Payment Modal** | Chaguzi za Split bill, Tips, na njia za malipo (Cash, M-Pesa, Card). |
| **Admin Dashboard** | Grafu za mauzo ya leo, hali ya stock, na "Red Alerts" za wizi. |

---

## 3. Roles & Access Control
Mgawanyo wa madaraka kuzuia mianya ya upotevu wa pesa.

* **Cashier:** Mauzo tu. Hawezi kufuta (Void) oda, kutoa discount kubwa, au kuona ripoti za faida.
* **Manager/Supervisor:** Anaweza ku-approve Void/Refund, kufungua/kufunga shift, na kufanya stock count.
* **Administrator:** Udhibiti kamili wa mfumo, mipangilio ya bei, kuongeza watumiaji, na kudhibiti Subscription.

---

## 4. Subscription Lock & Security
Ili kulinda biashara ya mtoa huduma (Vendor), mfumo una **Subscription Lock** inayofanya kazi hata ukiwa offline.



### Sheria za Lock:
1.  **License Token:** Token iliyosimbwa (encrypted) inayohifadhi `expires_at` na `device_id`.
2.  **Grace Period:** Siku 3 za ziada baada ya muda kuisha kabla ya kufunga kabisa.
3.  **Behavior:** Muda ukiisha, Cashier hawezi ku-login. Admin anabaki na "Read-only access" kwa ajili ya ku-renew na ku-export data.

---

## 5. Offline-First Architecture
Mfumo hautegemei intaneti kufanya mauzo.

* **Local Storage:** Inatumia SQLite kuhifadhi kila transaction papo hapo.
* **Sync Engine:** Intaneti ikipatikana, mfumo unapandisha (Push) mauzo yote na kushusha (Pull) mabadiliko ya bei au bidhaa mpya.
* **Conflict Policy:** Bei iliyotumika wakati wa kuuza offline ndiyo inayotambulika, lakini Admin atapewa taarifa (Flag) kama kulikuwa na tofauti na bei ya server.

---

## 6. Anti-Theft & Monitoring (Ulinzi wa Pesa)
Hii ni sehemu muhimu kuzuia cashier "kucheza" na mfumo.

### A) Audit Trail (Digital Footprint)
Kila mguso kwenye system unarekodiwa:
> *User X changed price of 'Heineken' from 5000 to 4500 at 21:05. Reason: Happy Hour.*

### B) Shift & Cash Control
* **Blind Close:** Cashier lazima aandike kiasi cha pesa alichonacho mkononi bila kuonyeshwa kiasi ambacho mfumo unatarajia (Expected). Tofauti (Variance) itatokea kwenye ripoti ya Manager pekee.
* **No-Sale Logs:** Rekodi ya kila mara droo ya pesa (Cash Drawer) inapofunguliwa bila muamala.

### C) Suspicious Activity Alerts
Mfumo utatuma alert au ku-flag:
* Voids/Refunds nyingi mfululizo.
* Kufuta items baada ya risiti kuchapishwa.
* Product price overrides za mara kwa mara.

---

## 7. Modules za Mfumo (Functional Requirements)

### 📦 Inventory & Stock
* **Batch Management:** Kufuatilia vinywaji kulingana na tarehe ya kuingia na expiry.
* **Wastage Tracking:** Kurekodi chupa zilizovunjika au vinywaji vilivyomwagika.
* **Low Stock Alerts:** Arifa bidhaa ikibaki chache.

### 💰 Core POS
* **Split Bill:** Kuruhusu wateja wa meza moja kulipa mmoja mmoja.
* **Kitchen/Bar Tickets:** Oda inatumwa moja kwa moja printer ya bar au jikoni.
* **Customer Loyalty:** Kusanya namba za simu na kutoa points/discounts.

### 📊 Reporting
* **X-Report:** Ripoti ya katikati ya shift.
* **Z-Report:** Ripoti ya mwisho wa siku (End of Day).
* **Top Performing Items:** Bidhaa zinazotoka zaidi.

---

## 8. Data Schema (Muundo wa Database)
Baadhi ya table muhimu:

| Table Name | Description |
| :--- | :--- |
| `subscriptions` | `license_key`, `expiry_date`, `mac_address`, `status` |
| `audit_logs` | `user_id`, `action`, `old_value`, `new_value`, `timestamp` |
| `shifts` | `user_id`, `start_cash`, `end_cash_expected`, `end_cash_actual` |
| `stock_movements` | `product_id`, `quantity`, `type (IN/OUT/WASTE)`, `reason` |

---

## Hitimisho & Hatua Inayofuata
Mfumo huu umeundwa kuwa **"Bulletproof"**. Sio tu unasaidia kuuza, bali unamlinda mwenye biashara dhidi ya hasara za makusudi na zisizo za makusudi.

**Je, ungependa nianze kutengeneza Database Schema (SQL) kamili ya table hizi, au unahitaji tuanze na Logic ya hiyo Subscription Lock?**