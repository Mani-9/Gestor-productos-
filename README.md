# Gestor de productos y categorias para Portafolio web

Portafolio web Manuel Reyes

## Stack

**Client:** Vue, TailwindCSS

**Server:** PHP, Laravel


## Roadmap
🔧 1. **Módulo de Autenticación:**
   
  - Registro / Inicio de sesión.
  - Roles y permisos básicos.
  - Protección de rutas con midddleware 

📦 2. **Gestión de categorías:**
     
  - CRUD completo de categorías:
    [Nombre, Descripción, Imagen]
  - Validaciones de lado del servidor  
  - Slug amigable
  - Filtro de Productos por categoría

🛒 3. **Gestión de productos:**
  - CRUD completo de productos: [Nombre, Descripción, Precio, Stock, Imagen, Categoria asociada, Estado(Activo/Inactivo)]     
  - Relacion belongsTo con Categorías
  - Buscar y paginación
  - Filtros por categoria, estado, etc

📁 4. **Panel de Administración:**
  - Dashboard básico con Estadisticas (total de productos, categorías, últimos productos añadidos)
  - Panel de navegación
  - Acceso solo Para Usuarios con rol "admin"

👀 5. **Fronte-End Publico:**
  - Página pública que muestre productos en cards
  - Filtro por categoría desde el frontend
  - Página de detalle de producto
  - Diseño responsive y limpio
  - Uso de componentes reutilizables

📸 6. **Manejo de imágenes:**
  - Subida de imágenes para productos y categorias
  - Validación y almacenamiento en storage
  - Miniaturas o redimensionamiento con Intervention Imagen

🛠️ 7. **Extras:**
  - API RESTful básica
  - Exportacion de productos(PDF o Excel)
  - Soft deletes y recuperacion de registros
  - Pruebas unitarias o de integración básica   



      


