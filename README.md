El proyecto se divide en carpetas con
lo siguiente

```
/proyecto
│
├── /public/                # Archivos accesibles desde el navegador (Frontend)
│   ├── /css/               # Hojas de estilo (CSS)
│   ├── /js/                # Scripts (JavaScript)
│   ├── /assets/               # Imágenes u otros archivos estáticos
│   ├── /views/             # Vistas (páginas HTML)
│   │   ├── index.html      # Página principal
│   │   ├── about.html      # Ejemplo de otra vista (Acerca de)
│   │   ├── contact.html    # Otra vista (Contacto)
│   │   └── dashboard.html  # Otra vista (Dashboard, si hay áreas privadas)
│   └── /partials/          # Componentes HTML comunes (como headers y footers)
│       ├── header.html     # Encabezado común para todas las páginas
│       └── footer.html     # Pie de página común
│
├── /src/                   # Código fuente del backend (PHP)
│   ├── /controllers/       # Controladores que manejan la lógica de negocio
│   ├── /models/            # Modelos para interactuar con la base de datos
│   └── /config/            # Configuración del proyecto, como conexión a base de datos
│       └── database.php
│
├── /api/                   # Endpoints PHP para manejar las peticiones AJAX desde el frontend
│   └── datos.php           # Archivo PHP que procesa los datos y maneja la lógica del backend
```
