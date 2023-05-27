## Installation

- Install git and docker on your system. If you use windows, install docker desktop and ubuntu. Ubuntu can be downloaded through the Microsoft Store. In the docker settings, go to Resources->WSL integration and select Ubuntu. Then go to \\wsl.localhost\Ubuntu-20.04\home\{{your user}}, create a folder with the project.
- Clone the project: $git clone https://github.com/V0LKINI/vshop-backend.git
- Run containers: $docker-compose up -d
- Log into bash inside the container: $docker exec -it vshop bash
- Install dependencies: $composer install --optimize-autoloader --no-dev
- Configure your database, then migrate: $php artisan migrate
- Create App key: $php artisan key:generate
- Create a symbolic link: $php artisan storage:link
- Go to http://localhost:8080/api/
