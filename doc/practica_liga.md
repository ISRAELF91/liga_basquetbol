# Documentación Técnica: Sistema de Gestión de Liga de Básquetbol

## 1. Descripción general de la arquitectura del sistema
El sistema ha sido desarrollado utilizando el framework PHP Laravel, implementando el patrón de diseño arquitectónico MVC (Modelo-Vista-Controlador). Esta estructura permite una separación clara de responsabilidades: los Modelos gestionan la abstracción y lógica de acceso a la base de datos MySQL mediante Eloquent ORM; los Controladores procesan las peticiones HTTP (Request) y aplican las reglas de negocio; y las Vistas (renderizadas con el motor de plantillas Blade) despliegan la interfaz de usuario. 

Para el frontend, se integró el framework de utilidad Tailwind CSS a través del paquete Laravel Breeze, el cual también proporcionó el andamiaje completo para la autenticación segura de usuarios (sesiones, encriptación de contraseñas y middleware). Todo el ciclo de vida del desarrollo se gestionó bajo un estricto control de versiones con Git, empleando un flujo de trabajo basado en ramas de características (*feature branches*) fusionadas progresivamente hacia la rama `main` en un repositorio remoto alojado en GitHub.

## 2. Listado de clases, controladores y modelos implementados
La arquitectura de datos e interacciones se sostiene sobre las siguientes clases principales:

**Modelos (`app/Models/`):**
* `User`: Clase nativa extendida para gestionar la autenticación de los administradores.
* `Equipo`: Gestiona la persistencia de las escuadras.
* `Jugador`: Representa a los atletas; define una relación `belongsTo` con el modelo `Equipo`.
* `Partido`: Entidad relacional compleja que vincula dos instancias de `Equipo` (`equipoLocal` y `equipoVisitante`).

**Controladores (`app/Http/Controllers/`):**
* `EquipoController`: Orquesta las operaciones CRUD para el registro y mantenimiento de escuadras.
* `JugadorController`: Maneja la validación e inserción de jugadores, garantizando su dependencia a un equipo activo.
* `PartidoController`: Controla la programación de los encuentros deportivos y la posterior actualización de marcadores.
* `EstadisticaController`: Controlador de lógica de lectura para procesar cálculos matemáticos de la tabla de posiciones.

## 3. Descripción de las principales funcionalidades
El software se divide en módulos funcionales interconectados:
* **Autenticación y Seguridad:** Registro, login y protección de rutas mediante el middleware `auth`, garantizando que entidades anónimas no puedan alterar los datos.
* **Gestión de Entidades (CRUD):** Creación, lectura, actualización y eliminación de Equipos y Jugadores, con validación estricta de formularios y manejo de sesiones para el feedback visual (alertas de éxito).
* **Gestión de Partidos:** Permite al administrador programar enfrentamientos cruzando dos equipos distintos, asignando una fecha (formato `datetime-local`). Permite la edición posterior para cambiar el estado a "Jugado" y registrar el *score*.
* **Motor de Estadísticas:** Módulo de solo lectura que itera sobre la base de datos de partidos "Jugados" para calcular dinámicamente, en tiempo de ejecución, los partidos disputados y los puntos acumulados por cada equipo, renderizando una tabla de posiciones en orden descendente.

## 4. Explicación de fragmentos relevantes de código
Un aspecto crítico de la integridad de los datos fue evitar anomalías lógicas, como que un equipo compitiera contra sí mismo. Esto se resolvió en el método `store` del `PartidoController`:

```php
$request->validate([
    'equipo_local_id' => 'required|exists:equipos,id',
    'equipo_visitante_id' => 'required|exists:equipos,id|different:equipo_local_id',
    'fecha_partido' => 'required|date',
]);