# Instrucciones de uso de la API

### El siguiente archivo contiene un archivo json, el cual tiene las pruebas utilizadas en postman para hacer consultas y registros en la API [postman.json](https://github.com/bypabloc/good-meal/blob/main/storage/postman.json) 

### Para la api estan disponibles las siguientes rutas: 
- POST /api/v1/login
- POST /api/v1/register
- GET  /api/v1/subcribirse/list (token requerido)
- GET  /api/v1//logout (token requerido)

### Para la ruta "login" espera 2 parámetros:
- email (string)
- password (string)

### Para la ruta "register" espera 4 parámetros:
- name (string)
- email (string)
- password (string)
- password_confirm (string)

### Para las rutas que requieren token se debe pasar como autorizacion en el header de la solicitud, el parametro en el header debe llamarse "Authorization" y concatenar el token (previamente obtenido al hacer login), quedando algo como lo siguiente:
- Bearer 9|zc40K4lZaZ8Ss8HTKVrLjfkwrEGn0jaPfFOpLsYU

### Para la ruta "subcribirse/list", puede enviarse sin parametros, el resultado seria los primeros 10 items de la lista.
- page (integer)
- per_page (integer)

### Si se desea especificar la pagina y cuantos por lista se puede enviar como parametros los siguientes valores, un ejemplo de la ruta seria algo como esto:
- /api/v1/subcribirse/list?page=1&per_page=10

### Para la ruta "logout" espera solo el token