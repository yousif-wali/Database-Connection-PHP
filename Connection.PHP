<?php

///////////////////////////////////////////////////////////
//                                                       //
//              Database Layout                          //
//                                                       //
//      Table : Users                                    //
//      Columns:                                         //
//              Id       => int (AUTO_INCREMENT)         //
//              Username => text                         //
//              Email    => text                         //
//              Role     => enum("Admin", "Regular")     //
//                                                       //
//                                                       //
///////////////////////////////////////////////////////////


// Including your database file
include 'database.php';

// Making a class for our Table.
class UserDB {
    private $db;

    // Constructor accepts a DB object for the database connection
    public function __construct(DB $db) {
        $this->db = $db;
    }

    // Insert function to add a new user
    public function insert(string $Username, string $Email, string $Role) {
        try {
            $queryString = "INSERT INTO Users (Username, Email, Role) VALUES (?, ?, ?)";
            $result = $this->db->query($queryString, [$Username, $Email, $Role]);

            if ($result) {
                echo "User inserted successfully!";
            } else {
                throw new Exception("Could not insert user.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Delete function to remove a user by their ID
    public function delete(int $Id) {
        try {
            $queryString = "DELETE FROM Users WHERE Id = ?";
            $result = $this->db->query($queryString, [$Id]);

            if ($result) {
                echo "User deleted successfully!";
            } else {
                throw new Exception("Could not delete user.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Update function to update user information by their ID
    public function update(int $Id, string $Username, string $Email, string $Role) {
        try {
            $queryString = "UPDATE Users SET Username = ?, Email = ?, Role = ? WHERE Id = ?";
            $result = $this->db->query($queryString, [$Username, $Email, $Role, $Id]);

            if ($result) {
                echo "User updated successfully!";
            } else {
                throw new Exception("Could not update user.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Select function to retrieve user(s) by ID or all users
    public function select(int $Id = null) {
        try {
            if ($Id) {
                $queryString = "SELECT * FROM Users WHERE Id = ?";
                $result = $this->db->query($queryString, [$Id]);
            } else {
                $queryString = "SELECT * FROM Users";
                $result = $this->db->query($queryString);
            }

            if ($result) {
                return $result;
            } else {
                throw new Exception("Could not retrieve users.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

// Initializing the credentials for your database
$con = new MySQLiConnection('localhost', 'root', '', 'Users');
// Connecting to your database
$db = new DB($con);
// Create an instance of the UserDB class
$userDB = new UserDB($db);


// Example operations
// Insert a new user
$userDB->insert("JohnDoe", "johndoe@example.com", "Regular");

// Update an existing user with ID 1
$userDB->update(1, "JohnDoeUpdated", "johnupdated@example.com", "Admin");

// Select all users
$users = $userDB->select();
print_r($users);

// Select a user by ID
$user = $userDB->select(1);
print_r($user);

// Delete a user by ID
$userDB->delete(1);
?>