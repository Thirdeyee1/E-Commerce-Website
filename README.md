# E-Commerce-Website
Here's an overview you can use for your GitHub repository of the eCommerce website you developed for the bolt shop:

---

# Bolt Shop eCommerce Website

This project is an eCommerce platform for a bolt shop, allowing users to browse products, manage orders, and complete payments online. The website features secure user registration, product listings, and an integrated payment system using PayPal. The backend is powered by SQL databases to handle orders, payments, and user data efficiently.

## Features

- **Product Listings**: View and search for bolts and related products.
- **User Management**: Secure user registration and login system.
- **Order Processing**: Track orders and update their status.
- **Payment Integration**: Integrated PayPal payment system for secure and easy transactions.
- **SQL Database**: Manages items, orders, payments, products, and users with relational tables.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP for server-side logic
- **Database**: SQL for relational data management
- **Payment Gateway**: PayPal (modified HTML integration for ease of use)
  
## Database Schema (Sample Tables)

The database consists of several tables for managing products, users, orders, and payments. Here is a sample of the SQL schema:

### `users` Table
| id | name       | email          | password_hash | created_at          |
|----|------------|----------------|---------------|---------------------|
| 1  | John Doe   | john@example.com | [hash]        | 2024-08-22 10:00:00 |

### `products` Table
| id  | name        | description   | price | stock |
|-----|-------------|---------------|-------|-------|
| 1   | Hex Bolt    | Stainless steel | 1.00  | 100   |

### `orders` Table
| id  | user_id | total_price | status  | created_at          |
|-----|---------|-------------|---------|---------------------|
| 1   | 1       | 50.00       | pending | 2024-08-22 10:05:00 |

### `payments` Table
| id  | order_id | payment_method | payment_status | created_at          |
|-----|----------|----------------|----------------|---------------------|
| 1   | 1        | PayPal         | completed      | 2024-08-22 10:10:00 |

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone [https://github.com/Thirdeyee1/E-Commerce-Website.git]
   ```
2. Configure the SQL database using the provided schema files.
3. Update the PayPal integration with your merchant account details in the payment settings.
4. Run the website locally using a PHP server or deploy it to your hosting platform.

## PayPal Integration

The PayPal payment integration has been modified for ease of use due to updates in their HTML code structure. Ensure to review and test the payment process during deployment.
