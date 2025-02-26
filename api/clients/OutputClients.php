<?php


function OutputClients($clients) {
    foreach ($clients as $client) {
        // Извлекаем данные клиента
        $id = htmlspecialchars($client['id']);
        $name = htmlspecialchars($client['name']);
        $email = htmlspecialchars($client['email']);
        $phone = htmlspecialchars($client['phone']);
        $birthday = htmlspecialchars($client['birthday']);
        $created_at = htmlspecialchars($client['created_at']);

        // Выводим строку таблицы с данными клиента
        echo "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$birthday</td>
                <td>$created_at</td>
                <td>
                <form class = 'main_form' action = 'api/clients/ClientsHistory.php?id=$id'>
                <input value='$id' name = 'id' hidden>
                <input type='date' id = 'from' name = 'from'>
                <input type='date' id = 'to' name = 'to'>
                <button type='submit' class = 'historyBitton'>OK</button>
                </form>
                </td>
                <td><i class='fa fa-pencil-square-o' aria-hidden='true' onclick='MicroModal.show(\"edit-modal\")'></i></td>
                <td><a href='api/clients/DeleteClients.php?id=$id'>
                 <i class='fa fa-trash' aria-hidden='true' ></i>
                </a>
                 </td>
            </tr>
        ";
    }
}

// <td><i class='fa fa-trash' aria-hidden='true' onclick='MicroModal.show(\"delete-modal\")'></i></td>

?>