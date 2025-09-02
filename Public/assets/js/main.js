// ------- Contadores animados -------
function animateCounter(elementId, target, duration = 2000) {
  const element = document.getElementById(elementId);
  const start = 0;
  const increment = target / (duration / 16);
  let current = start;

  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    element.textContent = Math.floor(current);
  }, 16);
}

window.addEventListener('load', () => {
  animateCounter('goals-counter', 50);
  animateCounter('exercises-counter', 120);
  animateCounter('recipes-counter', 200);
});

// ------- Navegación suave -------
function scrollToSection(sectionId) {
  document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
}

// ------- Calculadora IMC -------
function calculateBMI() {
  const weight = parseFloat(document.getElementById('weight').value);
  const height = parseFloat(document.getElementById('height').value) / 100; // cm → m

  if (!weight || !height) {
    alert('Por favor, ingresa valores válidos para peso y altura.');
    return;
  }

  const bmi = weight / (height * height);
  const resultDiv = document.getElementById('bmi-result');
  const valueDiv = document.getElementById('bmi-value');
  const categoryDiv = document.getElementById('bmi-category');

  valueDiv.textContent = bmi.toFixed(1);

  let category, color;
  if (bmi < 18.5) {
    category = 'Bajo peso';
    color = 'bg-blue-100 text-blue-800';
  } else if (bmi < 25) {
    category = 'Peso normal';
    color = 'bg-green-100 text-green-800';
  } else if (bmi < 30) {
    category = 'Sobrepeso';
    color = 'bg-yellow-100 text-yellow-800';
  } else {
    category = 'Obesidad';
    color = 'bg-red-100 text-red-800';
  }

  categoryDiv.textContent = category;
  resultDiv.className = `text-center p-4 rounded-lg ${color}`;
  resultDiv.classList.remove('hidden');
}

// ------- Mostrar/ocultar plan semanal -------
function toggleMealPlan() {
  const mealPlan = document.getElementById('meal-plan');
  mealPlan.classList.toggle('hidden');
}

// ------- Rutinas de ejercicio -------
const workouts = {
  cardio: {
    title: 'Rutina de Cardio - 30 minutos',
    exercises: [
      { name: 'Saltos de tijera', duration: '3 min', icon: '🤸‍♂️' },
      { name: 'Burpees', duration: '2 min', icon: '💥' },
      { name: 'Mountain climbers', duration: '3 min', icon: '🏔️' },
      { name: 'Saltos en el sitio', duration: '2 min', icon: '⬆️' },
      { name: 'Descanso activo', duration: '1 min', icon: '😌' },
      { name: 'Repetir circuito', duration: '3x', icon: '🔄' }
    ]
  },
  strength: {
    title: 'Rutina de Fuerza - 45 minutos',
    exercises: [
      { name: 'Flexiones', duration: '3x12', icon: '💪' },
      { name: 'Sentadillas', duration: '3x15', icon: '🦵' },
      { name: 'Plancha', duration: '3x30s', icon: '🏋️‍♂️' },
      { name: 'Lunges', duration: '3x10', icon: '🚶‍♂️' },
      { name: 'Abdominales', duration: '3x20', icon: '🔥' },
      { name: 'Descanso', duration: '60s', icon: '⏱️' }
    ]
  },
  flexibility: {
    title: 'Rutina de Flexibilidad - 20 minutos',
    exercises: [
      { name: 'Estiramiento de cuello', duration: '2 min', icon: '🦒' },
      { name: 'Rotación de hombros', duration: '2 min', icon: '🔄' },
      { name: 'Estiramiento de espalda', duration: '3 min', icon: '🤸‍♀️' },
      { name: 'Estiramiento de piernas', duration: '5 min', icon: '🦵' },
      { name: 'Respiración profunda', duration: '3 min', icon: '🧘‍♀️' },
      { name: 'Relajación final', duration: '5 min', icon: '😌' }
    ]
  }
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

// ------- Rotador de datos -------
const facts = [
  { icon: '🏃‍♂️', text: 'Hacer ejercicio durante solo 20 minutos puede mejorar tu memoria y capacidad de aprendizaje por hasta 2 horas.', category: 'Beneficios del Ejercicio' },
  { icon: '🧠', text: 'Tu cerebro consume ~20% de las calorías diarias aunque pesa ~2% de tu cuerpo.', category: 'Datos Curiosos del Cuerpo' },
  { icon: '💪', text: 'Los músculos tienen memoria: recuperar masa es más fácil que construirla por primera vez.', category: 'Fisiología Muscular' },
  { icon: '🥗', text: 'La manzana con cáscara aporta 4x más fibra y más antioxidantes que sin cáscara.', category: 'Nutrición Inteligente' },
  { icon: '❤️', text: 'El ejercicio regular puede reducir la frecuencia cardíaca en reposo.', category: 'Salud Cardiovascular' },
  { icon: '🦴', text: 'Tus huesos se renuevan en ~10 años; la fuerza acelera ese proceso.', category: 'Salud Ósea' },
  { icon: '🍎', text: 'Come un “arcoíris” de frutas y verduras para maximizar antioxidantes.', category: 'Antioxidantes Naturales' },
  { icon: '😴', text: 'En sueño profundo se eliminan toxinas, incl. proteínas asociadas al Alzheimer.', category: 'Importancia del Descanso' },
  { icon: '🚶‍♂️', text: 'Caminar después de comer puede reducir la glucosa en sangre hasta 30%.', category: 'Actividad Post-Comida' },
  { icon: '🥑', text: 'El aguacate es fruta y tiene más potasio que el plátano.', category: 'Datos Nutricionales' },
  { icon: '💧', text: 'Perder 2% de agua corporal afecta rendimiento físico y mental.', category: 'Hidratación' },
  { icon: '🏋️‍♀️', text: 'La fuerza puede elevar tu metabolismo basal por ~24 horas.', category: 'Metabolismo' }
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
