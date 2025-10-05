# Docker LEMP Setup for Laravel

This project uses Docker with a LEMP stack (Linux, Nginx, MySQL, PHP).

## Containers

- **webserver** - Nginx (port 8080)
- **php** - PHP 8.2-FPM with extensions
- **database** - MySQL 8.0 (port 3306)
- **phpmyadmin** - phpMyAdmin (port 8081)

## Prerequisites

- Docker version 28.1.1 or higher
- Docker Compose (integrated with Docker CLI)

## Quick Start

### 1. Build and Start Containers

```bash
docker compose up -d --build
```

### 2. Generate Application Key

```bash
docker compose exec php php artisan key:generate
```

### 3. Run Migrations

```bash
docker compose exec php php artisan migrate
```

### 4. Install NPM Dependencies (Optional)

```bash
docker compose exec php npm install
docker compose exec php npm run dev
```

## Access Points

- **Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

## Database Credentials

- **Database Name**: laravel
- **Username**: laravel_user
- **Password**: secret
- **Root Password**: root_secret

## Common Commands

### View Logs
```bash
docker compose logs -f
```

### View Specific Container Logs
```bash
docker compose logs -f [webserver|php|database|phpmyadmin]
```

### Stop Containers
```bash
docker compose down
```

### Restart Containers
```bash
docker compose restart
```

### Access PHP Container
```bash
docker compose exec php sh
```

### Access Database Container
```bash
docker compose exec database mysql -u root -p
```

### Run Artisan Commands
```bash
docker compose exec php php artisan [command]
```

### Run Composer Commands
```bash
docker compose exec php composer [command]
```

### Clear Laravel Cache
```bash
docker compose exec php php artisan cache:clear
docker compose exec php php artisan config:clear
docker compose exec php php artisan route:clear
docker compose exec php php artisan view:clear
```

## File Structure

```
.
├── docker-compose.yml          # Main Docker orchestration file
├── docker/
│   ├── nginx/
│   │   └── default.conf       # Nginx configuration
│   └── php/
│       └── Dockerfile         # PHP-FPM custom image
├── .dockerignore              # Files to ignore in Docker build
└── .env                       # Environment variables
```

## Troubleshooting

### Permission Issues
If you encounter permission issues:
```bash
docker compose exec php chown -R www-data:www-data /var/www/html/storage
docker compose exec php chmod -R 775 /var/www/html/storage
```

### Database Connection Issues
Make sure the database container is fully started before running migrations:
```bash
docker compose logs database
```

Wait for this message in logs before running migrations:
```
database  | [Server] /usr/sbin/mysqld: ready for connections
```

### Rebuild Containers
If you make changes to Dockerfile or need a fresh start:
```bash
docker compose down -v
docker compose up -d --build
```

### Check Container Status
```bash
docker compose ps
```

### Remove All Data and Start Fresh
```bash
docker compose down -v --remove-orphans
docker compose up -d --build
```
