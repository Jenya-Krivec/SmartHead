<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Требования к среде проекта

Для использования этого проекта необходимы:

* PHP 8.4
* Composer
* Node
* NPM
* MySQL
* Laravel 12
* Spatie Laravel Permission
* Spatie Media Library
* Laravel Breeze
## Инструкция по установке проекта
Выполните следующие команды в консоли для установки Laravel и всех необходимых зависимостей:
1. `composer create-project --prefer-dist laravel/laravel`
2. `sudo apt update`
3. `sudo apt install nodejs npm -y`
4. `composer require spatie/laravel-permission`
5. `composer require spatie/laravel-medialibrary`
6. `composer require laravel/breeze --dev`
7. `php artisan breeze:install api`
8. `php artisan optimize:clear`
9. `php artisan config:clear`
10. `php artisan storage:link`

Скопируйте файлы проекта с заменой из архива.

Установите БД MySQL и настройте конфигурацию базы данных:

1. `DB_USERNAME = root`
2. `DB_PASSWORD = 6111!Chest`
3. `DB_DATABASE = smarthead_test_widget`

Если MySQL установлен с другими настройками, вам нужно изменить соответствующие поля в файле `.env`.

Чтобы создать таблицы в базе данных та заполнить их данными, запустите миграции и сидеры с помощью команд в консоли:
1. `php artisan migrate`
2. `php artisan db:seed`

## Инструкция по запуску проекта
Чтобы запустить сайт локально, выполните команду в консоли:
1. `php artisan serve`

## Инструкция по использованию проекта
После виполнения команды, вам будет возвращено сообщение с адресом сайта. Откройте его в браузере. Внизу справа будет кнопка, чтобы открыть виджет. 
При первом входе, пользователю будет предложено ввести Имя, Телефон, Email для авторизации в виджете. Также необхлдимо ввести Тему и само Сообщение. 

На сайте уже есть зарегистрированный пользователь. Ви можете ввести его данные для входа в виджет: 
1. `Имя: Customer`
2. `Телефон: +380123456789`
3. `Email: customer@gmail.com`

После ввода данных, и отправки сообщения, в виджете будет отображена предыдущая переписка пользователя с менеджером и ваше сообщение.

Токен для авторизации в виджете храниться в localStorage в переменной `widgetToken`. Если вы хотите сменить пользователя, удалите эту переменную и обновите страницу.

Виджет можно встроить на другие сайты, добавив скрипт:

`<script defer="" type="text/javascript" src="http://localhost:8000/js/widget/widget.js?v=1"></script>`

Файлы, которые загружает пользователь, хранятся в папке `storage/app/public/`.
Пользователь может загружать .png, .jpg, .jpeg, .pdf, .doc, .docx, размером не более 2 МБ.

Возможные ошибки при работе сайта хранятся в файле `storage/logs/laravel.log`.

Для входа в админку перейдите по адресу `http://localhost:8000/login` и введите данные администратора:
1. `Email: admin@gmail.com`
1. `Password: dfv2JV51VF!jnfd`

Вам будут отображены все пользователи, которые авторизовались в виджете. При нажатии на карточку клиента ви перейдете непосредстено к заявкам пользователя. На этой странице можно сменить статус заявки.

## Инструкция по использованию API
Чтобы создать заявку в API, выполните запрос POST на адрес `http://localhost:8000/api/tickets` с телом запроса:
1. `name : string`
2. `phone: string`
3. `email: string`
4. `subject: string`
5. `message: string`
6. `token: string`
7. `isIncoming: boolean`

*`token` для этого запроса можна использовать произвольный (будет создан новый пользователь), или взять с переменной `widgetToken` из localStorage для конкретного пользователя.

Чтобы получить список заявок конкретного пользователя, выполните запрос GET на адрес `http://localhost:8000/api/tickets?token={$token}&created_at=2025-11-23%2000:00:00`

*`$token` пользователя для этого запроса можна взять с переменной `widgetToken` из localStorage.

Чтобы получить заявки за конкретный период, выполните запрос GET на адрес `http://localhost:8000/api/tickets/statistics?period={$period}`

1. `$period = day` - для получения заявок за день
2. `$period = week` - для получения заявок за неделю
1. `$period = month` - для получения заявок за месяц




