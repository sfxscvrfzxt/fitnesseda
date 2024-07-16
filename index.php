<!--###################################################################---PHP: Серверная логика---##################################################################-->
<?php
$dbPath = 'fitnesseda_DB.sqlite';

try {
    $db = new SQLite3($dbPath);
    echo "<script>console.log('База данных успешно подключена');</script>";
} catch (Exception $e) {
    echo "<script>console.log('Ошибка подключения базы данных: " . $e->getMessage() . "');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Еда</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap">
    <!--###############################################################---CSS: Стилизация страницы---###############################################################-->
    <style>
        /*global---####################################################*/
        *{
            font-family: 'Ubuntu', sans-serif;
        }
        body{
            padding: 0;
            margin: 0;
            background-image: url('image/body_back.png');
            background-size: cover;
            display: flex;
            justify-content: center;
            min-height: 0;
            min-width: 0;
        }
        div{
            left: 0;
        }
        h1{
            display: flex;
            justify-content: center;
            margin: 0px;
        }
        /*text---######################################################*/
        p{
            display: flex;
            align-items: center;
            font-size: 20px;
            margin: 5px;
        }
        .greenspan{
            margin-left: 10px; 
            margin-right: 10px;
            color: #78cc52;
            font-size: 50px;

            font-weight: bold;
        }
        .p-fat{
            font-weight: bold;
            font-size: 35px;
        }
        /*butotns---###################################################*/
        button{
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon_btn{
            width: 40px;
            height: 40px;
            background: #78cc52;
        }
        .icon_btn.active{
            background: #4d932d;
        }
        .home-btn{
            background: #4d932d;
        }
        .home-btn.disabled{
            background: #78cc52;
        }
        /*dfdfd---#####################################################*/
        .logo-cont{
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .cont{
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .navbar-cont{
            position: fixed;
            margin: 0;
            bottom: 20;
            display: flex;
            justify-content: center;
            width: 100%;
            height: 10%;
        }
        .navbar{
            background: #78cc52;
            width: 88%;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }
        /*-----*/
        .page-cart-cont{
            display: flex;
        }
        /*pages*/
        .page-home{
            display: block;
        }
        .page-home.disabled{
            display: none;
            pointer-events: none;
        }
        .page-cart{
            display: none;
            pointer-events: none;
        }
        .page-cart.active{
            display: block;
            pointer-events: inherit;
        }
    </style>
</head>
<body>
    <!--###############################################################---HTML: Структура страницы---###############################################################-->
    <div>
        <div id="home-page" class="page-home">
            <div class="logo-cont">
                <img src="image/logo.png">
            </div>
        <div>
            <h1 style="margin: 20px 0 0 0;">здоровое питание</h1>
            <p class="cont">с доставкой на дом</p>
            <p class="cont" style="margin-top: 40%;">от<span class="greenspan">690 РУБ</span>в день</p>
            <p class="cont">в ростове-на-дону</p>
        </div>
    </div>
        <div class="navbar-cont">
            <div class="navbar">
                <button id="home" class="icon_btn home-btn"><img src="image/home.png"></button>
                <button id="cart" class="icon_btn"><img src="image/cart.png"></button>
                <button id="quest" class="icon_btn"><img src="image/quest.png"></button>
                <button id="phone" class="icon_btn"><img src="image/phone.png"></button>
            </div>
        </div>

        <div id="cart-page" class="page-cart">
            <div>
                <h1 class="greenspan">выберите</h1>
                <h1 class="greenspan">программу</h1>
                <div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <div id="quest-page" class="page-cart">
            ответы и вопросы
        </div>

        <div id="phone-page" class="page-cart">
            перезвонить мне
        </div>
    </div>
    <!--###############################################################---JavaScript: Интерактивность страницы---###################################################-->
    <script>
        const home_btn = document.getElementById('home');
        const cart_btn = document.getElementById('cart');
        const quest_btn = document.getElementById('quest');
        const phone_btn = document.getElementById('phone');

        const home_div = document.getElementById('home-page');
        const cart_div = document.getElementById('cart-page');
        const quest_div = document.getElementById('quest-page');
        const phone_div = document.getElementById('phone-page');

        if (home_btn && cart_div && home_div && quest_div && phone_div) {
            home_btn.addEventListener('click', function() {
                home_btn.classList.remove('disabled');
                cart_btn.classList.remove('active');
                quest_btn.classList.remove('active');
                phone_btn.classList.remove('active');
                home_div.classList.remove('disabled');
                cart_div.classList.remove('active');
                quest_div.classList.remove('active');
                phone_div.classList.remove('active');
            });
        }

        if (cart_btn && cart_div && home_div && quest_div && phone_div) {
            cart_btn.addEventListener('click', function() {
                home_btn.classList.add('disabled');
                cart_btn.classList.add('active');
                quest_btn.classList.remove('active');
                phone_btn.classList.remove('active');
                home_div.classList.add('disabled');
                cart_div.classList.add('active');
                quest_div.classList.remove('active');
                phone_div.classList.remove('active');
            });
        }

        if (quest_btn && cart_div && home_div && quest_div && phone_div) {
            quest_btn.addEventListener('click', function() {
                home_btn.classList.add('disabled');
                cart_btn.classList.remove('active');
                quest_btn.classList.add('active');
                phone_btn.classList.remove('active');
                home_div.classList.add('disabled');
                cart_div.classList.remove('active');
                quest_div.classList.add('active');
                phone_div.classList.remove('active');
            });
        }

        if (phone_btn && cart_div && home_div && quest_div && phone_div) {
            phone_btn.addEventListener('click', function() {
                home_btn.classList.add('disabled');
                cart_btn.classList.remove('active');
                quest_btn.classList.remove('active');
                phone_btn.classList.add('active');
                home_div.classList.add('disabled');
                cart_div.classList.remove('active');
                quest_div.classList.remove('active');
                phone_div.classList.add('active');
            });
        }



    </script>
</body>
</html>