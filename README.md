# og-soft
Check date, count end of the task


Testovací kontrolér GeneralOneControllerTest
Tento testovací kontrolér obsahuje několik jednotkových testů pro ověření funkcionality API poskytovaného kontrolérem GeneralOneController.

Instalace a spuštění
Ujistěte se, že máte nainstalovaný PHP a Composer.
Naklonujte si repozitář nebo zkopírujte kód testovacího kontroléru.
Nainstalujte závislosti spuštěním příkazu composer install.
Spusťte testy pomocí příkazu php artisan test.
Obsah
test_CheckApiRoute(): Ověřuje routu /api/check-api a zajišťuje, že vrací HTTP stavový kód 200.
test_DateFilterWithWeekend(): Ověřuje filtrace datumu se víkendem a zajišťuje, že zpráva obsahuje informace o víkendu.
test_DateFilterWithWorkDay(): Ověřuje filtrace datumu s pracovním dnem a zajišťuje, že zpráva obsahuje informace o pracovním dni.
test_DateFilterWithHoliday(): Ověřuje filtrace datumu s svátkem a zajišťuje, že zpráva obsahuje informace o svátku.
Spuštění
Můžete spustit tento testovací kontrolér pomocí PHPUnit nebo příkazu php artisan test. Ujistěte se, že vaše aplikace je nakonfigurována a připravena k testování.


# Тестовый контроллер GeneralOneControllerTest

Этот тестовый контроллер содержит несколько юнит-тестов для проверки функциональности API, предоставляемого контроллером `GeneralOneController`.

## Установка и запуск

1. Убедитесь, что у вас установлен PHP и Composer.
2. Клонируйте репозиторий или скопируйте код тестового контроллера.
3. Установите зависимости, выполнив команду `composer install`.
4. Запустите тесты, выполнив команду `php artisan test`.

## Содержимое

- `test_CheckApiRoute()`: Проверяет маршрут `/api/check-api` и убеждается, что он возвращает код состояния HTTP 200.
- `test_DateFilterWithWeekend()`: Проверяет фильтр даты с выходным днем и убеждается, что сообщение содержит информацию о выходном дне.
- `test_DateFilterWithWorkDay()`: Проверяет фильтр даты с рабочим днем и убеждается, что сообщение содержит информацию о рабочем дне.
- `test_DateFilterWithHoliday()`: Проверяет фильтр даты с праздничным днем и убеждается, что сообщение содержит информацию о празднике.

## Запуск

Вы можете запустить этот тестовый контроллер, используя PHPUnit или команду `php artisan test`. Убедитесь, что ваше приложение настроено и доступно для тестирования.
