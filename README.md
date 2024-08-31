# Laravel API Application
# Fullstack Developer Challenge - Wallet System

## Overview

This project is a basic wallet system for a fintech company that allows users to manage their funds. It supports functionalities such as user authentication, creating wallets, depositing funds, withdrawing funds, and checking wallet balances.

## Features

- **User Authentication**: Secure login and registration system.
- **Wallet Management**:
  - Each user gets a wallet created upon registration.
  - Users can top up their wallets.
  - Users can transfer money to other users.
  - Users can check their current balance and transaction history.
- **Peer-to-Peer Transfers**:
  - Transfers between users of the same app.
  - Validation checks (e.g., sufficient balance, recipient existence).
  - Transaction fee calculation: If the transfer amount exceeds $25, a fee of $2.5 plus 10% of the transfer amount is applied.
- **Security Measures and Error Handling**: Comprehensive error handling and security best practices.

## Tech Stack

- **Backend**: Laravel 10+
- **Frontend**: Bootstrap (optional for web UI)
- **Database**: MySQL
- **PHP Version**: 8.1+

## Installation

### Prerequisites

- [PHP](https://www.php.net/manual/en/install.php) 8.1+
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://dev.mysql.com/downloads/)
- [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)

### Clone the Repository

```bash
git clone https://github.com/amany-makhlof/recapet.git
cd recapet
Start Laravel Sail
Laravel Sail is a Docker-based local development environment for Laravel. To start Sail:

bash
Copy code
./vendor/bin/sail up
Install PHP Dependencies
bash
Copy code
./vendor/bin/sail composer install
Install Frontend Dependencies (Optional)
For web UI projects, install frontend dependencies:

bash
Copy code
./vendor/bin/sail npm install
Set Up Environment Variables
Copy the example environment file and update it:

bash
Copy code
cp .env.example .env
Edit the .env file with your database and other configuration settings.

Generate Application Key
bash
Copy code
./vendor/bin/sail artisan key:generate
Run Migrations
bash
Copy code
./vendor/bin/sail artisan migrate
Compile Assets (Optional)
For web UI projects, compile your frontend assets:

bash
Copy code
./vendor/bin/sail npm run dev
Running the Application
With Sail up and running, you can access the application in your browser at:

arduino
Copy code
http://localhost
Testing
To run tests:

bash
Copy code
./vendor/bin/sail test
Routes and Controllers
API Routes
The following routes are available for the API:

POST /api/register

Registers a new user.
Controller: RegisterController
Route Name: register
POST /api/login

Logs in an existing user and returns an authentication token.
Controller: LoginController
Route Name: login
POST /api/logout

Logs out the authenticated user by invalidating the authentication token.
Controller: LoginController
Route Name: logout (Requires auth:sanctum middleware)
POST /api/wallet/topup

Top-ups the user's wallet.
Controller: WalletController
Route Name: topup (Requires auth:sanctum middleware)
POST /api/wallet/transfer

Transfers funds from one wallet to another.
Controller: WalletController
Route Name: transfer (Requires auth:sanctum middleware)
GET /api/wallet/balance

Checks the balance of the user's wallet.
Controller: WalletController
Route Name: balance (Requires auth:sanctum middleware)
GET /api/wallet/transactions

Retrieves the transaction history of the user's wallet.
Controller: WalletController
Route Name: transactions (Requires auth:sanctum middleware)
Web Routes
The following routes are available for the web interface:

GET /

Displays the home page.
Controller: HomeController
Route Name: home
GET /login

Displays the login form.
Controller: LoginController
Route Name: login
POST /login

Submits the login form and logs in the user.
Controller: LoginController
GET /register

Displays the registration form.
Controller: RegisterController
Route Name: register
POST /register

Submits the registration form and creates a new user.
Controller: RegisterController
POST /logout

Logs out the authenticated user.
Controller: LoginController
Route Name: logout (Requires auth middleware)
GET /wallet/top-up

Displays the top-up form for the wallet.
Controller: WalletController
Route Name: wallet.topUpForm
POST /wallet/top-up

Submits the top-up form and adds funds to the wallet.
Controller: WalletController
Route Name: wallet.topUp
GET /wallet/transfer

Displays the transfer form for the wallet.
Controller: WalletController
Route Name: wallet.transferForm
POST /wallet/transfer

Submits the transfer form and transfers funds between wallets.
Controller: WalletController
Route Name: wallet.transfer
GET /wallet/transactions

Displays the transaction history of the wallet.
Controller: WalletController
Route Name: wallet.transactions
Contributing
Fork the repository.
Create a feature branch:
bash
Copy code
git checkout -b feature/your-feature
Commit your changes:
bash
Copy code
git commit -am 'Add some feature'
Push to the branch:
bash
Copy code
git push origin feature/your-feature
Create a new Pull Request.
Contact
For any questions or issues, please contact Your Name.

Happy Coding! ☺
