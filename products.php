<?php

session_start();

require_once 'modules/AuthCheck.php';

AuthCheck('clients.php');

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
            <p class="header_admin">Фамилия Имя Отчество</p>
            <ul class="header_links"> 
                <li><a href="">Клиенты</a></li>
                <li><a href="">Товары</a></li>
                <li><a href="">Заказы</a></li>
            </ul>
            <a class="header_logout" href="">Выйти</a>
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
                        <h2 class="clients_title">Список товаров</h2>
                        <button onclick="MicroModal.show('add-modal')" class="clients_add"><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
                        </button>
                   
                        <div class="table-wrap">
                        <table>
                    <thead>
                        <th>ИД</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Радактировать</th>
                        <th>Удалить</th>
                        <th>СоздатьQR</th>
                        
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>0</td>
                            <td>НЕГР</td>
                            <td>Много работает , любит собирать хлопок под полящим солнцем</td>
                            <td>2 долара</td>
                            <td>1 штука</td>
                                <td><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true" onclick="MicroModal.show('edit-modal')"></i>
                            </td>
                                <td><i class="fa fa-trash fa-1x" aria-hidden="true" onclick="MicroModal.show('delete-modal')"></i>
                            </td>
                            <td><i class="fa fa-qrcode fa-1x" aria-hidden="true" onclick="MicroModal.show('history-modal')"></i>
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
      <script defer src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
      <script defer src="scripts/initClientsModal.js"></script>
    <!-- 1. Дублировать хедер
    2. Форма для фильтрации . сортировки (
        инпут (поиск по названию) , селект (название , цена , количество ), 
        селект (по убыванию , по возрастанию ))
    3. Кнопка для добавления + таблица товаров
    (ид , название , описание , цена , количество , кнопки , редактировать , удаоить , создать qr)
    4. Модальное окнодля добавления товара
    5. Модальное окно для редактирования товара    -->
</body>
</html>