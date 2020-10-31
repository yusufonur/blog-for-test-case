<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## Kurulum

    git clone https://github.com/yusufonur/blog-for-test-case
    
    composer install
    
    php artisan key:generate
    
    php artisan migrate --seed
    
    php artisan passport:install

## API Genel Bilgiler
- TOKEN, Bearer token olarak header'e eklenmelidir.

## Örnek Request
    $response = $client->request('GET', '/api/v1/category', [
        'headers' => [
            'Accept' => 'application/json',
        ],
    ]);
    
## Response Kalıbı
    {
        "message": "",
        "errors": [],
        "data": [
            {
                "id": 1,
                "title": "Voluptas.",
                "slug": "voluptas",
                "articles_count": 6
            },
            // ...
        ]
    }

## API Uç Noktaları

| METHOD    | URI                            | NAME               | ACTION                                                      | MIDDLEWARE           |
|-----------|--------------------------------|--------------------|-------------------------------------------------------------|----------------------|
| GET|HEAD  | /                              |                    | Closure                                                     | web                  |
| POST      | api/v1/article                 | article.store      | Api\V1\Articles\Controllers\ArticleController@store         | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin|Writer    |
| GET|HEAD  | api/v1/article                 | article.index      | Api\V1\Articles\Controllers\ArticleController@index         | api                  |
| GET|HEAD  | api/v1/article/{article}       | article.show       | Api\V1\Articles\Controllers\ArticleController@show          | api                  |
| DELETE    | api/v1/article/{article}       | article.destroy    | Api\V1\Articles\Controllers\ArticleController@destroy       | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin|Writer    |
|           |                                |                    |                                                             | verify_article_owner |
| PUT|PATCH | api/v1/article/{article}       | article.update     | Api\V1\Articles\Controllers\ArticleController@update        | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin|Writer    |
|           |                                |                    |                                                             | verify_article_owner |
| GET|HEAD  | api/v1/category                | category.index     | Api\V1\Categories\Controllers\CategoryController@index      | api                  |
| POST      | api/v1/category                | category.store     | Api\V1\Categories\Controllers\CategoryController@store      | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| DELETE    | api/v1/category/{category}     | category.destroy   | Api\V1\Categories\Controllers\CategoryController@destroy    | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| PUT|PATCH | api/v1/category/{category}     | category.update    | Api\V1\Categories\Controllers\CategoryController@update     | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| GET|HEAD  | api/v1/category/{category}     | category.show      | Api\V1\Categories\Controllers\CategoryController@show       | api                  |
| POST      | api/v1/login                   |                    | Api\V1\Users\Controllers\LoginController@login              | api                  |
| POST      | api/v1/logout                  |                    | Api\V1\Users\Controllers\LoginController@logout             | api                  |
|           |                                |                    |                                                             | auth:api             |
| POST      | api/v1/subscriber              | subscriber.store   | Api\V1\Subscribers\Controllers\SubscriberController@store   | api                  |
|           |                                |                    |                                                             | auth:api             |
| GET|HEAD  | api/v1/subscriber              | subscriber.index   | Api\V1\Subscribers\Controllers\SubscriberController@index   | api                  |
|           |                                |                    |                                                             | auth:api             |
| GET|HEAD  | api/v1/subscriber/{subscriber} | subscriber.show    | Api\V1\Subscribers\Controllers\SubscriberController@show    | api                  |
|           |                                |                    |                                                             | auth:api             |
| DELETE    | api/v1/subscriber/{subscriber} | subscriber.destroy | Api\V1\Subscribers\Controllers\SubscriberController@destroy | api                  |
|           |                                |                    |                                                             | auth:api             |
| GET|HEAD  | api/v1/user                    | user.index         | Api\V1\Users\Controllers\UserController@index               | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| POST      | api/v1/user                    | user.store         | Api\V1\Users\Controllers\UserController@store               | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| GET|HEAD  | api/v1/user/{user}             | user.show          | Api\V1\Users\Controllers\UserController@show                | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| PUT|PATCH | api/v1/user/{user}             | user.update        | Api\V1\Users\Controllers\UserController@update              | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |
| DELETE    | api/v1/user/{user}             | user.destroy       | Api\V1\Users\Controllers\UserController@destroy             | api                  |
|           |                                |                    |                                                             | auth:api             |
|           |                                |                    |                                                             | role:Admin           |




