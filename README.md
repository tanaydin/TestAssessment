# RoomRaccoon Assessment - Shopping List Application

This is a PHP-based shopping list application created as an assessment for RoomRaccoon. The application allows users to manage a shopping list with the ability to add, update, toggle completion status, and delete items.

## Features

- Add new items to the shopping list
- Mark items as completed/incomplete
- Update item names
- Delete items from the list
- Persistent storage using SQLite database

## Requirements

- PHP 7.4 or higher
- SQLite support (usually included with PHP)

## How to Run

1. Navigate to the project directory:
   ```bash
   cd /path/to/RoomRaccoonAssessment
   ```

2. Start the PHP development server:
   ```bash
   php -S localhost:8000
   ```

3. Open your web browser and navigate to:
   ```
   http://localhost:8000
   ```

## Database Setup

The application will automatically:
- Create the `shopping_list.db` SQLite database file if it doesn't exist
- Create the necessary `items` table with the following structure:
  - `id` (INTEGER PRIMARY KEY AUTOINCREMENT)
  - `name` (TEXT NOT NULL)
  - `completed` (BOOLEAN DEFAULT 0)

No manual database setup is required - everything is handled automatically when you first run the application.

## Project Structure

```
RoomRaccoonAssessment/
├── assets/
│   ├── css/
│   │   └── styles.css          # Application styles
│   └── js/
│       └── script.js           # Frontend JavaScript functionality
├── controllers/
│   ├── BaseController.php      # Base controller class
│   └── ShoppingListController.php  # Shopping list controller
├── core/                       # Core application files
├── models/
│   ├── BaseModel.php           # Base model class
│   ├── database.php            # Database connection and setup
│   └── Item.php                # Item model
├── views/
│   ├── BaseView.php            # Base view class
│   ├── layouts/
│   │   ├── footer.php          # Footer layout
│   │   └── header.php          # Header layout
│   └── shopping_list.php       # Shopping list view
├── index.php                   # Application entry point
├── shopping_list.db            # SQLite database file
└── README.md                   # Project documentation
```

## Usage

Once the server is running, you can:
- Add new items using the input field and "Add Item" button
- Click on items to toggle their completion status
- Edit item names by clicking the edit icon
- Delete items by clicking the delete icon

The application uses AJAX for seamless interactions without page refreshes.
