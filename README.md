# GoodMeal 

### Crear base de datos, ej: 
```
CREATE DATABASE good_meal;
```

### Ejecuta los siguientes comandos para iniciar el proyecto:

### Instalar los paquetes de composer:
```
composer install
```

### NOTA: para el siguiente comando debes tener el archivo ".env" creado, de lo contrario dará error. (Puede copiar y pegar el archivo ".env.example" y allí indicar los datos de la DB que creó)

### Generar la clave cifrada de laravel:
```
php artisan key:generate
```

### Ejecute las migraciones:
```
php artisan migrate
```

### Ejecuta los seeds, esto creará una lista de 10 usuarios, la contraseña para todos es "password" (sin las comillas), tambien se crearán 1000 subcripciones creadas.
```
php artisan db:seed
```

### Ejecute nodejs:
```
npm run install && npm run dev 
```


### En la carpeta "storage/" se encuentra un archivo llamado "postman.json", este contiene las pruebas utilizadas en postman para hacer consultas y registros en la API. 


### Decidí implementar "Arquitectura por capas" ¿por que? Porque es fácil de implementar y rapida de desarrollar para el ejercicio planteado. 


### En la misma carpeta esta un archivo llamado "Diagrama de clases.png"