# Installing

1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate

# Running

```
php -dxdebug.mode=debug -dxdebug.start_with_request=yes -dxdebug.client_port=9000 -dxdebug.client_host=127.0.0.1 -dxdebug.remote_connect_back=1 -S localhost:8000 -t public
```

Head to http://localhost:8000 and create a profile

Use your API key from libraries.io
