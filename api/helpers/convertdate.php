<?php
function formatOrderDate($orderDate) {

    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $orderDate);

    if ($dateTime === false) {
        return "Неверный формат даты";
    }

    return $dateTime->format('d.m.Y H:i');
}

$orderDate = '2025-01-13 09:25:36';
$formattedDate = formatOrderDate($orderDate);
echo $formattedDate; 
?>

