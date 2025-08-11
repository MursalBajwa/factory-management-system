# Factory Management System — Gadgistics

**Short description**  
The Factory Management System (Gadgistics) is a web-based application designed to centralize and automate core factory/store operations: user and customer management, inventory and product control, supplier and financial transaction handling (cash/cheque/debt), selling records, expenses, and customer notifications. The system aims to reduce manual work, improve data accuracy, and provide timely reports for decision making. :contentReference[oaicite:0]{index=0}

---

## 1. Problem Identification
Modern factories and small retail/manufacturing stores often struggle with:
- Managing users, customers, and suppliers from multiple places.
- Tracking inventory and stock levels accurately.
- Handling financial transactions (cheques, cash, debts) consistently.
- Processing and notifying customers about invoices and payments.
- Maintaining a centralized record of selling transactions and expenses. :contentReference[oaicite:1]{index=1}

---

## 2. Problem Definition
This project provides a single integrated system that allows administrators to manage operational data (users, customers, stock, products, suppliers, finances) and gives customers access to invoice-related information and notifications. It replaces fragmented manual processes with a consistent, auditable digital workflow. :contentReference[oaicite:2]{index=2}

---

## 3. Functional Requirements

### 3.1 Admin Functionalities
- **Home / User Management**
  - Add User: create new users with roles and permissions.
  - Delete User: remove users from the system.
  - Update User: edit user details and roles. :contentReference[oaicite:3]{index=3}

- **Customer Management**
  - Add Customer: register new customers (contact and business details).
  - Search Customer: find customers using filters.
  - Update Customer: edit address, contact, and account status. :contentReference[oaicite:4]{index=4}

- **Stock Management**
  - Add Stock: add new inventory items.
  - View Stock: list and inspect current stock items and quantities.
  - Update Stock: modify quantity, description, or status.
  - Search Stock: filter/search stock items. :contentReference[oaicite:5]{index=5}

- **Product Management**
  - Add Product: add new products with name, price, category, and image.
  - Search Product: search and filter products.
  - Update Product: edit product details. :contentReference[oaicite:6]{index=6}

- **Cheque Management**
  - Add Cheque: record cheque transactions.
  - View Upcoming Cheques: list cheques by upcoming dates.
  - Update Cheque: change cheque status or details. :contentReference[oaicite:7]{index=7}

- **Cash Management**
  - Add Cash: log cash transactions.
  - Search Cash: find cash transaction records.
  - Update Cash: edit cash transaction details. :contentReference[oaicite:8]{index=8}

- **Supplier Management**
  - Add Supplier: create supplier records.
  - Search Supplier: search existing suppliers.
  - Update Supplier: update supplier information. :contentReference[oaicite:9]{index=9}

- **Debt Management**
  - View Debt: display debt-related records.
  - Search Debt: search specific debt entries. :contentReference[oaicite:10]{index=10}

- **Notifications**
  - Notify admin when customer invoices are rejected (and similar alerts). :contentReference[oaicite:11]{index=11}

- **Expense Management**
  - Add Expense: record new expenses.
  - Search Expense: find expense records.
  - Summary: provide expense summaries over a period.
  - History: view full expense history. :contentReference[oaicite:12]{index=12}

- **Selling Record Management**
  - Add Selling Record: record new sales.
  - Search Selling Record: find past selling records. :contentReference[oaicite:13]{index=13}

### 3.2 Customer Functionalities
- **Notifications**
  - Customers receive notifications when their invoices are accepted or rejected. :contentReference[oaicite:14]{index=14}

- **Reports**
  - Search Invoice: customers can search and print invoices.
  - View Debt: customers can view their outstanding debt records. :contentReference[oaicite:15]{index=15}

---

## 4. System Architecture

- **Frontend**
  - Built with HTML, CSS and Bootstrap to provide a responsive and user-friendly interface. :contentReference[oaicite:16]{index=16}

- **Backend**
  - PHP is used for server-side logic, handling form submissions, authentication, business rules, and interactions with the database. :contentReference[oaicite:17]{index=17}

- **Database**
  - MySQL stores system data: users, customers, products, stock, suppliers, transactions (cash/cheque), selling records, expenses, and notifications. :contentReference[oaicite:18]{index=18}

---

## 5. Benefits
- Centralized management of factory/store operations.
- Improved inventory accuracy and easier stock tracking.
- Streamlined financial handling (cash, cheque, debt).
- Faster, clearer communication with customers (invoice notifications).
- Real-time reports and summaries to support management decisions. :contentReference[oaicite:19]{index=19}

---

## 6. Diagrams & Visuals
The documentation includes system diagrams to describe structure and behavior:
- **ER Diagram** — shows main entities (users, customers, products, stock, transactions) and relationships.
- **Use Case Diagram** — highlights actor actions (admin, customer) and their interactions with system features.
- **Class Diagram** — models main software classes and attributes.
- **Activity Diagram** — represents workflows such as adding a selling record or processing an invoice. :contentReference[oaicite:20]{index=20}

---

## 7. Summary
This Factory Management System delivers a practical, PHP/MySQL-based application to replace manual, fragmented operational processes with a single solution for managing users, inventory, financial transactions, suppliers, selling records, expenses, and customer communications. The system improves accuracy, reduces manual workload, and provides useful reports and notifications for both administrators and customers. 
