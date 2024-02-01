
## Managed Devices

An inventory management backend using Laravel for tracking device allocations that can be interacted with via a RESTful JSON
API.

## Steps to run

Clone the repository

```
git clone https://github.com/adeyinkaadejumo/managed-devices.git
```

Change directory into `managed-devices`

```
cd managed-devices
```

Install dependencies

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Copy .env File

```
cp .env.example .env
```

Start docker containers

```
./vendor/bin/sail up -d
```

Log in to Laravel container 

```
./vendor/bin/sail shell
```

Run migrations and seeders

```
php artisan migrate:fresh --seed
```

## Testing

```
php artisan test
```

## Documentation

API documentation is accessible via `/doc`.

OpenAPI yaml file is `./public/docs/openapi.yaml`