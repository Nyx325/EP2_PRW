El proyecto se divide en carpetas con
lo siguiente

```
.
├── README.md                            # Documentación del proyecto y guía de uso
├── public                               # Archivos accesibles desde el navegador (Frontend)
│   ├── assets                            # Archivos estáticos como imágenes e iconos
│   │   ├── icon                          # Iconos utilizados en la aplicación
│   │   └── img                           # Imágenes usadas en el sitio
│   │       └── barbershop-aside.png
│   ├── css                               # Hojas de estilo (CSS)
│   │   ├── common.css                    # Estilos generales de la aplicación
│   │   └── header-footer.css
│   ├── js                                # Scripts (JavaScript)
│   │   └── header-footer.js
│   ├── partials                           # Componentes HTML comunes (como headers y footers)
│   │   ├── footer.html
│   │   └── header.html
│   └── views                              # Vistas (páginas HTML)
│       └── index.html
└── src                                   # Código fuente del backend (PHP)
    ├── config                             # Configuración del proyecto
    │   ├── database.php
    │   └── session.php
    ├── controllers                        # Controladores que manejan la lógica de negocio
    └── models                             # Modelos para interactuar con la base de datos
```
