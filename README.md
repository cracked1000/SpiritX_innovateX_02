# SpiritX_innovateX_02

## Overview
SpiritX_innovateX_02 is a Laravel-based web application for managing a cricket fantasy league. Users can sign up, select a team of 11 players (batsmen, bowlers, all-rounders) within a budget, and compete on a leaderboard based on their team's points. Admins can manage players, view tournament summaries, and more.

## Features
- User authentication (signup, login, logout)
- Team selection with budget constraints (Rs. 9,000,000)
- Leaderboard displaying users ranked by total team points (rounded)
- Admin panel for managing players (CRUD operations)
- Player statistics (runs, wickets, points calculation)
- Budget management for users
- MySQL database for storing users, players, and teams

## Prerequisites
Before setting up the project, ensure you have the following installed on your machine:

- PHP (>= 8.1)
- Composer (for dependency management)
- MySQL (e.g., MySQL Workbench or MySQL Community Server)
- Git
- Node.js (optional, for front-end assets if using Vite)
- A web server (e.g., Laravel's built-in server via `php artisan serve`)

## Installation

### 1. Clone the Repository
Clone the project from GitHub to your local machine:

```bash
git clone https://github.com/yourusername/SpiritX_innovateX_02.git
cd SpiritX_innovateX_02
```
Replace `yourusername` with your actual GitHub username.

### 2. Install Dependencies
Install the PHP dependencies using Composer:

```bash
composer install
```
If you’re using front-end assets (e.g., via Vite), install Node.js dependencies as well:

```bash
npm install
npm run dev  # Or `npm run build` for production
```

### 3. Set Up the Environment File
Create a `.env` file by copying the provided `.env.example`:

```bash
cp .env.example .env
```
Open the `.env` file in a text editor and configure the MySQL database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spirit11
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```
Replace `your_mysql_password` with your actual MySQL password (e.g., `root` if using the default setup). If you prefer a different database name, update `DB_DATABASE` accordingly.

Generate an application key:

```bash
php artisan key:generate
```

### 4. Set Up MySQL Database
Ensure MySQL is installed and running on your machine.

#### Start MySQL:
- On macOS (with Homebrew):
  ```bash
  brew services start mysql
  ```
- On Ubuntu:
  ```bash
  sudo service mysql start
  ```
- On Windows: Use MySQL Workbench or the Services panel to start MySQL.

#### Create the Database:
Log in to MySQL:

```bash
mysql -u root -p
```
Enter your MySQL password (e.g., `root`).

Create the database and grant permissions:

```sql
CREATE DATABASE spirit11;
GRANT ALL PRIVILEGES ON spirit11.* TO 'root'@'localhost' IDENTIFIED BY 'your_mysql_password';
FLUSH PRIVILEGES;
EXIT;
```

### 5. Run Migrations
Migrate the database to create the necessary tables (users, players, user_players, sessions):

```bash
php artisan migrate
```
If you encounter an error, ensure your MySQL credentials in `.env` are correct and the MySQL server is running.

### 6. (Optional) Seed the Database
If your project includes seeders for initial data (e.g., players), run:

```bash
php artisan db:seed
```
Note: If you haven’t created seeders, you can manually add players via the admin panel or create a seeder.

### 7. Start the Development Server
Run the Laravel development server:

```bash
php artisan serve
```
Open your browser and visit [http://127.0.0.1:8000](http://127.0.0.1:8000).

### 8. Log In or Sign Up
- **Sign Up:** Register a new user via the `/signup` route.
- **Log In:** Use your credentials to log in via the `/login` route.
- **Admin Access:** To access the admin panel, create a user with `is_admin=1` in the `users` table or modify the signup process to assign admin privileges.

## Usage

### Select a Team
After logging in, go to `/select-team` to pick 11 players (minimum 1 batsman, 6 bowlers, 4 all-rounders) within the Rs. 9,000,000 budget.

### View Leaderboard
Visit `/leaderboard` to see users ranked by their team’s total points (rounded).

### Manage Players (Admin)
Admins can access `/admin/players` to add, edit, or delete players.

### Tournament Summary (Admin)
Admins can view overall stats at `/admin/tournament-summary`.

### API Endpoints (For Development & Integration)
For developers integrating with external services or mobile apps, here are some API endpoints:

#### User Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Authenticate a user
- `POST /api/logout` - Log out the authenticated user

#### Team Management
- `GET /api/team` - Get the authenticated user’s team
- `POST /api/team/select` - Select players for the team

#### Leaderboard
- `GET /api/leaderboard` - Get the leaderboard rankings

#### Player Management (Admin Only)
- `GET /api/players` - List all players
- `POST /api/players` - Add a new player
- `PUT /api/players/{id}` - Update player details
- `DELETE /api/players/{id}` - Remove a player

## Contribution
If you’d like to contribute:
1. Fork the repository.
2. Create a new branch (`feature/your-feature-name`).
3. Commit your changes.
4. Push to your fork and create a pull request.

## License
This project is licensed under the MIT License.
