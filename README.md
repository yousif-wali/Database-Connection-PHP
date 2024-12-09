
# UserDB PHP Class

This project provides a `UserDB` class to interact with a MySQL database for performing basic CRUD (Create, Read, Update, Delete) operations on a `Users` table.

## Database Layout

The `Users` table has the following columns:

- **Id**: `int` (AUTO_INCREMENT, Primary Key)
- **Username**: `text`
- **Email**: `text`
- **Role**: `enum("Admin", "Regular")`

## Prerequisites

- PHP 7.0 or higher
- MySQL database
- Access to a running MySQL server

## Setup

1. **Clone or download the repository** to your local machine.
   
2. **Database Configuration**: Edit the `MySQLiConnection` class inside `database.php` to include your own database connection credentials:
    ```php
    $con = new MySQLiConnection('localhost', 'root', '', 'Users');
    ```

3. **Create the Users table**: Make sure the `Users` table exists in your MySQL database. You can create it using this SQL query:
    ```sql
    CREATE TABLE Users (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Username TEXT NOT NULL,
        Email TEXT NOT NULL,
        Role ENUM('Admin', 'Regular') NOT NULL
    );
    ```

4. **Include the database file**: Make sure you include `database.php` in your project to enable database functionality.

## Class Overview

### `UserDB` Class

The `UserDB` class allows for CRUD operations on the `Users` table using the provided `DB` class for database connection.

### Methods

1. **insert**(string $Username, string $Email, string $Role)
   - Inserts a new user into the database.
   - **Parameters**:
     - `$Username`: The user's username.
     - `$Email`: The user's email address.
     - `$Role`: The user's role (either "Admin" or "Regular").
   - **Example**:
     ```php
     $userDB->insert("JohnDoe", "johndoe@example.com", "Regular");
     ```

2. **delete**(int $Id)
   - Deletes a user from the database based on their `Id`.
   - **Parameters**:
     - `$Id`: The ID of the user to be deleted.
   - **Example**:
     ```php
     $userDB->delete(1); // Delete user with ID 1
     ```

3. **update**(int $Id, string $Username, string $Email, string $Role)
   - Updates the details of an existing user in the database.
   - **Parameters**:
     - `$Id`: The ID of the user to be updated.
     - `$Username`: The new username.
     - `$Email`: The new email.
     - `$Role`: The new role ("Admin" or "Regular").
   - **Example**:
     ```php
     $userDB->update(1, "JohnDoeUpdated", "johnupdated@example.com", "Admin");
     ```

4. **select**(int $Id = null)
   - Retrieves users from the database. If `$Id` is provided, it fetches a specific user; otherwise, it fetches all users.
   - **Parameters**:
     - `$Id`: The ID of the user to be retrieved (optional).
   - **Example**:
     ```php
     // Get all users
     $users = $userDB->select();
     print_r($users);

     // Get user by ID
     $user = $userDB->select(1);
     print_r($user);
     ```

## Example Usage

Here’s how you can use the `UserDB` class to perform CRUD operations:

```php
// Include the database file
include 'database.php';

// Create a new database connection
$con = new MySQLiConnection('localhost', 'root', '', 'Users');
$db = new DB($con);

// Instantiate the UserDB class
$userDB = new UserDB($db);

// Insert a new user
$userDB->insert("JohnDoe", "johndoe@example.com", "Regular");

// Update a user with ID 1
$userDB->update(1, "JohnDoeUpdated", "johnupdated@example.com", "Admin");

// Delete a user with ID 1
$userDB->delete(1);

// Retrieve all users
$users = $userDB->select();
print_r($users);

// Retrieve a user with ID 1
$user = $userDB->select(1);
print_r($user);
```

## Error Handling

The class methods throw exceptions if an error occurs during the query execution. You can catch these exceptions using `try-catch` blocks:

```php
try {
    $userDB->insert("JohnDoe", "johndoe@example.com", "Regular");
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

# Happy Coding :)
