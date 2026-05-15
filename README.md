# 🍏 NutriBot AI - Generador de Dietas Inteligentes

NutriBot es una plataforma web innovadora desarrollada con el framework **Laravel (PHP)** que integra **Inteligencia Artificial** de última generación para ofrecer asesoría nutricional personalizada. El sistema no solo realiza cálculos matemáticos biométricos, sino que mantiene conversaciones contextuales con el usuario para ajustar sus planes alimenticios.

## 🚀 Características Principales

*   **Autenticación de Usuarios:** Sistema seguro de Registro e Inicio de sesión mediante Laravel Breeze.
*   **Cálculo Metabólico de Precisión:** Implementación algorítmica de la fórmula de **Mifflin-St Jeor** para determinar el TDEE (Gasto Energético Total Diario).
*   **Integración con Google Gemini AI:** Consumo de la API Generative Language para la creación de planes nutricionales estructurados en formato **JSON**.
*   **ChatBot con Memoria (Contextual):** Capacidad única para seguir conversando con la IA sobre una dieta específica almacenada en la base de datos.
*   **Historial de Dietas Privado:** Gestión completa (CRUD) donde el usuario puede revisar, descargar o eliminar sus registros pasados.
*   **Exportación a PDF:** Motor de generación de documentos físicos mediante la librería **DomPDF**.
*   **Interfaz Innovadora:** Diseño responsivo y moderno basado en estilos **Glassmorphism**, utilizando Bootstrap 5 y Poppins Typography.
*   **API REST Preparada:** Exposición de endpoints (`/api/resultados`) listos para ser consumidos por aplicaciones móviles.

## 🛠️ Tecnologías Utilizadas

*   **Backend:** PHP 8.2+ | Framework Laravel 11.
*   **Frontend:** HTML5, CSS3, JavaScript (jQuery), Bootstrap 5.
*   **Base de Datos:** MySQL / MariaDB (Gestionada por Eloquent ORM).
*   **Inteligencia Artificial:** Google Gemini AI API (v1beta).
*   **Arquitectura:** Modelo-Vista-Controlador (MVC).
*   **Comunicación:** AJAX asíncrono para una experiencia de Single Page Application (SPA).

## ⚙️ Instalación y Configuración

Para correr este proyecto en tu entorno local, sigue estos pasos:

1. **Clonar el repositorio:**
 git clone https://github.com/tu-usuario/nutribot-laravel.git
cd nutribot-laravel
   
Instalar dependencias de PHP:
composer install
Configurar el archivo de entorno:
Renombrar .env.example a .env.
Configurar los accesos de tu base de datos local.
Agregar tu llave de Google AI: GEMINI_API_KEY=tu_llave_aqui.

Configurar Laravel:
php artisan key:generate
php artisan migrate:fresh
php artisan route:clear

Instalar y compilar Assets (Node.js):
npm install
npm run dev

Iniciar el servidor:
php artisan serve
📱 Consumo Móvil (API)
El sistema cuenta con un canal de datos abierto para aplicaciones externas:
Endpoint: GET /api/resultados
Formato: JSON puro conteniendo biometría y dietas procesadas.
