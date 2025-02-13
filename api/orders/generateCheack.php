<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
$conn->set_charset("utf8");

require '../../vendor/autoload.php';
use Dompdf\Dompdf;

// Проверка наличия ID заказа
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $orderID = $_GET['id'];
    
    // SQL-запрос для получения информации о заказе
    $orderQuery = "SELECT 
                    orders.id,
                    orders.order_date,
                    orders.total,
                    clients.name as client_name,
                    users.name as admin_name,
                    users.surname as admin_surname
                   FROM orders
                   LEFT JOIN clients ON orders.client_id = clients.id
                   LEFT JOIN users ON users.id = 1
                   WHERE orders.id = ?";

    // Получение данных о заказе
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $orderResult = $stmt->get_result()->fetch_assoc();

    // SQL-запрос для получения товаров в заказе
    $itemsQuery = "SELECT 
                    products.name,
                    products.price,
                    order_items.quantity,
                    (order_items.quantity * order_items.price) as total
                   FROM order_items
                   LEFT JOIN products ON order_items.product_id = products.id
                   WHERE order_items.order_id = ?";

$stmt = $conn->prepare($itemsQuery);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$orderItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$data = [
 "orderID" => $orderID,
 "orderDate" => $orderResult['order_date'],
 "adminName" => $orderResult['admin_name'] . ' ' . $orderResult['admin_surname'],
 "clientName" => $orderResult['client_name'],
 "orderItems" => $orderItems,
 "total" => $orderResult['total']
];

    $dompdf = new Dompdf();
    $dompdf->loadHtml('hello worddf'); // Здесь нужно будет добавить HTML-шаблон чека
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('order.pdf');
}
?>