# Instalación en local

### Requisitos previos:

- Docker instalado en su servidor conforme a los pasos 1 y 2 de [Cómo instalar y usar Docker en Ubuntu 20.04](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04)
- Docker Compose instalado en su servidor conforme el paso 1 de [Cómo instalar Docker Compose en Ubuntu 20.04](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04)

### Copiar el archivo .env.example y renombrarlo, puede hacerlo con el siguiente comando: 
```
sudo cp .env.example .env
```

### Para crear el contenedor con Docker: 
```
sudo docker-compose build app
```
### Para levantar el contenedor: 
```
sudo docker-compose up -d
```
### Para verificar el despliegue de los servicios: 
```
sudo docker-compose ps
```

Output:

| Name            | Command                        | State | Ports                                    |
|-----------------|:-------------------------------|:-----:|-----------------------------------------:|
| db              | docker-entrypoint.sh mysqld    | Up    | 0.0.0.0:8889->3306/tcp,:::8889->3306/tcp |
| good_meal-app   | docker-php-entrypoint php-fpm  | Up    | 9000/tcp                                 |
| good_meal-nginx | /docker-entrypoint.sh ngin ... | Up    | 0.0.0.0:8000->80/tcp,:::8000->80/tcp     |


### Ejecutar los siguiente comandos: 
```
sudo docker-compose exec app composer install
```
### Ejecutar los siguiente comandos: 
```
sudo docker-compose exec app php artisan key:generate
```
### NOTA: si obtiene algún error, ejecutar: 
```
sudo docker-compose exec app php artisan optimize
```

### Ejecute nodejs:
```
sudo docker-compose exec app npm run install && npm run dev 
```

### Ejecute las migraciones (esto creará las tablas, una lista de 10 usuarios, la contraseña para todos es "password" (sin las comillas), tambien se crearán 1000 subcripciones):
```
sudo docker-compose exec app php artisan migrate --seed
```

### Si quiere ejecutar los datos de prueba de nuevo y obtener otros usuarios y subcripciones de prueba, ejecutar el siguiente comando:
```
sudo docker-compose exec app php artisan db:seed
```

### Para ejecutar los test, ejecutar:
```
sudo docker-compose exec app php artisan test
```

### Decidí implementar "Arquitectura por capas" ¿por que? Porque es fácil de implementar y rapida de desarrollar para el ejercicio planteado. Además laravel esta estructurado para esa arquitectura. 

### Diagrama de clases:
![Diagrama de clases](/storage/diagrama_de_clases.png)

# Instrucciones de uso de la API [readme API](https://github.com/bypabloc/good-meal/blob/main/README-API.md)