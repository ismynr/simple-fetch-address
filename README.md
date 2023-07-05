## Descriptions
- Laravel 10
- PHP 8.1
- Composer 2.5.8

## How To Run
- ```git clone [repo_url]```
- ```composer install```
- ```cp .env.example .env```
- add new key in .env
    ```
    RAJA_ONGKIR_KEY=
    DATA_SOURCE_ADDRESS=database
    ```
    or
    ```
    RAJA_ONGKIR_KEY=
    DATA_SOURCE_ADDRESS=api
    ```
- ```php artisan migrate:fresh -seed```
- ```php artisan app:insert-address-from-raja-ongkir```
- ```php artisan test```
- ```php artisan serv```