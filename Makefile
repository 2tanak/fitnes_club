build:
	make clear
	make down
	docker-compose up -d --build
	#make install

install:
	make composer
	docker-compose exec php-fpm composer dump-autoload
	docker-compose exec php-fpm php artisan migrate
	docker-compose exec php-fpm php artisan db:seed
	docker-compose exec php-fpm php artisan storage:link
	docker-compose exec php-fpm php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider" --tag="vite"
	make node
	make copy
	
node:
	docker-compose exec node npm -v
	docker-compose exec node npm i
	docker-compose exec node npm run build
	make admin
	make auth

bash:
	docker-compose exec php-fpm bash

cach:
	docker-compose exec php-fpm php artisan config:clear
	docker-compose exec php-fpm php artisan cache:clear

ui:
	docker-compose exec php-fpm composer require laravel/ui
	docker-compose exec php-fpm php artisan ui vue --auth

netc:
	make clear
	docker network create prox_default
	make net

crud:
	make clear
	docker exec -it crud_nginx bash

clear:
	 clear

inspect:
	make clear
	docker container inspect crud_nginx

down:
	make clear
	docker-compose down

up:
	make clear
	docker-compose up -d

fresh:
	docker-compose exec php-fpm php artisan migrate:fresh
	make seed

seed:
	docker-compose exec php-fpm php artisan db:seed

admin:
	make clear
	# docker exec node npm i --prefix Modules/Admin
	docker exec node npm run build --prefix Modules/Admin
	
	make auth
    
auth:
	make clear
	# docker exec node npm i --prefix Modules/Auth
	docker exec node npm run build --prefix Modules/Auth

nauthd:
	make clear
	docker exec node npm run dev --prefix Modules/Auth

nadmind:
	make clear
	docker exec node npm run dev --prefix Modules/Admin
	docker exec node cp ./.vite/manifest.json ./ --prefix Public/build-admin

npmgrafika:
	make clear
	docker exec node npm i --prefix Modules/Grafika
	docker exec node npm run dev --prefix Modules/Grafika


npm:
	make clear
	docker exec node npm run dev

paginate:
	make clear
	docker exec php-fpm php artisan vendor:publish --tag=laravel-pagination

composer:
	docker-compose exec php-fpm composer update
	make alert

alert:
	docker-compose exec php-fpm php artisan sweetalert:publish

copy:
	cp -r Helper app/app
	 cp -r Services app/app

make_migrate:
	docker-compose exec php-fpm  php artisan make:migration create_permissions_table --create=permissions
migrate:
	docker-compose exec php-fpm php artisan migrate
make_factory:
	docker-compose exec php-fpm php artisan make:factory Permission -m
make_model:
	docker-compose exec php-fpm php artisan make:model Permission
git_auth:
	git config --global user.name 'Kanat'
	git config --global user.email 2tanak@mail.ru
