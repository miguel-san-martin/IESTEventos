# IESTEventos
Pasos para ponerlo en forma desarrollo:

1. Se cambia el archivo `public/.htaccess` de RewriteBase / :
```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase / => /IESTEventos/
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule> 
```

2. Se remplaza todas las coincidencias de
   https://sie.iest.edu.mx/IESTEventos/ por http:/localhost:80/IESTEventos/
3. Asegurarse de descargar la API de api/proyecto-iest-alumnos
