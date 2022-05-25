
## Correr contenedor de docker
`docker run -p "80:80" -p 3306:3306 -v "/mnt/d/UNIVERSIDAD/BASES DE DATOS/sancarlos_proydb":/app -v "/mnt/d/UNIVERSIDAD/BASES DE DATOS/sancarlos_proydb/docs/db":/var/lib/mysql mattrayner/lamp:latest-1804`