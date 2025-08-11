Factory Management System Documentation
1. Problem Identification
Modern factories face significant challenges in managing various operational aspects such as inventory, customer relationships, supplier data, financial records, and notifications. Manual systems or poorly integrated software solutions can lead to inefficiencies, data inconsistency, and lack of real-time updates. These inefficiencies hinder decision-making and can result in financial losses or customer dissatisfaction.
Key Issues:
1.	Difficulty in managing users, customers, and suppliers efficiently.
2.	Challenges in tracking stock levels and maintaining accurate inventory.
3.	Inefficient handling of financial transactions like cheques, cash, and debts.
4.	Limited mechanisms for handling customer notifications and invoice processing.
5.	Lack of a centralized system to manage selling records and expenses.
2. Problem Definition
To address these challenges, the Factory Management System is designed as a comprehensive solution to streamline administrative tasks, improve financial tracking, and enhance customer communication. The system will enable the admin to efficiently manage users, customers, stock, products, financial transactions, and notifications, while providing customers with access to notifications and reports related to their invoices and debts.
3. Functional Requirements
3.1 Admin Functionalities
3.1.1 Home
•	Add User: Allow admin to add new users with specific roles and permissions.
•	Delete User: Provide functionality to remove users from the system.
•	Update User: Enable admin to modify user details.
3.1.2 Customer Management
•	Add Customer: Add new customer records with personal and business information.
•	Search Customer: Search for existing customer details based on criteria.
•	Update Customer: Update customer details like address, contact, or account status.
3.1.3 Stock Management
•	Add Stock: Add new stock items to the inventory.
•	View Stock: View existing stock details such as quantity and description.
•	Update Stock: Update stock information (e.g., quantity, description, or status).
•	Search Stock: Search for specific stock items using filters.
3.1.4 Product Management
•	Add Product: Add new products with details like name, price, and category.
•	Search Product: Search for products using filters.
•	Update Product: Modify product details.
3.1.5 Cheque Management
•	Add Cheque: Record cheque transactions in the system.
•	View Upcoming Cheques: Display cheques with upcoming dates.
•	Update Cheque: Update cheque details (e.g., status or amount).
3.1.6 Cash Management
•	Add Cash: Record cash transactions.
•	Search Cash: Search for cash transaction records.
•	Update Cash: Update cash transaction details.
3.1.7 Supplier Management
•	Add Supplier: Add new supplier records.
•	Search Supplier: Search for existing suppliers.
•	Update Supplier: Update supplier details.
3.1.8 Debt Management
•	Search Debt: Search for specific debt records.
•	View Debt: Display all debt-related records.
3.1.9 Notifications
•	Notify admin of rejected invoices from customers.
3.1.10 Expense Management
•	Add Expense: Record new expenses.
•	Search Expense: Search for specific expense records.
•	Summary: Provide a summary of expenses over a given period.
•	History: Display the history of all recorded expenses.
3.1.11 Selling Record Management
•	Add Selling Record: Add new selling records.
•	Search Selling Record: Search for existing selling records.
3.2 Customer Functionalities
3.2.1 Notifications
•	Notify customers when their invoices are accepted or rejected.
3.2.2 Reports
•	Search Invoice: Allow customers to search for invoices and make them printable.
•	View Debt: Enable customers to view their debt records.
4. System Architecture
4.1 Frontend
•	Developed using HTML, CSS, and Bootstrap for responsive and user-friendly interfaces.
4.2 Backend
•	PHP for server-side scripting to manage dynamic content and data processing.
4.3 Database
•	MySQL to store and retrieve all system data, including users, customers, stock, products, and financial records.
5. Benefits of the Factory Management System
1.	Centralized management of all factory operations, reducing manual effort.
2.	Improved inventory accuracy and stock tracking.
3.	Streamlined financial management, including cheques, cash, and debt.
4.	Enhanced customer satisfaction with notifications and reporting features.
5.	Real-time updates and reports for better decision-making.
