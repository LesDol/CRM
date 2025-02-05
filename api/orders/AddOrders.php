<?php
session_start();
require_once '../db.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $formData = $_POST;

    $fields = ['clients', 'products'];
    $errors = [];
    $_SESSION['orders_errors'] = '';



    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $errors[$field][] = 'Field is required';
        }
    }

    $productIds = $formData['products'];
    $allProducts = $db->query("
        SELECT id, name, price, stock 
        FROM products
        WHERE id IN (" . implode(',', $productIds) .")
    ")->fetchAll();

    // Подсчитываем общую сумму заказа
    $total = array_sum(array_column($allProducts, 'price'));

    echo json_encode($total);
    $orders = [
        'id' => time(),
        'client_id' => $formData['clients'],
        'total' => $total,
        'status' => 'Pending'
    ];
    


    if (!empty($errors)) {
        ob_start();

        echo '<ul class="error-list">';
        foreach ($errors as $field => $messages) {
            foreach ($messages as $message) {
                echo '<li><p style="color: white;">' . htmlspecialchars($field) . ' : ' . htmlspecialchars($message) . '</p></li>';
            }
        }
        echo '</ul>';
        $_SESSION['orders_errors'] = ob_get_clean();  
        header("Location: ../../orders.php");
        exit;
    }

    // Добавляем заказ в базу данных
    $stmt = $db->prepare("
        INSERT INTO orders (id,client_id, total, status) 
        VALUES (:id,:client_id, :total, :status)
    ");
    
    $stmt->execute($orders);
    
    // Добавляем элементы заказа в таблицу order_items
    $order_id = $orders['id'];
    $stmt_items = $db->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price) 
        VALUES (:order_id, :product_id, :quantity, :price)
    ");

    foreach ($productIds as $product_id) {
        
        $product = array_filter($allProducts, function($p) use ($product_id) {
            return $p['id'] == $product_id;
        });
        $product = reset($product); 
        $item_data = [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => 1, 
            'price' => $product['price']
        ];
        
        $stmt_items->execute($item_data);
    }
    
    header("Location: ../../orders.php");
    exit;




    // if(empty($IdClients)){
    //     $created_at = date('Y-m-d H:i:s');
    //     $request = $db->
    //     prepare("
    //     INSERT INTO `orders`( 
    //     `name`, 
    //     `email`,
    //     `phone`,
    //     `birthday`,
    //     `created_at`) 
    //     VALUES (?,?,?,?,?) 
    //     "
    //     )->execute([
    //         $formData['fullname'],
    //         $formData['email'],
    //         $formData['phone'],
    //         $formData['birthdate'],
    //         $created_at
    //     ]);
    //     header("Location: ../../orders.php");

    // }else{
    //     echo json_encode([
    //         "error" => 'Такой пользователь уже есть'
    //     ]);
    // }

         
} else {
    echo json_encode([
        "error" => 'Неверный запрос'
    ]);
}
?>
