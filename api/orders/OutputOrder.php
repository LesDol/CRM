<?php


function OutputOrders($clients) {
    require_once 'api/helpers/convertdate.php';
    foreach ($clients as $client) {
        // Извлекаем данные клиента
        $id = htmlspecialchars($client['id']);
        $name = htmlspecialchars($client['name']);
        $order_date = formatOrderDate($client['order_date']);
        $total = htmlspecialchars($client['total']);
        $product_names = str_replace(",", "<br/>",$client['product_names']);


        // Выводим строку таблицы с данными клиента
        echo "
            <tr>
                    <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$order_date</td>
                            <td>$total</td>
                            <td>$product_names</td>
                            <td><i class='fa fa-pencil-square-o fa-1x' aria-hidden='true' onclick=\"MicroModal.show('edit-modal')\"></i>
                            </td>
                            <td><i class='fa fa-trash fa-1x' aria-hidden='true' onclick=\"MicroModal.show('delete-modal')\"></i>
                            </td>
                            <td><i class='fa fa-qrcode fa-1x' aria-hidden='true' onclick=\"MicroModal.show('history-modal')\"></i>
                            </td>
                            <td><i class='fa fa-info-circle fa-1x' aria-hidden='true' onclick=\"MicroModal.show('info-modal')\"></i>
                            </td>
                        </tr>
        ";
    }
}

// <td><i class='fa fa-trash' aria-hidden='true' onclick='MicroModal.show(\"delete-modal\")'></i></td>

?>