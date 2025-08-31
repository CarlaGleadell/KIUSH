
# 💻 Implementación del sistema KIUSH

## Sistema de gestión de inscripciones a cursos de extensión de la UNPA-UARG
Su objetivo es digitalizar la inscripción, administración de cursos y exportación de datos al sistema GEDIC, garantizando seguridad, trazabilidad y facilidad de uso para personal administrativo de la secretaría de extensión de la Universidad Nacional de la Patagonia Austral - Unidad Académica Río Gallegos.

<p align="center">
  <img src="lib/img/logo_kiush_blanco.png" alt="Logo KIUSH" width="400"/>
</p>

---

## 🔗 Repositorios relacionados

- 📚 [Repositorio de Documentación](https://github.com/CarlaGleadell/KIUSHDocumentacion) 
- 💻 [Repositorio de Código](https://github.com/CarlaGleadell/KIUSH)
- 📺 [Video de muestra del sistema](https://vimeo.com/1114576529?h=1114576529)

---

## 📂 Estructura del Repositorio

```plaintext
KIUSH/
│
├── 📂 app/
│   ├── 📄 curso.buscar.php
│   ├── 📄 curso.crear.php
│   ├── 📄 curso.crear.procesar.php
│   ├── 📄 curso.csv.descargar.php
│   ├── 📄 curso.eliminar.php
│   ├── 📄 curso.eliminar.procesar.php
│   ├── 📄 curso.inscribirse.php
│   ├── 📄 curso.inscriptos.descargar.php
│   ├── 📄 curso.modificar.php
│   ├── 📄 curso.modificar.procesar.php
│   ├── 📄 curso.ver.php
│   ├── 📄 cursos.php
│   ├── 📄 index_2.php
│   ├── 📄 index.php
│   ├── 📄 integrante.buscar.php
│   ├── 📄 integrante.crear.php
│   ├── 📄 integrante.crear.procesar.php
│   ├── 📄 integrante.curso.agregar.procesar.php
│   ├── 📄 integrante.curso.datos.php
│   ├── 📄 integrante.curso.datos.procesar.php
│   ├── 📄 integrante.curso.modificar.php
│   ├── 📄 integrante.curso.modificar.procesar.php
│   ├── 📄 integrante.curso.quitar.php
│   ├── 📄 integrante.curso.quitar.procesar.php
│   ├── 📄 integrante.eliminar.php
│   ├── 📄 integrante.eliminar.procesar.php
│   ├── 📄 integrante.modificar.php
│   ├── 📄 integrante.modificar.procesar.php
│   ├── 📄 integrante.ver.php
│   ├── 📄 integrantes.curso.php
│   ├── 📄 integrantes.gestionar.php
│   ├── 📄 integrantes.php
│   ├── 📄 KIUSH.php
│   ├── 📄 permiso.crear.php
│   ├── 📄 permiso.crear.procesar.php
│   ├── 📄 permiso.eliminar.php
│   ├── 📄 permiso.eliminar.procesar.php
│   ├── 📄 permiso.modificar.php
│   ├── 📄 permiso.modificar.procesar.php
│   ├── 📄 permiso.ver.php
│   ├── 📄 permisos.php
│   ├── 📄 persona.crear.php
│   ├── 📄 persona.crear.procesar.php
│   ├── 📄 persona.curso.agregar.procesar.php
│   ├── 📄 persona.curso.quitar.php
│   ├── 📄 persona.curso.quitar.procesar.php
│   ├── 📄 persona.eliminar.php
│   ├── 📄 persona.eliminar.procesar.php
│   ├── 📄 persona.modificar.php
│   ├── 📄 persona.modificar.procesar.php
│   ├── 📄 persona.ver.php
│   ├── 📄 personas.curso.php
│   ├── 📄 personas.gestionar.php
│   ├── 📄 personas.php
│   ├── 📄 procesar.csv.php
│   ├── 📄 rol.crear.php
│   ├── 📄 rol.crear.procesar.php
│   ├── 📄 rol.eliminar.php
│   ├── 📄 rol.eliminar.procesar.php
│   ├── 📄 rol.modificar.php
│   ├── 📄 rol.modificar.procesar.php
│   ├── 📄 rol.ver.php
│   ├── 📄 roles.php
│   ├── 📄 salir.php
│   ├── 📄 usuario.buscar.php
│   ├── 📄 usuario.crear.php
│   ├── 📄 usuario.crear.procesar.php
│   ├── 📄 usuario.eliminar.php
│   ├── 📄 usuario.eliminar.procesar.php
│   ├── 📄 usuario.modificar.php
│   ├── 📄 usuario.modificar.procesar.php
│   ├── 📄 usuario.ver.php
│   ├── 📄 usuarios.php
│   │
│   └── 📂 gui/
│       ├── 📄 footer_visitante.php
│       ├── 📄 footer.php
│       ├── 📄 navbar_visitante.php
│       └── 📄 navbar.php
│
├── 📂 lib/
│   ├── 📂 bootstrap-4.1.1-dist/
│   │   ├── 📂 css/
│   │   │   └── [Archivos .css de bootstrap]
│   │   │
│   │   └── 📂 js/
│   │       └── [Archivos .js de bootstrap]
│   │
│   ├── 📂 img/
│   │       └── [Imagenes utilizadas en la interfaz]
│   │
│   ├── 📂 JQuery/
│   │   └── [Librería jQuery]
│   │
│   └── 📂 open-iconic-master/
│       └── [Iconos e iconografías del sistema]
│
├── 📂 modelo/
│   ├── 📄 BDColeccionGenerica.Class.php
│   ├── 📄 BDConexion.Class.php
│   ├── 📄 BDModeloGenerico.Class.php
│   ├── 📄 BDObjetoGenerico.Class.php
│   ├── 📄 ColeccionCursos.php
│   ├── 📄 ColeccionIntegrantes.php
│   ├── 📄 ColeccionPermisos.php
│   ├── 📄 ColeccionPersonas.php
│   ├── 📄 ColeccionRoles.php
│   ├── 📄 ColeccionUsuarios.php
│   ├── 📄 Cursos.Class.php
│   ├── 📄 Integrante.Class.php
│   ├── 📄 Permiso.Class.php
│   ├── 📄 Persona.Class.php
│   ├── 📄 Rol.Class.php
│   └── 📄 Usuario.Class.php
│
├── 📂 vendor/
|   └── [Dependencias de Composer - PHPMailer, PHPOffice, PSR y otros]
|
└── 💾 bdkiush.sql

````
## Descripción de la Estructura

### 📂 app/
Contiene toda la lógica de la aplicación web, organizados en módulos funcionales:
- **Cursos**: Archivos para gestión, búsqueda, creación, modificación y eliminación de cursos
- **Integrantes**: Gestión de integrantes y su relación con los cursos
- **Permisos**: Administración del sistema de permisos
- **Personas**: Gestión de datos de personas en el sistema
- **Roles**: Administración de roles de usuario
- **Usuarios**: Gestión completa de usuarios del sistema
- **GUI**: Componentes de interfaz (navbars y footers)

### 📂 gui/
Componentes de interfaz (navbars y footers)

### 📂 lib/
Librerías y recursos externos:
- **Bootstrap 4.1.1**: Framework CSS para diseño responsivo
- **jQuery**: Librería JavaScript (v3.3.1) para manipulación DOM e interactividad
- **Open Iconic**: Set completo de iconos en múltiples formatos (SVG, PNG, WebP)
- **Imágenes**: Recursos gráficos del sistema (logos, fondos, imágenes de cursos)

### 📂 modelo/
Capa de modelo siguiendo patrón MVC:
- **Clases base**: BDConexion, BDModeloGenerico, BDObjetoGenerico
- **Entidades**: Curso, Integrante, Permiso, Persona, Rol, Usuario
- **Colecciones**: Manejo de conjuntos de entidades

### 📂 vendor/
Dependencias gestionadas por Composer:
- **PHPMailer**: Para envío de correos electrónicos  
- **PHPOffice**: Para manejo de archivos Excel y Office
- **PSR**: Estándares PSR de PHP para interoperabilidad
- **Autoloader**: Sistema de carga automática de clases

### Archivos de Configuración
- **.gitignore**: Archivos y carpetas excluidas del control de versiones
- **bdkiush.sql**: Estructura y datos de la base de datos del sistema
- **composer.json**: Archivo de configuración de dependencias de Composer
- **composer.lock**: Versiones específicas de las dependencias instaladas
- **index.php**: Punto de entrada principal de la aplicación

## 👩‍💻 Desarrollado por

<div align="center">
  <img src="lib/img/circulo_blanco.png" alt="Yield Yielders" width="150"/>
  <h3>Equipo YY - Yield Yielders</h3>
</div>



