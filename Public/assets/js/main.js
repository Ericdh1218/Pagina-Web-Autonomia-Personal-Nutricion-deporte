document.addEventListener('DOMContentLoaded', (event) => {
    const menuButton = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");

    if (menuButton && menu) {
        menuButton.addEventListener("click", function () {
            menu.classList.toggle("hidden");
        });
    }
});

 function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }

// --- Calculadora de IMC (con manejo de errores en UI) ---
// En tu archivo assets/js/main.js

function calculateBMI() {
    const weightInput = document.getElementById("weight");
    const heightInput = document.getElementById("height");
    const resultDiv = document.getElementById("bmi-result");
    const valueEl = document.getElementById("bmi-value");
    const categoryEl = document.getElementById("bmi-category");

    // Validamos que los elementos existan antes de usarlos
    if (!weightInput || !heightInput || !resultDiv || !valueEl || !categoryEl) {
        console.error("Faltan elementos de la calculadora de IMC en el DOM.");
        return;
    }
    
    const weight = parseFloat(weightInput.value);
    const height = parseFloat(heightInput.value);

    if (weight > 0 && height > 0) {
        const bmi = (weight / (height / 100) ** 2).toFixed(1);
        valueEl.textContent = `Tu IMC: ${bmi}`;
        
        let category, colorClass;
        if (bmi < 18.5) {
            category = "Bajo peso";
            colorClass = "bg-blue-100 text-blue-800";
        } else if (bmi < 25) {
            category = "Peso normal";
            colorClass = "bg-green-100 text-green-800";
        } else if (bmi < 30) {
            category = "Sobrepeso";
            colorClass = "bg-yellow-100 text-yellow-800";
        } else {
            category = "Obesidad";
            colorClass = "bg-red-100 text-red-800";
        }
        categoryEl.textContent = category;
        resultDiv.className = `text-center p-4 rounded-lg mt-4 ${colorClass}`;
        resultDiv.classList.remove("hidden");

        // --- ESTA ES LA PARTE CLAVE QUE FALTABA ---
        // Verificamos si la variable global 'userIsLoggedIn' existe y es verdadera
        if (typeof userIsLoggedIn !== 'undefined' && userIsLoggedIn) {
            
            // Usamos la variable BASE para construir la URL correcta
            const url = `${BASE}index.php?r=guardar_imc`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ peso: weight, altura: height })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'ok') {
                    console.log('IMC guardado exitosamente en tu perfil.');
                    // Opcional: podrías mostrar una pequeña notificación de "Guardado"
                } else {
                    console.error('Error del servidor:', data.message);
                }
            })
            .catch(error => console.error('Error de red al intentar guardar el IMC:', error));
        }
        // --- FIN DE LA PARTE CLAVE ---

    } else {
        resultDiv.className = "text-center p-4 rounded-lg mt-4 bg-red-100 text-red-800";
        valueEl.textContent = "Por favor, introduce valores válidos.";
        categoryEl.textContent = "";
        resultDiv.classList.remove("hidden");
    }
}

// --- Plan de Comidas Toggle (con transición suave) ---
// --- Plan de Comidas Toggle (con transición suave y scroll) ---
function toggleMealPlan() {
  const mealPlan = document.getElementById("meal-plan");

  // Simplemente alterna la clase 'hidden' en el plan de comidas.
  mealPlan.classList.toggle("hidden");

  // EXTRA: Si el plan se está mostrando, hacemos scroll para que sea visible.
  if (!mealPlan.classList.contains("hidden")) {
    mealPlan.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

const workouts = {
  cardio: {
    title: "Rutina de Cardio - 30 minutos",
    exercises: [
      { name: "Saltos de tijera", duration: "3 min", icon: "🤸‍♂️" },
      { name: "Burpees", duration: "2 min", icon: "💥" },
      { name: "Mountain climbers", duration: "3 min", icon: "🏔️" },
      { name: "Saltos en el sitio", duration: "2 min", icon: "⬆️" },
      { name: "Descanso activo", duration: "1 min", icon: "😌" },
      { name: "Repetir circuito", duration: "3x", icon: "🔄" },
    ],
  },
  strength: {
    title: "Rutina de Fuerza - 45 minutos",
    exercises: [
      { name: "Flexiones", duration: "3x12", icon: "💪" },
      { name: "Sentadillas", duration: "3x15", icon: "🦵" },
      { name: "Plancha", duration: "3x30s", icon: "🏋️‍♂️" },
      { name: "Lunges", duration: "3x10", icon: "🚶‍♂️" },
      { name: "Abdominales", duration: "3x20", icon: "🔥" },
      { name: "Descanso", duration: "60s", icon: "⏱️" },
    ],
  },
  flexibility: {
    title: "Rutina de Flexibilidad - 20 minutos",
    exercises: [
      { name: "Estiramiento de cuello", duration: "2 min", icon: "🦒" },
      { name: "Rotación de hombros", duration: "2 min", icon: "🔄" },
      { name: "Estiramiento de espalda", duration: "3 min", icon: "🤸‍♀️" },
      { name: "Estiramiento de piernas", duration: "5 min", icon: "🦵" },
      { name: "Respiración profunda", duration: "3 min", icon: "🧘‍♀️" },
      { name: "Relajación final", duration: "5 min", icon: "😌" },
    ],
  },
};

function showWorkout(type) {
  const workout = workouts[type];
  const display = document.getElementById('workout-display');
  const title = document.getElementById('workout-title');
  const content = document.getElementById('workout-content');

  title.textContent = workout.title;
  content.innerHTML = workout.exercises.map(ex => `
    <div class="bg-white p-4 rounded-lg shadow-md text-center">
      <div class="text-3xl mb-2">${ex.icon}</div>
      <h4 class="font-semibold mb-1">${ex.name}</h4>
      <p class="text-gray-600">${ex.duration}</p>
    </div>
  `).join('');

  display.classList.remove('hidden');
  display.scrollIntoView({ behavior: 'smooth' });
}

function hideWorkout() {
  document.getElementById('workout-display').classList.add('hidden');
  stopTimer();
}

// --- Lógica de Cápsulas de Conocimiento ---
const facts = [
  {
    icon: "🏃‍♂️",
    text: "Hacer ejercicio durante solo 20 minutos puede mejorar tu memoria y capacidad de aprendizaje por hasta 2 horas.",
    category: "Beneficios del Ejercicio",
  },
  {
    icon: "🧠",
    text: "Tu cerebro consume ~20% de las calorías diarias aunque pesa ~2% de tu cuerpo.",
    category: "Datos Curiosos del Cuerpo",
  },
  {
    icon: "💪",
    text: "Los músculos tienen memoria: recuperar masa es más fácil que construirla por primera vez.",
    category: "Fisiología Muscular",
  },
  {
    icon: "🥗",
    text: "La manzana con cáscara aporta 4x más fibra y más antioxidantes que sin cáscara.",
    category: "Nutrición Inteligente",
  },
  {
    icon: "❤️",
    text: "El ejercicio regular puede reducir la frecuencia cardíaca en reposo.",
    category: "Salud Cardiovascular",
  },
  {
    icon: "🦴",
    text: "Tus huesos se renuevan en ~10 años; la fuerza acelera ese proceso.",
    category: "Salud Ósea",
  },
  {
    icon: "🍎",
    text: "Come un “arcoíris” de frutas y verduras para maximizar antioxidantes.",
    category: "Antioxidantes Naturales",
  },
  {
    icon: "😴",
    text: "En sueño profundo se eliminan toxinas, incl. proteínas asociadas al Alzheimer.",
    category: "Importancia del Descanso",
  },
  {
    icon: "🚶‍♂️",
    text: "Caminar después de comer puede reducir la glucosa en sangre hasta 30%.",
    category: "Actividad Post-Comida",
  },
  {
    icon: "🥑",
    text: "El aguacate es fruta y tiene más potasio que el plátano.",
    category: "Datos Nutricionales",
  },
  {
    icon: "💧",
    text: "Perder 2% de agua corporal afecta rendimiento físico y mental.",
    category: "Hidratación",
  },
  {
    icon: "🏋️‍♀️",
    text: "La fuerza puede elevar tu metabolismo basal por ~24 horas.",
    category: "Metabolismo",
  },
];

let currentFactIndex = 0;
function nextFact() {
  currentFactIndex = (currentFactIndex + 1) % facts.length;
  const fact = facts[currentFactIndex];
  document.getElementById('fact-icon').textContent = fact.icon;
  document.getElementById('fact-text').textContent = fact.text;
  document.getElementById('fact-category').textContent = fact.category;

  const display = document.getElementById('fact-display');
  display.style.opacity = '0';
  setTimeout(() => { display.style.opacity = '1'; }, 150);
}

// ------- Timer -------
let timerInterval;
let seconds = 0;

function startTimer() {
  const startBtn = document.getElementById('start-timer');
  const timerDisplay = document.getElementById('timer-display');
  const timer = document.getElementById('timer');

  startBtn.classList.add('hidden');
  timerDisplay.classList.remove('hidden');

  timerInterval = setInterval(() => {
    seconds++;
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    timer.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  }, 1000);
}

function stopTimer() {
  if (timerInterval) {
    clearInterval(timerInterval);
    timerInterval = null;
  }
  seconds = 0;
  document.getElementById('start-timer').classList.remove('hidden');
  document.getElementById('timer-display').classList.add('hidden');
  document.getElementById('timer').textContent = '00:00';
}

// En assets/js/main.js

function calculateMacros() {
    // 1. Obtener todos los valores del formulario
    const age = parseFloat(document.getElementById('calc-age').value);
    const gender = document.getElementById('calc-gender').value;
    const weight = parseFloat(document.getElementById('calc-weight').value);
    const height = parseFloat(document.getElementById('calc-height').value);
    const activityLevel = parseFloat(document.getElementById('calc-activity').value);
    const goal = document.getElementById('calc-goal').value;

    const resultsDiv = document.getElementById('macro-results');

    // 2. Validar que todos los campos estén llenos
    if (!age || !weight || !height) {
        alert('Por favor, llena todos los campos.');
        return;
    }

    // 3. Calcular el Metabolismo Basal (BMR) con la fórmula de Mifflin-St Jeor
    let bmr;
    if (gender === 'male') {
        bmr = 10 * weight + 6.25 * height - 5 * age + 5;
    } else { // female
        bmr = 10 * weight + 6.25 * height - 5 * age - 161;
    }

    // 4. Calcular las calorías de mantenimiento (TDEE)
    const tdee = bmr * activityLevel;

    // 5. Ajustar calorías según el objetivo
    let finalCalories;
    switch (goal) {
        case 'lose':
            finalCalories = tdee - 500; // Déficit de 500 kcal
            break;
        case 'gain':
            finalCalories = tdee + 500; // Superávit de 500 kcal
            break;
        case 'maintain':
        default:
            finalCalories = tdee;
            break;
    }

    // 6. Calcular los macronutrientes (distribución 40% Proteína, 40% Carbs, 20% Grasa)
    const proteinGrams = Math.round((finalCalories * 0.40) / 4);
    const carbsGrams = Math.round((finalCalories * 0.40) / 4);
    const fatsGrams = Math.round((finalCalories * 0.20) / 9);

    // 7. Mostrar los resultados en el HTML
    document.getElementById('result-calories').textContent = finalCalories.toFixed(0) + ' kcal';
    document.getElementById('result-protein').textContent = proteinGrams + ' g';
    document.getElementById('result-carbs').textContent = carbsGrams + ' g';
    document.getElementById('result-fats').textContent = fatsGrams + ' g';

    // Hacer visible la sección de resultados y hacer scroll hacia ella
    resultsDiv.classList.remove('hidden');
    resultsDiv.scrollIntoView({ behavior: 'smooth' });
}

// =============================================
// LÓGICA DEL CRONÓMETRO DE INTERVALOS (HIIT)
// =============================================

// Variables globales para el estado del timer (con prefijo 'hiit')
let hiitTimerInterval = null;
let hiitTotalSeconds = 0;
let hiitWorkSeconds, hiitRestSeconds, hiitTotalRounds, hiitCurrentRound;
let hiitCurrentState = ''; // 'PREP', 'WORK', 'REST', 'DONE'
let hiitIsPaused = false;

// Elementos del DOM
const hiitStatusDisplay = document.getElementById('timer-status');
const hiitTimerDisplay = document.getElementById('timer-display');
const hiitRoundsDisplay = document.getElementById('timer-rounds');
const hiitStartBtn = document.getElementById('start-btn');
const hiitPauseBtn = document.getElementById('pause-btn');
const hiitResetBtn = document.getElementById('reset-btn');

// Sonido para las transiciones
function playHiitSound(type = 'single') {
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    if (!audioContext) return; // Si el navegador no soporta AudioContext, no hacer nada.
    
    const oscillator = audioContext.createOscillator();
    const gainNode = audioContext.createGain();
    
    oscillator.connect(gainNode);
    gainNode.connect(audioContext.destination);
    
    oscillator.type = 'sine';
    gainNode.gain.setValueAtTime(0.5, audioContext.currentTime);

    if (type === 'double') {
        oscillator.frequency.setValueAtTime(880, audioContext.currentTime);
        oscillator.start();
        oscillator.stop(audioContext.currentTime + 0.1);
        
        // Creamos un segundo oscilador para el segundo beep
        const osc2 = audioContext.createOscillator();
        const gain2 = audioContext.createGain();
        osc2.connect(gain2);
        gain2.connect(audioContext.destination);
        osc2.frequency.setValueAtTime(880, audioContext.currentTime + 0.2);
        gain2.gain.setValueAtTime(0.5, audioContext.currentTime + 0.2);
        osc2.start(audioContext.currentTime + 0.2);
        osc2.stop(audioContext.currentTime + 0.3);

    } else {
        oscillator.frequency.setValueAtTime(440, audioContext.currentTime);
        oscillator.start();
        oscillator.stop(audioContext.currentTime + 0.2);
    }
}


// Función principal que se ejecuta cada segundo
function updateHiitTimer() {
    if (hiitIsPaused) return;

    hiitTotalSeconds--;
    
    const minutes = Math.floor(hiitTotalSeconds / 60).toString().padStart(2, '0');
    const seconds = (hiitTotalSeconds % 60).toString().padStart(2, '0');
    hiitTimerDisplay.textContent = `${minutes}:${seconds}`;

    if (hiitTotalSeconds <= 0) {
        if (hiitCurrentState === 'WORK') {
            playHiitSound('double');
            hiitCurrentState = 'REST';
            hiitStatusDisplay.textContent = 'DESCANSO';
            hiitStatusDisplay.classList.remove('text-green-400');
            hiitStatusDisplay.classList.add('text-blue-400');
            hiitTotalSeconds = hiitRestSeconds;
        } else if (hiitCurrentState === 'REST') {
            hiitCurrentRound++;
            if (hiitCurrentRound > hiitTotalRounds) {
                clearInterval(hiitTimerInterval);
                hiitTimerInterval = null;
                hiitCurrentState = 'DONE';
                hiitStatusDisplay.textContent = '¡Terminado!';
                hiitStatusDisplay.classList.remove('text-green-400', 'text-blue-400');
                playHiitSound('double');
                hiitResetBtn.disabled = false;
                hiitPauseBtn.disabled = true;
                return;
            }
            playHiitSound('single');
            hiitCurrentState = 'WORK';
            hiitStatusDisplay.textContent = '¡TRABAJO!';
            hiitStatusDisplay.classList.remove('text-blue-400');
            hiitStatusDisplay.classList.add('text-green-400');
            hiitTotalSeconds = hiitWorkSeconds;
            hiitRoundsDisplay.textContent = `Ronda ${hiitCurrentRound} / ${hiitTotalRounds}`;
        } else if (hiitCurrentState === 'PREP') {
            playHiitSound('single');
            hiitCurrentState = 'WORK';
            hiitStatusDisplay.textContent = '¡TRABAJO!';
            hiitStatusDisplay.classList.add('text-green-400');
            hiitTotalSeconds = hiitWorkSeconds;
            hiitRoundsDisplay.textContent = `Ronda ${hiitCurrentRound} / ${hiitTotalRounds}`;
        }
    }
}

// Controles del Cronómetro (con nombres de función únicos)
function startHiitTimer() {
    if (hiitTimerInterval) return;

    hiitWorkSeconds = parseInt(document.getElementById('work-time').value) || 20;
    hiitRestSeconds = parseInt(document.getElementById('rest-time').value) || 10;
    hiitTotalRounds = parseInt(document.getElementById('rounds').value) || 8;
    hiitCurrentRound = 1;
    hiitIsPaused = false;
    
    hiitCurrentState = 'PREP';
    hiitStatusDisplay.textContent = 'PREPARACIÓN';
    hiitTotalSeconds = 10;
    hiitRoundsDisplay.textContent = `Ronda ${hiitCurrentRound} / ${hiitTotalRounds}`;

    hiitTimerInterval = setInterval(updateHiitTimer, 1000);
    
    hiitStartBtn.disabled = true;
    hiitPauseBtn.disabled = false;
    hiitResetBtn.disabled = false;
    hiitPauseBtn.textContent = 'Pausar';
}

function pauseHiitTimer() {
    if (!hiitTimerInterval || hiitCurrentState === 'DONE') return;
    
    hiitIsPaused = !hiitIsPaused;
    if (hiitIsPaused) {
        hiitPauseBtn.textContent = 'Reanudar';
        hiitStatusDisplay.textContent = 'PAUSADO';
    } else {
        hiitPauseBtn.textContent = 'Pausar';
        hiitStatusDisplay.textContent = hiitCurrentState === 'WORK' ? '¡TRABAJO!' : 'DESCANSO';
    }
}

function resetHiitTimer() {
    clearInterval(hiitTimerInterval);
    hiitTimerInterval = null;
    hiitIsPaused = false;

    hiitStatusDisplay.textContent = 'Presiona Iniciar';
    hiitTimerDisplay.textContent = '00:00';
    hiitRoundsDisplay.textContent = 'Ronda 0 / 0';
    hiitStatusDisplay.classList.remove('text-green-400', 'text-blue-400');
    
    hiitStartBtn.disabled = false;
    hiitPauseBtn.disabled = true;
    hiitResetBtn.disabled = true;
    hiitPauseBtn.textContent = 'Pausar';
}

// =============================================
// LÓGICA DE LA CALCULADORA DE 1RM
// =============================================

function calculate1RM() {
    // 1. Obtener los valores del formulario
    const weight = parseFloat(document.getElementById('1rm-weight').value);
    const reps = parseInt(document.getElementById('1rm-reps').value);
    const resultsDiv = document.getElementById('1rm-results');
    const oneRepMaxValue = document.getElementById('1rm-value');
    const percentagesDiv = document.getElementById('1rm-percentages');

    // 2. Validar
    if (!weight || !reps || weight <= 0 || reps <= 0) {
        alert('Por favor, introduce un peso y un número de repeticiones válidos.');
        return;
    }
    if (reps === 1) {
        alert('Si solo hiciste 1 repetición, ¡ese es tu 1RM!');
        oneRepMaxValue.textContent = weight.toFixed(1) + ' kg';
        resultsDiv.classList.remove('hidden');
        return;
    }

    // 3. Calcular el 1RM con la fórmula de Brzycki
    const oneRepMax = weight / (1.0278 - (0.0278 * reps));

    // 4. Mostrar el resultado principal
    oneRepMaxValue.textContent = oneRepMax.toFixed(1) + ' kg';

    // 5. Generar y mostrar la tabla de porcentajes
    percentagesDiv.innerHTML = ''; // Limpiar resultados anteriores
    const percentages = [
        { p: 95, label: 'Fuerza Máxima (1-2 reps)' },
        { p: 85, label: 'Fuerza (3-5 reps)' },
        { p: 75, label: 'Hipertrofia (8-12 reps)' },
        { p: 65, label: 'Resistencia (12-15 reps)' },
        { p: 50, label: 'Calentamiento (15+ reps)' }
    ];

    percentages.forEach(item => {
        const percentageWeight = (oneRepMax * (item.p / 100)).toFixed(1);
        const html = `
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                <div class="font-semibold text-gray-800">${item.p}% de 1RM</div>
                <div class="text-gray-600">${item.label}</div>
                <div class="font-bold text-violet-600 text-lg">${percentageWeight} kg</div>
            </div>
        `;
        percentagesDiv.innerHTML += html;
    });

    // 6. Mostrar la sección de resultados
    resultsDiv.classList.remove('hidden');
    resultsDiv.scrollIntoView({ behavior: 'smooth' });
}
// =======================================================
// LÓGICA DEL BUSCADOR DE SUSTITUTOS DE EJERCICIOS
// =======================================================

function findSubstitutes() {
    const searchInput = document.getElementById('exercise-search');
    const resultsDiv = document.getElementById('substitute-results');
    const substitutesList = document.getElementById('substitutes-list');
    
    const searchTerm = searchInput.value.toLowerCase().trim();

    // Si no hay texto, ocultar los resultados
    if (searchTerm.length < 3) {
        resultsDiv.classList.add('hidden');
        return;
    }

    // 1. Encontrar el ejercicio que el usuario está buscando
    const originalExercise = todosLosEjercicios.find(
        ex => ex.nombre.toLowerCase().includes(searchTerm)
    );

    // Si no se encuentra el ejercicio original, no hacer nada
    if (!originalExercise) {
        resultsDiv.classList.add('hidden');
        return;
    }

    // 2. Filtrar la lista para encontrar sustitutos
    const substitutes = todosLosEjercicios.filter(ex => 
        // Un sustituto es un ejercicio que:
        // - Trabaja el mismo grupo muscular
        // - Y NO es el mismo ejercicio que el original
        ex.grupo_muscular === originalExercise.grupo_muscular && 
        ex.id !== originalExercise.id
    );

    // 3. Mostrar los resultados
    substitutesList.innerHTML = ''; // Limpiar la lista

    if (substitutes.length > 0) {
        substitutes.forEach(sub => {
            const html = `
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg border">
                    <img src="${BASE}assets/img/${sub.media_url || 'placeholder.jpg'}" alt="${sub.nombre}" class="w-16 h-16 object-contain rounded-md">
                    <div>
                        <p class="font-semibold text-lg text-gray-800">${sub.nombre}</p>
                        <span class="text-sm bg-gray-200 text-gray-700 px-2 py-1 rounded-full">${sub.equipamiento}</span>
                    </div>
                </div>
            `;
            substitutesList.innerHTML += html;
        });
        resultsDiv.classList.remove('hidden');
    } else {
        substitutesList.innerHTML = '<p class="text-gray-500">No se encontraron sustitutos para este grupo muscular.</p>';
        resultsDiv.classList.remove('hidden');
    }
}

// ===================================
// LÓGICA DEL DIARIO DE HÁBITOS
// ===================================
document.addEventListener('DOMContentLoaded', () => {
    const habitsList = document.getElementById('habits-list');
    if (habitsList) {
        habitsList.addEventListener('change', (e) => {
            if (e.target.type === 'checkbox') {
                saveHabits();
            }
        });
    }
});

function saveHabits() {
    const feedback = document.getElementById('habits-feedback');
    const fecha = document.getElementById('habits-date').value;
    const checkboxes = document.querySelectorAll('#habits-list input[type="checkbox"]');
    
    let habitsData = { fecha: fecha };
    checkboxes.forEach(cb => {
        habitsData[cb.getAttribute('data-habito')] = cb.checked;
    });

    feedback.textContent = 'Guardando...';

    fetch(`${BASE}index.php?r=guardar_habitos`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(habitsData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'ok') {
            feedback.textContent = 'Guardado ✓';
        } else {
            feedback.textContent = 'Error al guardar.';
        }
        setTimeout(() => feedback.textContent = '', 2000); // Limpiar mensaje después de 2 segundos
    })
    .catch(error => {
        feedback.textContent = 'Error de conexión.';
        setTimeout(() => feedback.textContent = '', 2000);
    });
}

// ===================================
// LÓGICA DEL REGISTRO DE MEDIDAS
// ===================================
// ===================================
// LÓGICA DEL REGISTRO DE MEDIDAS (CON MENSAJES EN PANTALLA)
// ===================================
function saveMeasurements() {
    const fecha = document.getElementById('medida-fecha').value;
    const peso = document.getElementById('medida-peso').value;
    const cintura = document.getElementById('medida-cintura').value;
    const cadera = document.getElementById('medida-cadera').value;
    const pecho = null; // No lo tenemos en el form, lo enviamos como null
    
    const feedbackDiv = document.getElementById('measurement-feedback');

    // Función auxiliar para mostrar mensajes
    const showFeedback = (message, isError = false) => {
        const colorClasses = isError 
            ? 'bg-red-100 border-red-300 text-red-800' 
            : 'bg-green-100 border-green-300 text-green-800';
        
        feedbackDiv.innerHTML = `<div class="${colorClasses} p-3 rounded-lg border">${message}</div>`;
        
        // El mensaje desaparece después de 3 segundos
        setTimeout(() => {
            feedbackDiv.innerHTML = '';
        }, 3000);
    };

    // Validación
    if (!fecha || !peso) {
        showFeedback('La fecha y el peso son obligatorios.', true); // Mensaje de error
        return;
    }

    const data = { fecha, peso, cintura, cadera, pecho };
    
    // Muestra "Guardando..."
    feedbackDiv.innerHTML = `<div class="bg-blue-100 p-3 rounded-lg">Guardando...</div>`;

    fetch(`${BASE}index.php?r=guardar_medidas`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'ok') {
            showFeedback('¡Medidas guardadas correctamente!'); // Mensaje de éxito
            // Opcional: recargar la página para ver la tabla actualizada después de un momento.
            setTimeout(() => window.location.reload(), 1500); 
        } else {
            showFeedback('Hubo un error al guardar las medidas.', true);
        }
    })
    .catch(error => {
        showFeedback('Error de conexión al guardar.', true);
    });
}