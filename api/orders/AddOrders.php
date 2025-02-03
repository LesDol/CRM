<?php
session_start();
require_once '../db.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $formData = $_POST;

    $fields = ['clieants', 'products'];
    $errors = [];
    $_SESSION['orders_errors'] = '';



    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            $errors[$field][] = 'Field is required';
        }
    }

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
