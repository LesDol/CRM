<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $formData = $_POST;

    $fields = ['fullname', 'email', 'phone', 'birthdate'];
    $errors = [];

    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $errors[$field][] = 'Field is required';
        }
    }

    echo json_encode($errors);

    if (empty($errors)) {
        $_SESSION['clients-errors'] = json_encode($errors);
        header("Location: ../../clients.php");
        exit;
    }
} else {
    echo json_encode([
        "error" => 'Неверный запрос'
    ]);
}
?>
