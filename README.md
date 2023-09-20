# TPE-WEB2 2023
* Iñaki Gopar - tatigop09@gmail.com  
* Benjamín Villar González - benya_vg@hotmail.com
## Tematica: ShowRoom (Tienda de mates)
### Nuestra pagina tiene como objetivo ser un showroom de compra de insumos relacionados con el mate.
![Diagrama de entidad relacion](https://github.com/Elchaca011/TPE-WEB2/blob/main/Captura%20TP%20web2%20entrga%201.PNG)
En nuestra base de datos creamos una tabla llamada categorias que contiene 3 columnas (id_categoria(PK && FK), categoria, fragil). Otra tabla llamada productos que contiene 6 columnas (id_productos(PK), id_categoria(FK), nombre, material, color, precio).
Nuestras tablas se relacionan mediante la columna *id_categoria* de manera que cada producto puede contener una categoria y una categoria puede contener varios productos a la vez
