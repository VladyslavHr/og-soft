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
