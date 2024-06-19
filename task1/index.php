<?php
require_once 'db_connect.php';

// Function to insert a new user
function insertUser($conn, $name, $email)
{
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);

    if ($stmt->execute()) {
        echo "New user created successfully<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Function to retrieve and display all users
function getUsers($conn)
{
    $sql = "SELECT id, name, email, created_at FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . " - Created At: " . $row["created_at"] . "<br>";
        }
    } else {
        echo "No users found<br>";
    }
}

// Function to update a user
function updateUser($conn, $id, $name, $email)
{
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        echo "User updated successfully<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Function to delete a user
function deleteUser($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "User deleted successfully<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

insertUser($conn, "John Doe", "john.doe@example.com");
insertUser($conn, "Jane Doe", "jane.doe@example.com");

echo "User list:<br>";
getUsers($conn);

updateUser($conn, 1, "John Smith", "john.smith@example.com");

echo "Updated user list:<br>";
getUsers($conn);

deleteUser($conn, 2);

echo "Final user list:<br>";
getUsers($conn);

$conn->close();
