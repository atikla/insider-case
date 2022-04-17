### Project
##### Insider Champions League [case-file](https://github.com/atikla/insider-case/blob/main/InsiderOnlineProject.pdf)

### Setup project environment
- you can run this command after clone git repository
- to clone repository you can use this command:
- ``git clone git@github.com:atikla/insider-case.git ./insider-case && cd insider-case ``
- after clone repository you have to run those two command to build your environment on docker
- ``docker-compose up -d --build``
- ``docker-compose exec php /bin/bash bin/install.sh``
- ``docker-compose exec php php artisan db:seed``
- when commands done you will have running project with php8, nginx, mysql@8, phpmyadmin in your localhost
- project: ``http://localhost:10002/``
- mysql: ``http://localhost:10000/``
- phpmyadmin: ``http://localhost:10001/``

### deployed project
- you can access to running deploy project from this address
- ``https://insider-case.herokuapp.com/``

#### Notes
- Because the project was wanted to be developed in a limited time, the project has some places to will be refactored
