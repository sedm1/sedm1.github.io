<? header('Content-Type: text/html; charset=utf-8') ?>
<? if($_COOKIE['user_holod'] != 1): ?>
<form action="user.php" method="post">
        <input type="text" placeholder="логин" name="name">
    </form>
<? exit; endif;  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ремонт холодильников в Санкт-Петербурге - "Мастер Холодофф"</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
    <link rel="stylesheet" href="base_setings\base_style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
  <header >
      <div class="block block1">
          <div class="block1200">
            <button onclick="menuBlocker()" class="close_btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
              <div class="menu" id="menu">
                <button onclick="menuBlocker()" class="close_btn_1"><i class="fa fa-times" aria-hidden="true"></i></button>
                  <li>О нас</li>
                  <li>Услуги</li>          <!-- BUG:  Поставить на font-awesome-->
                  <li>Цены</li>
                  <li>Гарантии</li>
                  <li>Отзывы</li>
                  <li>Неисправности</li>
                  <li>Производители</li>    <!-- BUG:  Поставить на font-awesome-->
                  <li>Районы</li>
                  <li>Статьи</li>
                  <li>Контакты</li>

              </div>
          </div>
          <script>
            var menu = document.getElementById('menu')
            function menuBlocker(){
              menu.classList.toggle('blockM')
            }
          </script>
      </div>
    </header>
    <div class="block block2">
        <div class="block2_1">
            <div class="header">
                <div class="logo"><img src="img/logo.png"></div>
                <div class="right_block">
                  <div class="adress">
                      <div class="city"><img src="img/icon_adress.png" alt="" class="header_img"> <div class="p_header"> г. Санкт-Петербург</div></div>
                      <p>Пр. Большевиков 54 кор. 5Б</p>
                  </div>
                  <div class="telefon">
                      <div class="num"><img src="img/icon_phone.png" alt="" class="header_img"><div class="p_header">+7 (960) 252-52-02</div></div>
                      <p class="p_telefon">Пн-Вс: 09:00-21:00</p>
                  </div>
                  <div class="knopka knopka_svetl knopka_first" onmouseover="mouseOver()" onmouseout="mouseout()"><img src="img/icon_phone_min.png" alt="" id="phone_w"><p class="call_text">Заказать звонок</p></div>
                </div>
                <script>
                  var img = document.getElementById("phone_w");
                  function mouseOver(){
                    img.src = 'img/icon_phone_min_w.png'
                  }
                  function mouseout(){
                    img.src = 'img/icon_phone_min.png'
                  }
                </script>
            </div>
        </div>
    </div>
    <section class="bg_section">
      <div class="block block3">
          <div class="block3_1">
              <div class="first">
                  <h1>Ремонт холодильников в Санкт-Петербурге и Ленинградской области</h1>
                  <div class="preim">
                      <div class="preim_min">
                          <div class="preim_img"><img src="img/1/guarantee%201.png" alt=""></div>
                          <div class="preim_min_text">
                            <div class="preim_min_header">Гарантия 1 год</div>
                            <p>Гарантия на работы </br>от 12 месяцев</p>
                          </div>
                      </div>
                      <div class="preim_min">
                          <div class="preim_img"><img src="img/1/clock%201.png" alt=""></div>
                          <div class="preim_min_text">
                            <div class="preim_min_header">Ремонт в удобное время</div>
                            <p>Мастер приедет в удобное </br>для вас время</p>
                          </div>
                      </div>
                      <div class="preim_min">
                          <div class="preim_img"><img src="img/1/refrigerator%201.png" alt=""></div>
                          <div class="preim_min_text">
                            <div class="preim_min_header">Лучшие комплектующие</div>
                            <p>Мы используем только </br>лучшие комплектующие</p>
                          </div>
                      </div>
                      <div class="preim_min">
                          <div class="preim_img"><img src="img/1/discount%201.png" alt=""></div>
                          <div class="preim_min_text">
                            <div class="preim_min_header">Скидки и бонусы</div>
                            <p>Программы бонусов </br>и скидок</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="first_form"> <!-- BUG: img/1/door.png -->
                  <form action="/" method="post">
                      <div class="input"><p class="input_text">Ваше имя</p><input type="text" name="name" id="name" placeholder="Иван"></div>
                      <div class="input"><p class="input_text">Ваш номер телефона</p><input type="text" name="phone" id="phone" placeholder="+7 (978) 777-77-77"></div>
                      <div class="input">
                         <p class="input_text">Тип техники</p>
                          <select name="type" id="type">
                              <option value="holodilnik">Холодильник</option>
                              <option value="stir">Старильная машина</option>
                              <option value="posud">Посудомоечная машина</option>
                              <option value="sushil">Сушильная машина</option>
                          </select>
                      </div>
                      <div class="input"><p class="input_text">Марка</p><input type="text" name="marka" id="marka" placeholder="Bosch"></div>
                      <div class="input" id="input_textarea"><p class="input_text">Ваша проблема</p><textarea name="problem" id="problem" cols="30" rows="10" placeholder="Не запускается"></textarea></div>
                      <div class="input"><p class="input_text">Адрес или ближайшее метро</p><input type="text" name="adress" id="adress" placeholder="Заозерная 1"></div>
                      <button type="button" name="button"><img src="img/1/Mask Group.png" alt="">Вызвать мастера</button>
                      <img src="img/1/door.png" alt="" class="door">
                  </form>
              </div>

          </div>
      </div>

    </section>
    <div class="block block4">
        <div class="block1200">
            <h2>Немного о нас</h2>
            <div class="about">
                <div class="about_min">
                    <img src="img/2/1.png" alt="">
                    <div class="about_text">
                      <div class="about_header">15 000</div>
                      <p>Холодильников восстановили</p>
                    </div>
                </div>
                <div class="about_min">
                    <img src="img/2/2.png" alt="">
                    <div class="about_text">
                      <div class="about_header">15 лет</div>
                      <p>Минимальный опыт мастера</p>
                    </div>
                </div>
                <div class="about_min">
                    <img src="img/2/3.png" alt="">
                    <div class="about_text">
                      <div class="about_header">От 15 минут</div>
                      <p>Прибытие в любой район</p>
                    </div>
                </div>
                <div class="about_min">
                    <img src="img/2/4.png" alt="">
                    <div class="about_text">
                      <div class="about_header">Бесплатно</div>
                      <p>Диагностика при заказе работы</p>
                    </div>
                </div>
                <div class="about_min" id="about_min_t">
                    <img src="img/2/5.png" alt="">
                    <div class="about_text">
                      <div class="about_header">3 из 4</div>
                      <p>Холодильников работают в день обращения</p>
                    </div>
                </div>
                <div class="about_min">
                    <img src="img/2/6.png" alt="">
                    <div class="about_text">
                      <div class="about_header">До 3х лет</div>
                      <p>Официальная гарантия</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="bg_section_2">
      <div class="block block5">
        <div class="block5_1">
            <h2>Цены на услуги</h2>
            <div class="price">
                <div class="first_price">
                  <div class="first_price_title">Диагностика</div>
                  <div class="table">
                    <div class="header_table">
                      <div class="left_block_header">
                        <div class="num_table">№</div>
                        <div class="name_table_header">Наимнование</div>
                      </div>
                      <div class="price_table">Цена (шт.)</div>
                    </div>
                    <div class="block_table">
                      <div class="left_block_header">
                        <div class="num_table">1</div>
                        <div class="name_table">Визуальная диагностика <span style="color: #206BD1; font-size: 9px; margin-top:-15px ">1</span></div>
                      </div>
                      <div class="price_table">500.00р</div>
                    </div>
                    <div class="block_table">
                      <div class="left_block_header">
                        <div class="num_table">2</div>
                        <div class="name_table">Инструментальная диагностика <span style="color: #206BD1; font-size: 9px; margin-top:-15px ">2</span></div>
                      </div>
                      <div class="price_table">660.00р</div>
                    </div>
                  </div>
                  <div class="under_table_text">
                    <div class="under_table_text_1"><span style="color: #206BD1">1:</span> Визуальная диагностика проводится без разбора узлов и агрегатов холодильника. Время визуальной диагностики, как правило, не превышает 10 минут</div>
                    <div class="under_table_text_1"><span style="color: #206BD1">2:</span> Инструментальная диагностика это диагностика требующая разбора узлов и агрегатов холодильника. Инструментальная диагностика с разбором может продолжаться от 30 минут до часа.</div>
                    <div class="pred_table">Плата за диагностику входит в стоимость <a href="#">ремонта холодильника</a></div>
                  </div>
                </div>
                <div class="second_price">
                  <div class="first_price_title">Крупный ремонт</div>
                  <div class="table">
                    <div class="header_table">
                      <div class="left_block_header">
                        <div class="num_table">№</div>
                        <div class="name_table">Работы по замене крупных комплектов холодильника</div>
                      </div>
                      <div class="price_table">Цена (шт.)</div>
                    </div>
                    <div class="block_table">
                      <div class="left_block_header">
                        <div class="num_table">1</div>
                        <div class="name_table">Замена компрессора</div>
                      </div>
                      <div class="price_table">500.00р</div>
                    </div>
                    <div class="block_table">
                      <div class="left_block_header">
                        <div class="num_table">2</div>
                        <div class="name_table">Замена конденсатора</div>
                      </div>
                      <div class="price_table">660.00р</div>
                    </div>
                    <div class="block_table">
                      <div class="left_block_header">
                        <div class="num_table">3</div>
                        <div class="name_table">Замена испарителя</div>
                      </div>
                      <div class="price_table">660.00р</div>
                    </div>
                    <div class="block_table">
                      <div class="left_block_header">
                        <div class="num_table">4</div>
                        <div class="name_table">Замена капиллярной трубки</div>
                      </div>
                      <div class="price_table">660.00р</div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="show_all_price" onmouseover="MouseOver1()" onmouseout="MouseOut1()"><img src="img/3/Group%2010.png" alt="" class="mrg_rght" id="img_s">Показать весь прайс-лист</div>
            <script>
              var img_s = document.getElementById('img_s');
              function MouseOver1(){
                img_s.src = 'img/3/Group_10_w.png'
              }
              function MouseOut1(){
                img_s.src = 'img/3/Group%2010.png'
              }
            </script>
        </div>
      </div>
    </section>
    <div class="block block6">
        <div class="block1200">
            <h2>Наши мастера</h2>
            <div class="masters">
                <div class="masters_min">
                    <img src="img/4/master.png" alt="">
                    <div class="masters_header">Григорий Александрович</div>
                    <p>Стаж: <span style="color: #206BD1">15 лет</span></p>
                    <div class="master_min_hidden">Текст описание краткое, Текст описание краткое,Текст описание краткое,Текст описание краткое</div>
                </div>
                <div class="masters_min">
                    <img src="img/4/master.png" alt="">
                    <div class="masters_header">Григорий Александрович</div>
                    <p>Стаж: <span style="color: #206BD1">15 лет</span></p>
                    <div class="master_min_hidden">Текст описание краткое, Текст описание краткое,Текст описание краткое,Текст описание краткое</div>
                </div>
                <div class="masters_min">
                    <img src="img/4/master.png" alt="">
                    <div class="masters_header">Григорий Александрович</div>
                    <p>Стаж: <span style="color: #206BD1">15 лет</span></p>
                    <div class="master_min_hidden">Текст описание краткое, Текст описание краткое,Текст описание краткое,Текст описание краткое</div>
                </div>
                <div class="masters_min">
                    <img src="img/4/master.png" alt="">
                    <div class="masters_header">Григорий Александрович</div>
                    <p>Стаж: <span style="color: #206BD1">15 лет</span></p>
                    <div class="master_min_hidden">Текст описание краткое, Текст описание краткое,Текст описание краткое,Текст описание краткое</div>
                </div>
            </div>
            <button id="knopka_s" class="knopka knopka_temn">Вызвать мастера</button>
        </div>
    </div>
    <section class="bg_section_3">
      <div class="block block7">
        <div class="block7_1">
            <div class="s_cont">
                <div class="title_s_count">Мастер Холодофф</div>
                <div class="s_text">
                    <p>Мастер Холодофф - это мой бренд частного мастера по ремонту холодильников и холодильного оборудования.</p>
                    <p>Я ремонтирую холодильники в Санкт-Петербурге (СПБ) во всех районах: Невский, Красносельский, Красногвардейский, Выборгский, Приморский, Калининский, Центральный, Фрунзенский, Московский, Петроградский, Василеостровский, Адмиралтейский, пригородах и Ленинградской области.</p>
                </div>
                <div class="s_text s_text_all" style="display: none">Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Рыбного семантика буквоград от всех рот сбить которое, запятой, несколько диких. Своего языком они, напоивший над сбить бросил себя свой своего это, курсивных эта прямо залетают гор дорогу парадигматическая подпоясал на берегу путь. Составитель рукописи коварный своего собрал, все ему. Дороге ее предложения первую напоивший буквенных грустный пояс запятой моей имени повстречался раз, по всей, строчка они текст единственное правилами что толку языком необходимыми. Повстречался, ему гор речью щеке ты там бросил путь, текста последний имени. Правилами вопроса предупредила буквоград путь если которой, всемогущая подпоясал подзаголовок снова силуэт большого пустился вопрос запятой безорфографичный ручеек свой деревни, гор предложения путь. Но агенство если напоивший оксмокс обеспечивает даль рот, снова предупредила, деревни речью, взобравшись вопроса.</div>
                <button class="show_all_text">Подробнее</button>
            </div>
            <div class="s_img"><img src="img/5/master.png" alt=""></div>
        </div>
      </div>
    </section>
    <div class="block block8">
        <div class="block8_1">
            <h2>Как мы работаем</h2>
            <div class="job">
                <div class="job_min">
                    <img src="img/6/1.png" alt="">
                    <div class="job_title">Получаем заявку</div>
                    <p><img src="img/6/history_forward_outline_28.png">5 минут</p>
                </div>
                <div class="job_min">
                    <img src="img/6/2.png" alt="">
                    <div class="job_title">Телефонная консультация </br>с мастером</div>
                    <p><img src="img/6/history_forward_outline_28.png">5 минут</p>
                </div>
                <div class="job_min">
                    <img src="img/6/3.png" alt="">
                    <div class="job_title">Диагностика</div>
                    <p><img src="img/6/history_forward_outline_28.png">15 минут</p>
                </div>
                <div class="job_min">
                    <img src="img/6/4.png" alt="">
                    <div class="job_title">Ремонт и гарантия</div>
                    <p><img src="img/6/history_forward_outline_28.png">от 10 минут</p>
                </div>
            </div>
            <button class="knopka knopka_temn">Вызвать мастера</button>
        </div>
    </div>
    <section class="bg_section_4">


      <div class="block block9">
        <div class="block9_1">
            <h2>Обслуживанием станции метро</h2>
            <div class="metro">
              <div class="f_col">
                <div class="first_column">
                  <div class="metro_min">Автово</div>
                  <div class="metro_min">Адмиралтейская 1</div>
                  <div class="metro_min">Академическая</div>
                  <div class="metro_min">Балтийская</div>
                  <div class="metro_min">Бухарестская</div>
                  <div class="metro_min">Василеостровская</div>
                  <div class="metro_min">Владимирская</div>
                  <div class="metro_min">Волковская</div>
                  <div class="metro_min">Выборгская</div>
                  <div class="metro_min">Горьковская</div>
                  <div class="metro_min">Гостиный двор </div>
                  <div class="metro_min">Гражданский проспект</div>
                  <div class="metro_min">Девяткино</div>
                  <div class="metro_min">Достоевская</div>
                  <div class="metro_min">Елизаровская</div>
                </div>
                <div class="second_column">
                  <div class="metro_min">Звенигородская</div>
                  <div class="metro_min">Кировский завод</div>
                  <div class="metro_min">Комендантский проспект</div>
                  <div class="metro_min">Крестовский остров</div>
                  <div class="metro_min">Купчино</div>
                  <div class="metro_min">Ладожская</div>
                  <div class="metro_min">Ленинский проспект</div>
                  <div class="metro_min">Лиговский проспект</div>
                  <div class="metro_min">Ломоносовская</div>
                  <div class="metro_min">Маяковская</div>
                  <div class="metro_min">Международная</div>
                  <div class="metro_min">Московская</div>
                  <div class="metro_min">Московские ворота</div>
                  <div class="metro_min">Нарвская</div>
                  <div class="metro_min">Невский проспект</div>
                  <div class="metro_min">Новочеркасская</div>
                </div>
              </div>
              <div class="sec_col">
                <div class="third_column">
                  <div class="metro_min">Обводный канал</div>
                  <div class="metro_min">Обухово</div>
                  <div class="metro_min">Озерки</div>
                  <div class="metro_min">Парк Победы</div>
                  <div class="metro_min">Парнас</div>
                  <div class="metro_min">Петроградская</div>
                  <div class="metro_min">Пионерская</div>
                  <div class="metro_min">Площадь Александра Невского</div>
                  <div class="metro_min">Площадь Восстания</div>
                  <div class="metro_min">Площадь Ленина</div>
                  <div class="metro_min">Площадь Мужества</div>
                  <div class="metro_min">Политехническая Приморская</div>
                  <div class="metro_min">Пролетарская</div>
                  <div class="metro_min">Проспект Большевиков</div>
                  <div class="metro_min">Проспект Ветеранов</div>
                </div>
                <div class="fird_column">
                  <div class="metro_min">Проспект Просвещения</div>
                  <div class="metro_min">Пушкинская</div>
                  <div class="metro_min">Рыбацкое</div>
                  <div class="metro_min">Садовая</div>
                  <div class="metro_min">Сенная площадь</div>
                  <div class="metro_min">Спасская Спортивная</div>
                  <div class="metro_min">Старая Деревня</div>
                  <div class="metro_min">Технологический институт 1, 2</div>
                  <div class="metro_min">Удельная</div>
                  <div class="metro_min">Улица Дыбенко</div>
                  <div class="metro_min">Фрунзенская</div>
                  <div class="metro_min">Чёрная речка</div>
                  <div class="metro_min">Чернышевская</div>
                  <div class="metro_min">Чкаловская</div>
                  <div class="metro_min">Электросила</div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
    <div class="block block10">
        <div class="block1200">
            <h2>Районы Петербурга</h2>
            <div class="districs">
                <div class="districs_list">
                    <div class="distr1">
                        <p><strong>Филиалы:</strong></p>
                        <ul class="nav_map">
                          <div class="first_col">
                            <li><a href="/kolpino">Колпино</a></li>
                            <li><a href="/pushkin">Пушкин</a></li>
                            <li><a href="/vsevolozhsk">Всеволожск</a></li>
                            <li><a href="/volosovo">Волосово</a></li>
                            <li><a href="/sestroretsk">Сестрорецк</a></li>
                            <li><a href="/zelenogorsk">Зеленогорск</a></li>
                            <li><a href="/peterhof">Петергоф</a></li>
                          </div>
                          <div class="second_col">
                            <li><a href="/gatchina">Гатчина</a></li>
                            <li><a href="/lomonosov">Ломоносов</a></li>
                            <li><a href="/krasnoe-selo">Красное Село</a></li>
                            <li><a href="/kronshtadt">Кронштадт</a></li>
                            <li><a href="/luga">Луга</a></li>
                            <li><a href="/pavlovsk">Павловск</a></li>
                          </div>
                        </ul>
                    </div>
                    <div class="distr2">
                        <p><strong>Районы:</strong></p>
                        <ul class="nav_map">
                          <div class="first_col">
                            <li><a href="/admiraltejskij-rayon">Адмиралтейский</a></li>
                            <li><a href="/vasileostrovsky-rajon">Василеостровский</a></li>
                            <li><a href="/vyborgskij-rayon">Выборгский</a></li>
                            <li><a href="/kalininskij-rayon">Калининский</a></li>
                            <li><a href="/kirovski">Кировский</a></li>
                            <li><a href="/kupchino">Купчино</a></li>
                            <li><a href="/krasnogvardejsky-rajon">Красногвардейский</a></li>
                            <li><a href="/krasnoselski">Красносельский</a></li>
                            <li><a href="/kurortnyj-rajon">Курортный</a></li>
                          </div>
                          <div class="second_col">
                            <li><a href="/moskovsky-rajon">Московский</a></li>
                            <li><a href="/nevskij-rajon">Невский</a></li>
                            <li><a href="/petrogradskij-rayon">Петроградский</a></li>
                            <li><a href="#">Петродворцовый</a></li>
                            <li><a href="/primorskiy-rayon">Приморский</a></li>
                            <li><a href="/frunzenskiy-rayon">Фрунзенский</a></li>
                            <li><a href="/centralnyj-rayon">Центральный</a></li>
                          </div>
                        </ul>
                    </div>
                  </div>
                  <div>
                    <img src="img/cart.png" alt="" class="map_districts">
                  </div>
                </div>
            </div>
          </div>
    <section class="bg_section_5">
      <div class="block block11">
        <div class="block11_1">
            <div class="img_error"><img src="img/7/err_holodil.png" alt=""></div>
            <div class="errors">
                <h2>Основные неисправности</h2>
                <div class="errors_list">
                    <div class="err_min">
                        <img src="img/7/1.png" alt="">
                        <p>Течет</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/2.png" alt="">
                        <p>Утечка фриона</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/3.png" alt="">
                        <p>Сильно шумит</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/4.png" alt="">
                        <p>Перемораживает</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/5.png" alt="">
                        <p>Щелкает</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/6.png" alt="">
                        <p>Не включается</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/7.png" alt="">
                        <p>Нет света</p>
                    </div>
                    <div class="err_min">
                        <img src="img/7/8.png" alt="">
                        <p>Не морозит</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    <div class="block block12">
        <div class="block1200">
            <h2>Наши работы</h2>
            <div class="portfolio">
                <div class="portfolio_min">
                    <img src="img/8/Image.png" alt="" class="port_img">
                    <div class="port_text">
                      <div class="potr_title">Ремонт бытовых холодильников </div>
                      <p class="beko">Ремонт холодильника BEKO CMV533103S</p>
                      <p class="rent">Ремонтируем холодильник BEKO с утечкой в запененной части</p>
                      <div class="round_block">
                        <button><div class="round_left round"><i class="fa fa-angle-left" aria-hidden="true"></i></div></button>
                        <button><div class="round_right round"><i class="fa fa-angle-right" aria-hidden="true"></i></div></button>
                      </div>
                    </div>
                </div>
            </div>
            <div class="buton_f">
              <div class="knopka knopka_temn_1">Вызвать мастера</div>
              <div class="show_all_portfolio knopka_first"><img src="img/3/Group%2010.png" alt=""><a href="#" class="call_text">Показать все работы</a></div>
            </div>

        </div>
    </div>
    <section class="block13">
      <div class="block">
        <div class="block1200">
            <h2>Отзывы заказчиков</h2>
            <div class="reviews">
                <div class="reviews_min">
                  <div class="img_block"><img src="img/face.jpg" alt=""></div>
                  <div class="text_block">
                    <div class="reviews_title">Ремонт холодильника Атлант</div>
                    <div class="review_author">Александра Иванова</div>
                    <p>Спасибо Дмитрию! Все отлично, приехал вовремя, приятный мастер, сделал быстро, дешевле почти на треть, чем другие. </br></br> Отзыв размещен на <a href="">Авито</a></p>
                  </div>
                </div>
                <div class="reviews_min"id="hidden">
                  <div class="img_block"><img src="img/face.jpg" alt=""></div>
                  <div class="text_block">
                    <div class="reviews_title">Ремонт холодильника Атлант</div>
                    <div class="review_author">Александра Иванова</div>
                    <p>Спасибо Дмитрию! Все отлично, приехал вовремя, приятный мастер, сделал быстро, дешевле почти на треть, чем другие.</br></br> Отзыв размещен на <a href="">Авито</a></p>
                  </div>
                </div>

            </div>
            <button><div class="round_left_1 round"><i class="fa fa-angle-left" aria-hidden="true"></i></div></button>
            <button><div class="round_right_1 round"><i class="fa fa-angle-right" aria-hidden="true"></i></div></button>
        </div>
      </div>
    </section>
    <div class="block block14">
        <div class="block1200">
            <h2>Работаем со всеми брендами</h2>
            <div class="brends">
                <div class="brend_min"><img src="img/9/33726131b9b81274dffa38b8383b4654.png" alt=""></div>
                <div class="brend_min"><img src="img/9/aa4f70b9ba4fdac1afb7f35ab9d9b976.jpg" alt=""></div>
                <div class="brend_min"><img src="img/9/b1c3baddcaa5371a78136c79f9b5b760.jpg" alt=""></div>
                <div class="brend_min"><img src="img/9/db845943c744849e39a9e44d61f22a91.jpg" alt=""></div>
                <div class="brend_min"><img src="img/9/ec80bd34e91f4d3536fc05d619c20e21.jpg" alt=""></div>
            </div>
        </div>
    </div>
    <section class="bg_section_15">
      <div class="block block15">
        <div class="block15_1">
            <div class="questions">
                <h3>Остались вопросы?</h3></br>
                <h3 class="blue">Задайте их нам!</h3>
                <p>Заполните форму, и нажмите кнопку отправить! Мы вам перезвоним в ближайшее время!</p>
            </div>
            <div class="questions_form">
                <form action="/" method="post">
                    <div class="input">
                        <p>Ваше имя</p>
                        <input type="text" name="q_name" id="q_name" placeholder="Иван">
                    </div>
                    <div class="input">
                        <p>Ваш E-mail</p>
                        <input type="text" name="q_mail" id="q_mail" placeholder="mail@yandex.ru">
                    </div>
                    <div class="input">
                        <p>Ваш номер телефона</p>
                        <input type="text" placeholder="+7 (978) 777-77-77" name="q_telefon" id="q_telefon">
                    </div>
                    <button class="knopka_form_q knopka_temn">Отправить</button>
                </form>
            </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="block block16">
        <div class="block1200">
            <div class="footer">
              <div class="footer_min_block">
                <div class="footer_min">
                    <b>Компания</b>
                    <a href="#">О компании</a>
                    <a href="#">Отзывы</a>
                    <a href="#">Реквизиты</a>
                </div>
                <div class="footer_min">
                    <b>Цены</b>
                    <a href="#">Диагностика</a>
                    <a href="#">Мелкий ремонт</a>
                    <a href="#">Крупный ремонт</a>
                    <a href="#">Выезды в Лен. Область</a>
                    <a href="#">Скидки и бонусы</a>
                </div>
                <div class="footer_min">
                    <b>Услуги</b>
                    <a href="#">Ремонт холодильников</a>
                    <a href="#">Ремонт стиральных машин</a>
                    <a href="#">Ремонт сушильных машин</a>
                    <a href="#">Ремонт посудомоечных машин</a>
                </div>
                <div class="footer_min">
                    <b>Информация</b>
                    <a href="#">Марки</a>
                    <a href="#">Новости</a>
                    <a href="#">Полезно знать</a>
                </div>
                <div class="footer_min footer_contact">
                    <b>Контакты</b>
                    <div class="footer_contact_min">
                       <div class="footer_contact_min1">
                           <img src="img/10/phone.png" alt="">
                           <div class="p">
                             <p class="p_first">+7 (978) 777-77-77</p>
                             <p class="sec_p">Пн-Вс: 09:00-21:00</p>
                           </div>
                       </div>
                    </div>
                    <div class="footer_contact_min">
                       <div class="footer_contact_min1">
                           <img src="img/10/adress.png" alt="">
                           <div class="p">
                             <p class="p_first">г. Санкт-Петербург</p>
                             <p class="sec_p">Пр. Большевиков 54 кор. 5Б</p>
                           </div>
                       </div>
                    </div>
                    <div class="footer_contact_min">
                       <div class="footer_contact_min1">
                            <img src="img/10/mail.png" alt="">
                            <div class="p"><p class="p_first">master.holodoff@gmail.com</p></div>
                       </div>
                    </div>
                  </div>
                </div>
                <div class="soc">
                    <div class="row"></div>
                    <div class="soc_min">
                        <div class="soc_icon"><img src="img/11/vk.png" alt=""></div>
                        <div class="soc_icon"><img src="img/11/facebook.png" alt=""></div>
                        <div class="soc_icon"><img src="img/11/youtube.png" alt=""></div>
                    </div>
                    <div class="row"></div>
                </div>
                <div class="prava">2020 Все права защищены</div>
            </div>
        </div>
      </div>
    </footer>
</body>
</html>
