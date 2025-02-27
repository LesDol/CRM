<?php

session_start();

require_once 'api/helpers/inputDefaultValue.php';

if(isset($_GET['do']) && $_GET['do'] === 'logout'){
    require_once 'api/auth/LogoutUser.php';
    require_once 'api/db.php';
    LogoutUser('login.php',$db,$_SESSION['token']);

    exit;
}

require_once 'api/auth/AuthCheck.php';




AuthCheck('','login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM | Клиенты</title>
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/clients.css">
    <link rel="stylesheet" href="styles/modules/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/modules/microModal.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <p class="header_admin">
                <?php
                    require 'api/db.php';
                    require_once 'api/clients/AdminName.php';

                    echo AdminName($_SESSION['token'],$db);
                ?>
            </p>
            <ul class="header_links"> 
                <li><a href="clients.php">Клиенты</a></li>
                <li><a href="products.php">Товары</a></li>
                <li><a href="orders.php">Заказы</a></li>
            </ul>
            <a href = '?do=logout' class="header_logout">Выйти</a>
        </div>
    </header>
    <main>
        <section class="filters">
            <div class="container">
                <form action = "" method = "GET" class = "main_form">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <label for="search">Поиск</label>
                    <input type="text" id="search" name="search" placeholder="Александр" <?php inputDefaultValue("search","");?>>
                    <select value = "email" name="search_name" id="search_name" >
                    <?php 
                    $searchNameOptions = [
                      [
                        'key' => 'name',
                        'value' => 'Поиск по имени'
                    ],
                    [
                      'key' => 'email',
                      'value' => 'Поиск по почте'
                    ]
                    ];
                    selectDefaultValue("search_name",$searchNameOptions,"name");
                    ?>
                    </select>
                    <select name="sort" id="sort">


                        <?php 
                    $searchNameOptions = [
                      [
                        'key' => '',
                        'value' => 'По умолчанию'
                    ],
                    [
                      'key' => 'ASC',
                      'value' => 'По возрастанию'
                    ],
                    [
                      'key' => 'DESC',
                      'value' => 'По убыванию'
                    ]
                    ];
                    selectDefaultValue("sort",$searchNameOptions,"");
                    ?>
                    </select>
                    <button class = "search" type = "submit">Поиск</button>
                    <a class = "search" href="?">Сбросить</a>
                </form>
            </div>
        </section>
        <section class="clients">
            <div class="container">
                        <h2 class="clients_title">Список клиентов</h2>
                     
                       


   
                          <button onclick="MicroModal.show('add-modal')" class="clients_add"><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i> </button>
                                
                          <div style="text-align: center;">
                <?php 
                require 'api/DB.php';
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $maxClients = 5;
                $_SESSION['maxClients'] = $maxClients;
                $offset = ($currentPage - 1) * $maxClients;
                $_SESSION['offset'] = $offset;

                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
                $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

                $totalClients =  $db -> query("
                SELECT COUNT(*) as count FROM clients WHERE LOWER(name) LIKE '%$search%'
                ")->fetchAll()[0]['count'];

                $maxPage = ceil($totalClients / $maxClients);

                // Проверка на корректность значения текущей страницы
                if ($currentPage < 1) {
                    $currentPage = 1;
                } elseif ($currentPage > $maxPage) {
                    $currentPage = $maxPage;
                }

                $prev = $currentPage - 1;
                if ($currentPage > 1) {
                    echo "  <button><a href='?page=$prev&search=".urlencode($search)."&search_name=$search_name&sort=$sort'><i class='fa fa-chevron-left' aria-hidden='true'></i></a></button>
                            ";
                } else {
                    echo "  <button style='color: gray; cursor: not-allowed;' disabled><i class='fa fa-chevron-left' aria-hidden='true'></i></button>
                            ";
                }
                $next = $currentPage + 1;         

                //echo "  <p>$currentPage / $maxPage</p> ";
                for($i = 1; $i <= $maxPage ;$i++){
                  if($currentPage == $i){
                    echo "<a href='?page=$i&search=".urlencode($search)."&search_name=$search_name&sort=$sort' style='color: green;'>$i</a>";
                  }else{
                    echo "<a href='?page=$i&search=".urlencode($search)."&search_name=$search_name&sort=$sort'style='color: gray; '>$i</a>";
                  }
                  
                }    
                
                if ($currentPage < $maxPage) {
                    echo "  <button><a href='?page=$next&search=".urlencode($search)."&search_name=$search_name&sort=$sort'><i class='fa fa-chevron-right' aria-hidden='true'></i></a></button>
                            ";
                } else {
                    echo "  <button style='color: gray; cursor: not-allowed;' disabled><i class='fa fa-chevron-right' aria-hidden='true'></i></button>
                            ";
                }
      
                ?>
            </div>
                  
                   
                        <div class="table-wrap">
                        <table>
                    <thead>
                        <th>ИД</th>
                        <th>ФИО</th>
                        <th>Почта</th>
                        <th>Телефон</th>
                        <th>День рождения</th>
                        <th>Дата создания</th>
                        <th>История заказа</th>
                        <th>Радактировать</th>
                        <th>Удалить</th>
                    </thead>
                    <tbody>
                        <?php
                            
                            require_once 'api/db.php';
                            require_once 'api/clients/OutputClients.php';
                            require_once 'api/clients/ClientsSearch.php';


                            $clients = ClientsSearch($_GET, $db);
                            
                            // $clients = $db->query(
                            //     "SELECT * FROM clients
                            //      ") ->fetchAll();
                            
                            OutputClients($clients);
                        ?>
                  
                    </tbody>
                </table>
            </div>
            </div>
        </section>
    </main>



<div class="modal micromodal-slide     
<?php
    if(isset($_SESSION['clients_errors']) && !empty($_SESSION['clients_errors'])){
      echo "open";
    }
    ?>" id="error-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
                Ошибка
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
              <?php
                 if(isset($_SESSION['clients_errors']) && !empty($_SESSION['clients_errors'])){
                  echo  $_SESSION['clients_errors'];
                  $_SESSION['clients_errors'] = '';
                }
              ?>
            </main>
          </div>
        </div>
      </div>

    

    
    <div class="modal micromodal-slide" id="add-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
                Добавить клиента
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <form action = "api/clients/AddClients.php" method = "POST">
                    <div class="form-group">
                        <label for="fullname">ФИО</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Введите ваше ФИО" >
                    </div>
                    <div class="form-group">
                        <label for="email">Почта</label>
                        <input type="email" id="email" name="email" placeholder="Введите вашу почту" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone" placeholder="Введите ваш телефон" >
                    </div>
                    <div class="form-group">
                        <label for="birthdate">День рождения</label>
                        <input type="date" id="birthdate" name="birthdate" >
                    </div>
                    <div class="button-group">
                        <button type="submit" class="create">Создать</button>
                        <button type="button" class="cancel" onclick="window.location.reload();">Отменить</button>
                    </div>
                </form>
            </main>
          </div>
        </div>
      </div>

    <div class="modal micromodal-slide" id="delete-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
                Вы уверены, что хотите удалить клиента ?
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <form>
                    <div class="button-group">
                        <button type="submit" class="create">Удалить</button>
                        <button type="button" class="cancel" onclick="window.location.reload();">Отменить</button>
                    </div>
                </div>
                </form>
            </main>
          </div>
        </div>
    <div class="modal micromodal-slide" id="edit-modal" aria-hidden="true">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
              <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                  <h2 class="modal__title" id="modal-1-title">
                    Редактировать клиента
                  </h2>
                  <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <form>
                        <div class="form-group">
                            <label for="full-name">ФИО</label>
                            <input type="text" id="full-name" name="full-name" placeholder="Введите ваше ФИО" >
                        </div>
                        <div class="form-group">
                            <label for="email">Почта</label>
                            <input type="email" id="email" name="email" placeholder="Введите вашу почту" >
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" name="phone" placeholder="Введите ваш телефон" >
                        </div>
                        <div class="button-group">
                            <button type="submit" class="create">Сохранить</button>
                            <button type="button" class="cancel" onclick="window.location.reload();">Отменить</button>
                        </div>
                    </form>
                </main>
              </div>
            </div>
          </div>

    <div class="modal micromodal-slide" id="history-modal" aria-hidden="true">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
              <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                  <h2 class="modal__title" id="modal-1-title">
                    История заказов
                  </h2>
                  <small>Фамилия Имя Отчество</small>
                  <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <form>
                        <div class="order">
                                <div class="order_info">
                                    <h3 class="order_number">Заказ №1</h3>
                                    <time class="order_date">Дата оформления :<b> 2025-01-13 09:25:03</b></time>
                                    <p class="order_total">Общая сумма : <b>300.00р</b></p>
                                </div>
                                
                                    <table class="order_items">
                                        <tr>
                                            <th>ИД</th>
                                            <th>Название товара</th>
                                            <th>Количество</th>
                                            <th>Цена</th>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>Футболка</td>
                                            <td>10</td>
                                            <td>10000</td>
                                        </tr>
                                    </table>                              
                        </div>
                    </form>
                </main>
              </div>
            </div>
          </div>

          <div class="modal micromodal-slide <?php
          if(isset($_SESSION["clients_errors"]) && !empty($_SESSION["clients_errors"])){
              echo "open";
          }
          
          ?>" id="error-modal" aria-hidden="true" >
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
               Ошибка
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <p>ТЕКСТ ОШИБКИ</p>
            </main>
          </div>
        </div>
      </div>
       

    <script defer src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script defer src="scripts/initClientsModal.js"></script>
</body>
</html>