# Escape Room: "El misterio del Castillo de Luna"
Proyecto para la asignatura — Escape Room basado en el patrimonio, historia y cultura de Mairena del Alcor.

---

## Contenido del repositorio
- `index.php` — Página principal / introducción y botón "Comenzar".
- `prueba1.php` — Prueba 1: imagen con letras difíciles (inscripción en la torre).
- `prueba2.php` — Prueba 2: frase incompleta sobre la romería (día y mes).
- `prueba3.php` — Prueba 3: apellido histórico ligado al castillo.
- `final.php` — Pantalla final que resuelve el misterio y felicita al jugador.
- `funciones.php` — Funciones PHP reutilizables (normalizar, validar, pistas, intentos).
- `estilos.css` — Estilos visuales (tema pergamino/castillo).
- `interactividad.js` — JavaScript para pequeñas mejoras UI (contraste, confirmaciones).
- `assets/` — Carpeta con gráficos / placeholders:
  - `castle.jpg` (imagen para la intro)
  - `inscription.png` (imagen borrosa para prueba1)
  - `ermita.jpg`
  - `feria.jpg`
  - `favicon.ico`

> **Nota:** los archivos en `assets/` son placeholders. Sustituye `inscription.png` por una imagen con texto distorsionado (recomendado: 1200x800 px) para la Prueba 1. Las otras imágenes pueden ser 1200x700 px. `favicon.ico` 32x32.

---

## Historia y relación con el patrimonio (resumen)
**Narrativa:** "Noche de tormenta sobre los Alcores. Un rayo iluminó el Castillo de Luna y un pergamino quedó rasgado. Eres alumno del archivo municipal y debes recomponer el pergamino antes de la medianoche. Tres secretos te esperan en el castillo, la ermita y la feria."

**Relaciones con Mairena del Alcor:**
- **Castillo de Luna**: símbolo histórico del municipio (origen medieval, fases desde el siglo XIV).
- **Ermita / romería**: referencia a las celebraciones religiosas tradicionales (último domingo de septiembre).
- **Feria**: importancia local de la Feria de Mairena del Alcor; nombre y patrimonio inmaterial local.

---

## Explicación de las pruebas (detallado)
### Prueba 1 — La inscripción en la torre
- **Qué pide:** transcribir la palabra que aparece en la losa (imagen `inscription.png`).
- **Relación patrimonial:** inscripción en la torre del Castillo; referencia al astro que da nombre al castillo.
- **Respuesta aceptada:** `luna`, `la luna` (se normaliza y acepta mayúsculas/minúsculas/acentos).
- **Pistas:** pista normal y pista extra (pista extra ofrece la estructura de la palabra).

### Prueba 2 — La plegaria de la ermita
- **Qué pide:** completar la frase "La romería en honor a nuestra patrona se celebra el último ___ de ___." (día y mes).
- **Relación patrimonial:** romería/fiestas locales; tradición de septiembre.
- **Respuesta aceptada:** combinaciones que equivalgan a `domingo|septiembre` (se admite variantes como 'ultimo domingo|septiembre').
- **Pistas:** pista normal (indicación del mes), pista extra (nombre directo del mes).

### Prueba 3 — La Feria y el escudo perdido
- **Qué pide:** escribir el apellido histórico ligado al castillo (apellido que completa el pergamino).
- **Relación patrimonial:** apellido tradicional que aparece en escudos y referencias históricas del municipio.
- **Respuestas aceptadas:** `luna`, `de luna`, `familia luna`, `escudo luna` (normalizadas).
- **Pistas:** pista normal (referencia al astro), pista extra (letras inicial y final).

---

## Implementación técnica (qué hace cada archivo)
- **index.php**
  - Presenta la introducción y botón para empezar.
  - Permite reiniciar la partida (`?reset=1`).
- **funciones.php**
  - Define arrays con respuestas aceptadas y pistas.
  - Inicializa variables de sesión.
  - `normalizar($s)` — quita tildes, convierte a minúsculas y limpia espacios.
  - `validarRespuesta($input, $aceptadasArray)` — compara la respuesta normalizada con las aceptadas.
  - `obtenerPista($prueba, $tipo, $indice)` — devuelve la pista solicitada.
  - `consumirPistaExtra($prueba)` — marca la pista extra como consumida en `$_SESSION`.
  - `incrementarIntento($prueba)` y `getIntentosRestantes($prueba)` — gestionan intentos (5 por prueba).
  - `sanitize_input($data)` — sanitiza entradas POST/GET para evitar XSS básico.
- **prueba1.php / prueba2.php / prueba3.php**
  - Incluyen `funciones.php`, comprueban acceso secuencial entre pruebas.
  - Permiten pedir pista normal y pista extra (pista extra requiere confirmación JS y queda registrada).
  - Muestran intentos restantes y mensajes de error/éxito.
  - Redirigen al siguiente paso si la respuesta es correcta.
- **final.php**
  - Comprueba que las tres pruebas estén completadas y muestra el texto final de resolución.
- **estilos.css**
  - Proporciona tema pergamino/castillo, estilos de botones, mensajes y responsive.
- **interactividad.js**
  - Maneja el botón de contraste y confirma la intención de gastar la pista extra.
  - Animaciones sutiles para mensajes.

---

## Uso de sesiones y lógica
- El progreso se guarda en `$_SESSION`:
  - `prueba1_attempts`, `prueba2_attempts`, `prueba3_attempts` — intentos restantes (inicial 5).
  - `prueba1_pista_extra_used`, ... — booleano si se usó la pista extra.
  - `prueba1_correcta`, ... — booleano si la prueba fue superada.
- La pista extra se puede consumir **1 vez** por prueba; al pulsar el botón aparece una confirmación JS.
- Las entradas se normalizan y sanitizan antes de comparar.

---

## Soluciones de las pruebas (cómo llegar a la respuesta)
1. **Prueba 1:** Observa la imagen. Pistas: “Brilla en la noche… palabra de 4 letras”. Respuesta: **luna**.
2. **Prueba 2:** Frase sobre romería. Pistas: “final del mes noveno”, “no es día entre semana”. Respuesta: **domingo**, **septiembre**.
3. **Prueba 3:** Clave en el tablón ferial; relación con la primera prueba. Respuesta: **luna** (apellidos/variantes aceptadas).

---

## Instrucciones para ejecutar localmente
1. Descarga/copía todos los archivos en una carpeta (por ejemplo `escape-room/`).
2. Coloca imágenes en `assets/` con los nombres indicados:
   - `assets/castle.jpg` — 1200x700 px recomendado.
   - `assets/inscription.png` — imagen con texto distorsionado (1200x800 px recomendado).
   - `assets/ermita.jpg`, `assets/feria.jpg` — mismas dimensiones aproximadas.
   - `assets/favicon.ico` — 32x32 px.
3. Abre una terminal en la carpeta y ejecuta:
   ```bash
   php -S localhost:8000
