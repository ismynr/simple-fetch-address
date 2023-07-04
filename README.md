# Descriptions
- Laravel 10
- PHP 8.1
- Composer 2.5.8

<br/>

# How To Run
- ```git clone [repo_url]```
- ```composer install```
- ```cp .env.example .env```
- add new key in .env (2 type swapable sources)

    ```
    RAJA_ONGKIR_KEY=
    DATA_SOURCE_ADDRESS=database
    ```
    ```
    RAJA_ONGKIR_KEY=
    DATA_SOURCE_ADDRESS=api
    ```

- ```php artisan key:generate```
- ```php artisan migrate:fresh --seed```
- ```php artisan app:insert-address-from-raja-ongkir```
- ```php artisan test```
- ```php artisan serv```

<br/>

# Documentations
## Authentication API
- ```[POST]``` Login User
    - URL ```/api/login```
    - Headers
        ```
        Accept: application/json
        ```
    - Body
        ```
        {
            "email": "test@mail.com",
            "password": "password"
        }
        ```
- ```[POST]``` Register User
    - URL ```/api/register```
    - Headers
        ```
        Accept: application/json
        ```
    - Body
        ```
        {
            "name": "test 2",
            "email": "test2@mail.com",
            "password": "password"
        }
        ```
- ```[POST]``` Logout User
    - URL ```/api/logout```
    - Headers
        ```
        Accept: application/json
        Authorization: Bearer [Token]
        ```

## Search Address API
- ```[GET]```  Single Province
    - URL ```/search/cities?id={province_id}```
    - Headers
        ```
        Accept: application/json
        Authorization: Bearer [Token]
        ```

- ```[GET]``` Single Cities
    - URL ```/search/cities?id={city_id}```
    - Headers
        ```
        Accept: application/json
        Authorization: Bearer [Token]
        ```