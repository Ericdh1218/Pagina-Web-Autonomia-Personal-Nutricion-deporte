<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VitaBalance - Autonomía Personal en Nutrición y Deporte</title>

  <!-- Tailwind (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fuente y tu CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/main.css">
</head>
<body class="bg-gray-50">
  <!-- Header -->
  <header class="gradient-bg text-white shadow-lg">
    <nav class="container mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
          <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
            <span class="text-2xl">🌟</span>
          </div>
          <h1 class="text-2xl font-bold">VitaBalance</h1>
        </div>
        <div class="hidden md:flex space-x-6">
          <a href="#inicio" class="hover:text-blue-200 transition-colors">Inicio</a>
          <a href="#nutricion" class="hover:text-blue-200 transition-colors">Nutrición</a>
          <a href="#deporte" class="hover:text-blue-200 transition-colors">Deporte</a>
          <a href="#herramientas" class="hover:text-blue-200 transition-colors">Herramientas</a>
        </div>
        <button class="md:hidden text-white" aria-label="Abrir menú">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </nav>
  </header>

  <section id="inicio" class="gradient-bg text-white py-20">
    <div class="container mx-auto px-6 text-center">
      <h2 class="text-5xl font-bold mb-6 animate-fade-in">Tu Autonomía Personal Comienza Aquí</h2>
      <p class="text-xl mb-8 max-w-3xl mx-auto animate-fade-in">Desarrolla hábitos saludables en nutrición y deporte para alcanzar tu máximo potencial y vivir de forma independiente.</p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in">
        <button onclick="scrollToSection('nutricion')" class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
          🥗 Explorar Nutrición
        </button>
        <button onclick="scrollToSection('deporte')" class="bg-transparent border-2 border-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition-colors">
          🏃‍♂️ Descubrir Deporte
        </button>
      </div>
    </div>
  </section>

  <!-- Estadísticas -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="card-hover bg-gradient-to-br from-green-400 to-green-600 text-white p-8 rounded-xl">
          <div class="text-4xl mb-4">🎯</div>
          <h3 class="text-3xl font-bold mb-2" id="goals-counter">0</h3>
          <p class="text-green-100">Objetivos Alcanzables</p>
        </div>
        <div class="card-hover bg-gradient-to-br from-blue-400 to-blue-600 text-white p-8 rounded-xl">
          <div class="text-4xl mb-4">💪</div>
          <h3 class="text-3xl font-bold mb-2" id="exercises-counter">0</h3>
          <p class="text-blue-100">Ejercicios Disponibles</p>
        </div>
        <div class="card-hover bg-gradient-to-br from-orange-400 to-orange-600 text-white p-8 rounded-xl">
          <div class="text-4xl mb-4">🍎</div>
          <h3 class="text-3xl font-bold mb-2" id="recipes-counter">0</h3>
          <p class="text-orange-100">Recetas Saludables</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Nutrición -->
  <section id="nutricion" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">🥗 Nutrición Inteligente</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Aprende a alimentarte de forma consciente y desarrolla autonomía en tus decisiones nutricionales.</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <div class="space-y-6">
            <div class="card-hover bg-white p-6 rounded-xl shadow-md">
              <div class="flex items-center mb-4">
                <span class="text-2xl mr-3">🍽️</span>
                <h3 class="text-xl font-semibold">Planificación de Comidas</h3>
              </div>
              <p class="text-gray-600 mb-4">Organiza tus comidas semanales de forma equilibrada y práctica.</p>
              <button onclick="toggleMealPlan()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                Ver Plan Semanal
              </button>
            </div>

            <div class="card-hover bg-white p-6 rounded-xl shadow-md">
              <div class="flex items-center mb-4">
                <span class="text-2xl mr-3">📊</span>
                <h3 class="text-xl font-semibold">Seguimiento Nutricional</h3>
              </div>
              <p class="text-gray-600 mb-4">Monitorea tu ingesta diaria de nutrientes esenciales.</p>
              <div class="space-y-3">
                <div>
                  <div class="flex justify-between text-sm mb-1">
                    <span>Proteínas</span><span>75%</span>
                  </div>
                  <div class="bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full progress-bar" style="width: 75%"></div>
                  </div>
                </div>
                <div>
                  <div class="flex justify-between text-sm mb-1">
                    <span>Carbohidratos</span><span>60%</span>
                  </div>
                  <div class="bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full progress-bar" style="width: 60%"></div>
                  </div>
                </div>
                <div>
                  <div class="flex justify-between text-sm mb-1">
                    <span>Grasas Saludables</span><span>85%</span>
                  </div>
                  <div class="bg-gray-200 rounded-full h-2">
                    <div class="bg-orange-500 h-2 rounded-full progress-bar" style="width: 85%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-hover bg-white p-8 rounded-xl shadow-lg">
          <h3 class="text-2xl font-bold mb-6 text-center">Calculadora de IMC</h3>
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Peso (kg)</label>
              <input type="number" id="weight" placeholder="70" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Altura (cm)</label>
              <input type="number" id="height" placeholder="175" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <button onclick="calculateBMI()" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition-colors font-semibold">
              Calcular IMC
            </button>
            <div id="bmi-result" class="text-center p-4 rounded-lg hidden">
              <div class="text-2xl font-bold mb-2" id="bmi-value"></div>
              <div class="text-sm" id="bmi-category"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Plan de Comidas -->
  <div id="meal-plan" class="hidden bg-white border-t-4 border-green-500 mx-6 rounded-lg shadow-lg p-6 mb-8">
    <h4 class="text-xl font-bold mb-4">Plan de Comidas Semanal</h4>
    <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
      <!-- … contenido igual al tuyo … -->
      <div class="text-center">
        <h5 class="font-semibold mb-2">Lunes</h5>
        <div class="text-sm space-y-1">
          <div>🌅 Avena con frutas</div>
          <div>🌞 Ensalada de pollo</div>
          <div>🌙 Salmón con verduras</div>
        </div>
      </div>
      <!-- Repite para Martes… Domingo -->
    </div>
  </div>

  <!-- Deporte -->
  <section id="deporte" class="py-20 bg-white">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">🏃‍♂️ Actividad Física Personalizada</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Desarrolla tu independencia física con rutinas adaptadas a tu nivel y objetivos.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="card-hover bg-gradient-to-br from-red-400 to-red-600 text-white p-6 rounded-xl text-center">
          <div class="text-4xl mb-4">🔥</div>
          <h3 class="text-xl font-bold mb-2">Cardio</h3>
          <p class="mb-4">Mejora tu resistencia cardiovascular</p>
          <button onclick="showWorkout('cardio')" class="bg-white text-red-600 px-4 py-2 rounded-full font-semibold hover:bg-gray-100 transition-colors">Ver Rutina</button>
        </div>

        <div class="card-hover bg-gradient-to-br from-purple-400 to-purple-600 text-white p-6 rounded-xl text-center">
          <div class="text-4xl mb-4">💪</div>
          <h3 class="text-xl font-bold mb-2">Fuerza</h3>
          <p class="mb-4">Desarrolla tu masa muscular</p>
          <button onclick="showWorkout('strength')" class="bg-white text-purple-600 px-4 py-2 rounded-full font-semibold hover:bg-gray-100 transition-colors">Ver Rutina</button>
        </div>

        <div class="card-hover bg-gradient-to-br from-teal-400 to-teal-600 text-white p-6 rounded-xl text-center">
          <div class="text-4xl mb-4">🧘‍♀️</div>
          <h3 class="text-xl font-bold mb-2">Flexibilidad</h3>
          <p class="mb-4">Aumenta tu movilidad y bienestar</p>
          <button onclick="showWorkout('flexibility')" class="bg-white text-teal-600 px-4 py-2 rounded-full font-semibold hover:bg-gray-100 transition-colors">Ver Rutina</button>
        </div>
      </div>

      <div id="workout-display" class="hidden bg-gray-50 p-8 rounded-xl">
        <div class="flex justify-between items-center mb-6">
          <h3 id="workout-title" class="text-2xl font-bold"></h3>
          <button onclick="hideWorkout()" class="text-gray-500 hover:text-gray-700" aria-label="Cerrar rutina">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div id="workout-content" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
        <div class="mt-6 text-center">
          <button onclick="startTimer()" id="start-timer" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors font-semibold">Iniciar Entrenamiento</button>
          <div id="timer-display" class="hidden mt-4">
            <div class="text-3xl font-bold text-blue-600" id="timer">00:00</div>
            <button onclick="stopTimer()" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">Detener</button>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Cápsulas -->
  <section class="py-20 bg-gradient-to-br from-indigo-50 to-purple-50">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">💡 Cápsulas de Conocimiento</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Descubre datos fascinantes y consejos prácticos sobre nutrición y ejercicio.</p>
      </div>

      <!-- Rotador de datos -->
      <div class="mb-16">
        <div class="card-hover bg-white p-8 rounded-2xl shadow-lg max-w-4xl mx-auto">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">🧠 ¿Sabías que...?</h3>
            <button onclick="nextFact()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">Siguiente dato</button>
          </div>
          <div id="fact-display" class="text-center">
            <div class="text-6xl mb-4" id="fact-icon">🏃‍♂️</div>
            <p class="text-lg text-gray-700 leading-relaxed" id="fact-text">
              Hacer ejercicio durante solo 20 minutos puede mejorar tu memoria y capacidad de aprendizaje por hasta 2 horas.
            </p>
            <div class="mt-4 text-sm text-gray-500" id="fact-category">Beneficios del Ejercicio</div>
          </div>
        </div>
      </div>

      <!-- Beneficios (deporte y alimentación) -->
      <!-- … (tu mismo contenido, sin cambios de lógica) … -->

      <!-- Consejos rápidos -->
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <h3 class="text-2xl font-bold text-center mb-8">🎯 Consejos Rápidos del Día</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="text-center p-4 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl">
            <div class="text-3xl mb-3">🌅</div>
            <h4 class="font-semibold mb-2">Mañana</h4>
            <p class="text-sm text-gray-700">Bebe un vaso de agua al despertar para activar tu metabolismo</p>
          </div>
          <div class="text-center p-4 bg-gradient-to-br from-green-100 to-green-200 rounded-xl">
            <div class="text-3xl mb-3">🥗</div>
            <h4 class="font-semibold mb-2">Alimentación</h4>
            <p class="text-sm text-gray-700">Llena la mitad de tu plato con vegetales de colores variados</p>
          </div>
          <div class="text-center p-4 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl">
            <div class="text-3xl mb-3">🚶‍♂️</div>
            <h4 class="font-semibold mb-2">Movimiento</h4>
            <p class="text-sm text-gray-700">Camina 10,000 pasos diarios para mantener tu salud cardiovascular</p>
          </div>
          <div class="text-center p-4 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl">
            <div class="text-3xl mb-3">😴</div>
            <h4 class="font-semibold mb-2">Descanso</h4>
            <p class="text-sm text-gray-700">Duerme 7-9 horas para optimizar la recuperación muscular</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
              <span class="text-lg">🌟</span>
            </div>
            <h3 class="text-xl font-bold">VitaBalance</h3>
          </div>
          <p class="text-gray-400">Tu compañero en el camino hacia la autonomía personal en salud y bienestar.</p>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Nutrición</h4>
          <ul class="space-y-2 text-gray-400">
            <li><a href="#" class="hover:text-white transition-colors">Planes de Alimentación</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Recetas Saludables</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Calculadoras</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Deporte</h4>
          <ul class="space-y-2 text-gray-400">
            <li><a href="#" class="hover:text-white transition-colors">Rutinas de Ejercicio</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Seguimiento</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Consejos</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Contacto</h4>
          <ul class="space-y-2 text-gray-400">
            <li>📧 info@vitabalance.com</li>
            <li>📱 +34 123 456 789</li>
            <li>🌐 www.vitabalance.com</li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
        <p>&copy; 2024 VitaBalance. Todos los derechos reservados. Diseñado para promover la autonomía personal.</p>
      </div>
    </div>
  </footer>

  <!-- Tu JS -->
  <script src="./assets/js/main.js"></script>
</body>
</html>
