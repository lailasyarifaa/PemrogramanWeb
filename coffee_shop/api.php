<?php
include '../coffee_shop/config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    switch ($method) {
        case 'GET':
            if ($id) {
                $query = "SELECT * FROM coffee_form WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->execute(['id' => $id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($result);
            } else {
                $query = "SELECT * FROM coffee_form";
                $stmt = $conn->query($query);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
            }
            break;

        case 'POST':
            $name = $input['name'];
            $number = $input['number'];
            $guests = $input['guests'];
            $query = "INSERT INTO coffee_form (name, number, guests) VALUES (:name, :number, :guests)";
            $stmt = $conn->prepare($query);
            $stmt->execute(['name' => $name, 'number' => $number, 'guests' => $guests]);
            echo json_encode(["message" => "Booking created"]);
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["error" => "ID is required for PUT requests"]);
                exit();
            }
            $name = $input['name'];
            $number = $input['number'];
            $guests = $input['guests'];
            $query = "UPDATE coffee_form SET name = :name, number = :number, guests = :guests WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->execute(['name' => $name, 'number' => $number, 'guests' => $guests, 'id' => $id]);
            echo json_encode(["message" => "Booking updated"]);
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["error" => "ID is required for DELETE requests"]);
                exit();
            }
            $query = "DELETE FROM coffee_form WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->execute(['id' => $id]);
            echo json_encode(["message" => "Booking deleted"]);
            break;

        default:
            http_response_code(405);
            echo json_encode(["message" => "Method not allowed"]);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    exit();
}
?>
