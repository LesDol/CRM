<?php


function OutputProducts($products) {
    foreach ($products as $product) {
        // Извлекаем данные клиента
        $id = htmlspecialchars($product['id']);
        $name = htmlspecialchars($product['name']);
        $desc = htmlspecialchars($product['description']);
        $price  = htmlspecialchars($product['price']);
        $stock = htmlspecialchars($product['stock']);

        // Выводим строку таблицы с данными клиента
        echo "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$desc</td>
                <td>$price</td>
                <td>$stock</td>
                <td><i class='fa fa-pencil-square-o fa-1x' aria-hidden='true' onclick=\"MicroModal.show('edit-modal')\"></i>
                </td>
                <td><a href='api/products/DeleteProducts.php?id=$id'>
                 <i class='fa fa-trash' aria-hidden='true' ></i>
                </a></td>
                <td><a href='api/products/generateQR.php?id=$id'><i class='fa fa-qrcode fa-1x' aria-hidden='true' ></i></a>
                </td>
 
                 
            </tr>
        ";
    }
}
// <td><i class='fa fa-trash' aria-hidden='true' onclick='MicroModal.show(\"delete-modal\")'></i></td>


?>