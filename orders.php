<?php

session_start();

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
    <title>CRM | Товары</title>
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
                <li><a href="">Клиенты</a></li>
                <li><a href="">Товары</a></li>
                <li><a href="">Заказы</a></li>
            </ul>
            <a href = '?do=logout' class="header_logout">Выйти</a>
        </div>
    </header>
    <main>
        <section class="filters">
            <div class="container">
                <form action="">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <label for="search">Поиск по названию</label>
                    <input type="text" id="search" name="search" placeholder="Негр">
                    <select name="sort" id="sort">
                        <option value="0">Название</option>
                        <option value="1">Цена</option>
                        <option value="2">Количество</option>
                    </select>
                    <select name="sort" id="sort">
                        <option value="0">По возрастанию</option>
                        <option value="1">По убыванию</option>
                    </select>
                </form>
            </div>
        </section>
        <section class="clients">
            <div class="container">
                        <h2 class="clients_title">Список заказов</h2>
                        <button onclick="MicroModal.show('add-modal')" class="clients_add"><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
                        </button>
                   
                        <div class="table-wrap">
                        <table>
                    <thead>
                        <th>ИД</th>
                        <th>ФИО клиента</th>
                        <th>дата заказа</th>
                        <th>цена</th>
                        <th>название</th>
                        <th>количество</th>
                        <th>Итоговая цена</th>
                        <th>Радактировать</th>
                        <th>Удалить</th>
                        <th>Генерация чека</th>
                        <th>подробнее</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0</td>
                            <td>Надежда Адольфовна</td>
                            <td>2000-02-02</td>
                            <td>1$</td>
                            <td>НЕГР</td>
                            <td>2 шт.</td> 
                            <td>2$</td>
                            <td><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i>
                            </td>
                            <td><i class="fa fa-trash fa-1x" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i>
                            </td>
                            <td><i class="fa fa-qrcode fa-1x" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i>
                            </td>
                            <td><i class="fa fa-info-circle fa-1x" aria-hidden="true" onclick="MicroModal.show('info-modal')"></i>
                            </td>


                        </tr>

                    </tbody>
                </table>
            </div>
            </div>
        </section>
    </main>
    <div class="modal micromodal-slide" id="add-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
                Добавить товар
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <form>
                    <div class="form-group">
                        <label for="full-name">Название</label>
                        <input type="text" id="full-name" name="full-name" placeholder="Введите название товара" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Описание</label>
                        <input type="text" id="desc" name="desc" placeholder="Введите описание товара" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text" id="price" name="price" placeholder="Введите цену товара" required>
                    </div>
                    <div class="form-group">
                        <label for="cout">Количество</label>
                        <input type="text" id="cout" name="cout" placeholder="Введите количество товара" required>
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
      <div class="modal micromodal-slide" id="edit-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="modal__title" id="modal-1-title">
                Редактировать товар
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <form>
                    <div class="form-group">
                        <label for="full-name">Название</label>
                        <input type="text" id="full-name" name="full-name" placeholder="Введите название товара" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Описание</label>
                        <input type="text" id="desc" name="desc" placeholder="Введите описание товара" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text" id="price" name="price" placeholder="Введите цену товара" required>
                    </div>
                    <div class="form-group">
                        <label for="cout">Количество</label>
                        <input type="text" id="cout" name="cout" placeholder="Введите количество товара" required>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="create">Изменить</button>
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
                Вы уверены, что хотите удалить заказ?
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

        <div class="modal micromodal-slide" id="info-modal" aria-hidden="true">
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
                                <h3>Описание</h3>
                                <div class="order_info">
                                <p>Много работает , любит собирать хлопок под полящим солнцем</p>
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
                                            <td>негр</td>
                                            <td>1488 шт.</td>
                                            <td>1$</td>
                                        </tr>
                                    </table>                              
                        </div>
                    </form>
                </main>
              </div>
            </div>
          </div>

      <script defer src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
      <script defer src="scripts/initClientsModal.js"></script>

</body>
</html>