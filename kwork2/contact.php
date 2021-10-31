<?php
/*
Template Name: Contact
*/
?>
<?php
get_header();
?>
    <section class="bg__section">
        <div class="container">
            <div class="link"><a href="index.php">Главная страница >> </a> Контакты</div>
            <h1 class="section__title">Контакты</h1>
            <div class="form">
                <form action="send.php">
                    <input type="text" placeholder="Ваше имя">
                    <input type="text" placeholder="Ваш номер телефона">
                    <input type="text" placeholder="Модель устройства">
                    <textarea placeholder="Что случилось с вашим устройством?"></textarea>
                    <button>Отравить</button>
                </form>
                <div class="form__info">
                    <div class="form__item">
                        <div class="form__icon"><img src="" alt=""></div>
                        <div class="form__text">
                            <div class="form__title">Контактныe телефоны:</div>
                            <a class="form__describe call">(097) 434-91-84</a>
                            <a class="form__describe call">(097) 434-91-84</a>
                            <a class="form__describe call">(097) 434-91-84</a>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__icon"><img src="" alt=""></div>
                        <div class="form__text">
                            <div class="form__title">Адрес офиса:</div>
                            <a class="form__describe">г. Киев, ул. Ломоносова, 50/2</a>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__icon"><img src="" alt=""></div>
                        <div class="form__text">
                            <div class="form__title"> Время работы:</div>
                            <a class="form__describe">Пн.-Пт.: 10:00 — 19:00</a>
                            <a class="form__describe">Сб.: 10:00 — 17:00, Вс.: Выходной</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
?>
    