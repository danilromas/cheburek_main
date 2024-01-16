let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}

let cartItem = document.querySelector('.cart-items-container');
document.querySelector('#cart-btn').onclick = () => {
    cartItem.classList.toggle('active');
}

let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    cartItem.classList.remove('active');
}


window.onscroll = () => {
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}




const editButtons = document.querySelectorAll('.edit-btn');

editButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const modal = document.getElementById('openModal');
        const itemId = button.closest('.box').getAttribute('data-item-id');

        // Отправляем AJAX-запрос на сервер для получения данных о товаре по его ID
        fetch(`config/get_item_data.php?itemId=${itemId}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    console.error(data.error);
                } else {
                    // Заполняем форму данными о товаре из ответа сервера
                    document.getElementById('itemId').value = itemId;
                    document.getElementById('itemName').value = data.item_name;
                    document.getElementById('itemPrice').value = data.price;
                    const itemImage = document.getElementById('itemImage');

                    if (data.image_url) {
                        itemImage.src = data.image_url;
                    } else {
                        itemImage.src = ''; // Если изображения нет, очищаем src
                    }

                    // Открываем модальное окно
                    modal.style.display = 'block';

                    const categorySelect = document.getElementById('categorySelect');
                    categorySelect.value = data.categoryId;
                }
            })
            .catch((error) => {
                console.error(error);
            });
    });
});

// Обработчик изменения файла изображения
const itemImageInput = document.getElementById('itemImageInput');
itemImageInput.addEventListener('change', (e) => {
    const itemImage = document.getElementById('itemImage');
    const file = e.target.files[0];

    if (file) {
        const imageUrl = URL.createObjectURL(file);
        itemImage.src = imageUrl;

    } else {
        itemImage.src = '';
    }
});

// Код для отправки данных на сервер при сохранении изменений
const editSubmitButton = document.getElementById('editSubmit');
editSubmitButton.addEventListener('click', () => {
    const itemId = document.getElementById('itemId').value;
    const itemName = document.getElementById('itemName').value;
    const itemPrice = document.getElementById('itemPrice').value;



    const selectedCategoryId = categorySelect.value;
    const itemImageFile = itemImageInput.files[0]; // Получаем выбранный файл изображения

    const categoryError = document.getElementById('categoryError'); // Элемент для отображения ошибки

    // Проверяем, выбрана ли категория
    if (!selectedCategoryId) {
        categoryError.textContent = 'Пожалуйста, выберите категорию.'; // Отображаем ошибку
        return; // Останавливаем отправку формы
    }

    // Очищаем ошибку, если категория выбрана
    categoryError.textContent = '';

    // Создаем объект FormData для отправки данных на сервер
    const formData = new FormData();
    formData.append('itemId', itemId);
    formData.append('itemName', itemName);
    formData.append('itemPrice', itemPrice);
    formData.append('categoryId', selectedCategoryId);

    // Добавляем файл изображения в FormData, если он выбран
    if (itemImageFile) {
        formData.append('itemImage', itemImageFile);
    }

    // Отправляем данные на сервер
    fetch('/config/update.php', {
        method: 'POST',
        body: formData
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Закрываем модальное окно после успешного обновления
                const modal = document.getElementById('openModal');
                modal.style.display = 'none';

                // Обновляем информацию о товаре на странице
                const itemBox = document.querySelector(`.box[data-item-id="${itemId}"]`);
                const itemNameElement = itemBox.querySelector('h3');
                const itemPriceElement = itemBox.querySelector('.price');

                itemNameElement.textContent = itemName;
                itemPriceElement.textContent = itemPrice + '₽';
            } else {
                console.error(data.error);
            }
        })
        .catch((error) => {
            console.error(error);
        });
});

// Код для закрытия модального окна при нажатии на "X"
const closeModalButton = document.getElementById('closeModal');

// Добавляем обработчик событий для кнопки закрытия модального окна
closeModalButton.addEventListener('click', function (event) {
    event.preventDefault(); // Предотвращаем стандартное действие ссылки
    const modal = document.getElementById('openModal');
    modal.style.display = 'none';
});



const categorySelect = document.getElementById('categorySelect');

// Добавляем обработчик события для выбора категории
categorySelect.addEventListener('change', (event) => {
    // Получаем выбранное значение
    const selectedCategoryId = event.target.value;

    // Вы можете использовать выбранное значение (selectedCategoryId) в своем коде для дальнейшей обработки
    console.log('Выбранная категория:', selectedCategoryId);
});


document.addEventListener('DOMContentLoaded', function () {
    // Получите itemId из вашей HTML-разметки
    const itemId = document.getElementById('itemId').value;
    // Выполните AJAX-запрос после получения itemId
    fetch('/config/categories.php')
        .then((response) => response.json())
        .then((data) => {
            if (Array.isArray(data)) {
                const categoryIdSelect = document.getElementById('categorySelect');

                // Очистите существующие опции (если они есть)
                categoryIdSelect.innerHTML = '';

                // Добавьте новые опции на основе полученных данных
                data.forEach((category) => {
                    const option = document.createElement('option');
                    option.value = category.id; // Установите значение опции
                    option.textContent = category.name; // Установите текст опции
                    categoryIdSelect.appendChild(option); // Добавьте опцию в выпадающий список

                    // Если ID категории совпадает с ID категории товара, установите эту опцию как выбранную
                    if (category.id === itemId) {
                        option.selected = true;
                    }
                });
            } else {
                console.error('Ошибка: Данные не являются массивом.', data);
            }
        })
        .catch((error) => {
            console.error('Произошла ошибка при получении данных:', error);
        });
});

function filterItems(category) {
    const boxes = document.querySelectorAll('.box');

    boxes.forEach((box) => {
        const itemCategory = box.getAttribute('data-category');

        if (category === 'all' || category === itemCategory) {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    });
}

// Обработка кликов по кнопкам категорий
const categoryButtons = document.querySelectorAll('.sorting-btn');

categoryButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        const category = e.target.getAttribute('data-category');
        filterItems(category);
    });
});

// Обработка клика по кнопке "Все"
const allButton = document.querySelector('.sorting-btn[data-category="all"]');

allButton.addEventListener('click', () => {
    filterItems('all');
});

// Функция для обновления количества в корзине
function updateCartCount() {
    $.ajax({
        url: '../config/get_cart_count.php', // Путь к серверному скрипту, который вернет количество товаров в корзине
        type: 'GET',
        success: function (data) {
            // Обновляем элемент с количеством
            $('#cart-count').text(data);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

$(document).ready(function () {
    $(".buy-btn").click(function (e) {
        e.preventDefault();
        var item_id = $(this).data("item-id");
        var quantity = 1; // Вы можете задать желаемое количество товара
        $.ajax({
            type: "POST",
            url: "../config/add_to_cart.php",
            data: { item_id: item_id, quantity: quantity },
            success: function (response) {
                // Обработка успешного добавления товара
                updateCartCount();
                alert(response); // Вывод сообщения пользователю
            },
        });
    });
});





document.addEventListener('DOMContentLoaded', function () {
    const cartItemsList = document.querySelector('#cart-items-list');

    // Функция для удаления товара из корзины
    function removeFromCart(uniqueId) {
        fetch(`../config/remove_from_cart.php?uniqueId=${uniqueId}`)
            .then(response => response.json())
            .then(data => {
                // Выводим в консоль сообщение для отладки
                console.log(data.message);
                console.log(uniqueId);

                // После успешного удаления, обновляем корзину
                fetchCartItems();
            });
    }
    // Создание стиля
    const styles = `

    .item-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .item-info {
        display: flex;
        align-items: center;
    }

    .item-image {
        max-width: 100px;
        height: auto;
        margin-right: 10px;
        border-radius: 5px;
    }

    .item-title {
        margin: 0;
        font-size: 18px;
    }

    .item-price {
        margin: 0;
        font-size: 16px;
        color: #888;
    }

    .remove-item-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .remove-item-btn:hover {
        background-color: #c82333;
    }
`;

// Создаем элемент style и добавляем стили в него
const styleElement = document.createElement('style');
styleElement.textContent = styles;



    // Функция для отображения корзины
    function renderCart(data) {
        document.head.appendChild(styleElement);
        
        cartItemsList.innerHTML = '';  // Очищаем список

        if (data.length > 0) {
            data.forEach(item => {
                // Создаем HTML-элемент карточки для каждого товара
                const itemCard = document.createElement('div');
                itemCard.className = 'item-card';   // Используем класс для стилизации карточки
                // Добавляем созданный элемент style в тег head документа

                // Внутри карточки сгенерируем HTML с изображением товара
                const innerHtml = `
                    <div class="item-info">
                    
                        <img class="item-image" src="${item.image_url}" alt="${item.item_name}">
                        <h2 class="item-title">${item.item_name}</h2>
                        <h2 class="item-price">${item.price}₽</h2>
                    </div>`;

                    

                itemCard.innerHTML = innerHtml;

                // Создаем кнопку "Удалить" и добавляем атрибут data-product-id
                const removeButton = document.createElement('button');
                removeButton.className = 'remove-item-btn';
                removeButton.textContent = 'X';

                // Устанавливаем data-product-id равным идентификатору товара
                removeButton.setAttribute('data-product-id', item.item_id);

                removeButton.addEventListener('click', function () {
                    // Извлекаем id из data-product-id атрибута кнопки
                    const itemId = removeButton.getAttribute('data-product-id');
                    removeFromCart(item.unique_id);
                });

                itemCard.appendChild(removeButton);
                cartItemsList.appendChild(itemCard);
            });
        } else {
            // Если корзина пуста, отобразите сообщение
            const emptyCartMessage = document.createElement('p');
            emptyCartMessage.textContent = 'Корзина пуста';
            cartItemsList.appendChild(emptyCartMessage);
        }
    }

    // Функция для получения данных о товарах в корзине
    function fetchCartItems() {
        fetch('../config/get_cart_items.php')
            .then(response => response.json())
            .then(data => {
                // Отображаем полученные данные
                renderCart(data);
                console.log(data);
            });
    }

    // Обработчик события для открытия модального окна корзины
    document.querySelector('#show-cart-btn').addEventListener('click', function () {
        // Получаем и отображаем товары в корзине
        fetchCartItems();
        // Открываем модальное окно
        document.querySelector('#cart-modal').style.display = 'block';
    });

    // Обработчик события для закрытия модального окна корзины
    document.querySelector('#close-cart-btn').addEventListener('click', function () {
        // Закрываем модальное окно
        document.querySelector('#cart-modal').style.display = 'none';
    });

    // Используем делегирование событий для кнопки "удалить"
    // cartItemsList.addEventListener('click', function (event) {
    //     if (event.target.classList.contains('remove-item-btn')) {
    //         // Получаем имя товара из элемента карточки
    //         const itemName = event.target.closest('.item-card').querySelector('.item-title').textContent;
    //         // Извлекаем id из data-product-id атрибута кнопки
    //         const itemId = event.target.getAttribute('data-product-id');
    //         removeFromCart(itemName, itemId);
    //     }
    // });
});


