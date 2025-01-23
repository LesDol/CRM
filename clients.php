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
    <title>CRM | Клиенты</title>
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/clients.css">
    <link rel="stylesheet" href="styles/modules/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/modules/microModal.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <p class="header_admin">Фамилия Имя Отчество</p>
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
                    <label for="search">Поиск по имени</label>
                    <input type="text" id="search" name="search" placeholder="Александр">
                    <select name="sort" id="sort">
                        <option value="0">По возрастанию</option>
                        <option value="1">По убыванию</option>
                    </select>
                </form>
            </div>
        </section>
        <section class="clients">
            <div class="container">
                        <h2 class="clients_title">Список клиентов</h2>
                        <button onclick="MicroModal.show('add-modal')" class="clients_add"><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
                        </button>
                   
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
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>0</td>
                            <td>Манда Ирина Ивановна</td>
                            <td>example@mail.com</td>
                            <td>8-900-35-55-33</td>
                            <td>20.02.2000</td>
                            <td>10.10.2019</td>
                            <td><i class="fa fa-history" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                            <td><i class="fa fa-trash" aria-hidden="true"></i>
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
                Добавить клиента
              </h2>
              <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <form>
                    <div class="form-group">
                        <label for="full-name">ФИО</label>
                        <input type="text" id="full-name" name="full-name" placeholder="Введите ваше ФИО" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Почта</label>
                        <input type="email" id="email" name="email" placeholder="Введите вашу почту" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone" placeholder="Введите ваш телефон" required>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">День рождения</label>
                        <input type="date" id="birthdate" name="birthdate" required>
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
                            <input type="text" id="full-name" name="full-name" placeholder="Введите ваше ФИО" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Почта</label>
                            <input type="email" id="email" name="email" placeholder="Введите вашу почту" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" name="phone" placeholder="Введите ваш телефон" required>
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
       

    <script defer src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script defer src="scripts/initClientsModal.js"></script>
</body>
</html>