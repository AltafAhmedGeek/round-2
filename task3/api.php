<?php
header("Content-Type: application/json");
require_once './includes/db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Retrieve a specific item
            $id = intval($_GET['id']);
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            echo json_encode($product);
            $stmt->close();
        } else {
            // Retrieve a list of items
            $result = $conn->query("SELECT * FROM products");
            $products = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($products);
        }
        break;

    case 'POST':
        // Add a new item
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $data['name'], $data['description'], $data['price']);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Product created successfully', 'id' => $stmt->insert_id]);
        } else {
            echo json_encode(['error' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'PUT':
        // Update an existing item
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?");
            $stmt->bind_param("ssdi", $data['name'], $data['description'], $data['price'], $id);
            if ($stmt->execute()) {
                echo json_encode(['message' => 'Product updated successfully']);
            } else {
                echo json_encode(['error' => $stmt->error]);
            }
            $stmt->close();
        }
        break;

    case 'DELETE':
        // Delete an item
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(['message' => 'Product deleted successfully']);
            } else {
                echo json_encode(['error' => $stmt->error]);
            }
            $stmt->close();
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}

$conn->close();
?>
