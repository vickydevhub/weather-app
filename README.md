<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

 

## Structure Weather App
## =====Weather App==========

## Weather API===>
961523cd35bbcf6751722cdddc5beadf


## Schedulers ==>
php artisan schedule:list
php artisan make:command WeatherCron --command=weather:cron


## Jobs=========>
QUEUE_CONNECTION=database

php artisan make:job ProcessWeatherData

## Models=======>
php artisan make:model WeatherData --migration

## API RESOURCE=====>
php artisan make:resource WeatherResource

## Controllers===>
php artisan make:controller CronController
php artisan make:controller WeatherInfoController --resource



## Routes=========>
Route::resource('weather-info', WeatherInfoController::class);


## Migrations=====>
php artisan make:migration locations

## Seeders=========>
php artisan make:seeder LocationSeeder


## Events ==========>
php artisan make:event WeatherDataProcessed  


## Unit TEST========>
php artisan make:test WeatherApiTest


 
 
## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# weather-app
