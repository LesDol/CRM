<?php
session_start();

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

require_once '../db.php';
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    

    $clientID = $_GET['id'];

    $dateFROM = $_GET['from'];
    $dateTo = $_GET['to'];

    $_SESSION['clients_errors'] = '';
    if($dateFROM > $dateTo){
        ob_start();

        echo '<ul class="error-list">';
             
        echo '<li><p style="color: white;">' . 'Дата "from" больше чем дата "to"' . '</p></li>';
        
        echo '</ul>';
        $_SESSION['clients_errors'] = ob_get_clean();  
        header("Location: ../../clients.php");
        exit;
    }

    $history = [
        'user' => '',
        'orders' => []
    ];

    // Добавляем запрос для получения заказов по ID клиента
    $query = "SELECT * FROM orders WHERE client_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$clientID]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as $order) {
        // Запрос для получения элементов заказа
        $itemsQuery = "SELECT * FROM order_items WHERE order_id = ?";
        $itemsStmt = $db->prepare($itemsQuery);
        $itemsStmt->execute([$order['id']]);
        $items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

        $history['orders'][] = [
            "id" => $order['id'],
            "date" => $order['order_date'],
            "total" => $order['total'],
            "items" => $items // Добавляем элементы заказа
        ];
    }
    $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 20px; }
        h1 { color: #333; }
        .order { background: #fff; border: 1px solid #ddd; border-radius: 5px; padding: 15px; margin-bottom: 20px; }
        .order h2 { margin: 0 0 10px; }
        .order p { margin: 5px 0; }
        .items { margin-top: 10px; }
        .item { background: #f9f9f9; border: 1px solid #ccc; padding: 10px; margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Client Order History</h1>';

    foreach ($history['orders'] as $order) {
        $html .= '<div class="order">
            <h2>Order ID: ' . htmlspecialchars($order['id']) . '</h2>
            <p>Date: ' . htmlspecialchars($order['date']) . '</p>
            <p>Total: ' . htmlspecialchars($order['total']) . ' rub.</p>
            <div class="items">
                <h3>Order Items:</h3>';

        foreach ($order['items'] as $item) {
            $html .= '<div class="item">
                <p>Product ID: ' . htmlspecialchars($item['product_id']) . '</p>
                <p>Quantity: ' . htmlspecialchars($item['quantity']) . '</p>
                <p>Price: ' . htmlspecialchars($item['price']) . ' rub.</p>
            </div>';
        }

        $html .= '</div></div>';
    }

    $html .= '</body></html>';

    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Times New Roman');
    $dompdf->setOptions($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('history.pdf');


    echo json_encode($history['orders']);
}
?>