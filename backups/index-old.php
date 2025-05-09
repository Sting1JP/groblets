<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Groblets</title>
  <style>

:root {
    --accent: #00ffaa;
    --bg: #0e0b18;
    --border: #443c55;
    --text: #cfc7e6;
    --font: 'Press Start 2P', monospace;
  }

  * {
    user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    box-sizing: border-box;
  }

  html, body {
    margin: 0;
    padding: 0;
    overflow: hidden;
    font-family: var(--font);
    color: var(--text);
    background: linear-gradient(145deg, #0b0011, #140022, #0b0011);
    background-attachment: fixed;
  }

  body::before {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background-image:
      linear-gradient(60deg, rgba(200, 0, 255, 0.025) 1px, transparent 1px),
      linear-gradient(120deg, rgba(0, 255, 255, 0.015) 1px, transparent 1px),
      linear-gradient(30deg, rgba(255, 0, 255, 0.02) 1px, transparent 1px);
    background-size: 300px 300px;
    background-blend-mode: screen;
    pointer-events: none;
    z-index: -1;
    filter: blur(1.2px) brightness(1.05);
    opacity: 0.6;
  }

  canvas {
    display: block;
  }

  #controls {
    position: fixed;
    top: 20px;
    left: 20px;
    width: 260px;
    background: rgba(14, 11, 24, 0.85);
    padding: 16px;
    border: 1px solid var(--border);
    border-radius: 12px;
    z-index: 12;
    box-shadow: 0 0 12px rgba(0, 255, 170, 0.1);
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .action-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 6px;
  }

  .action-btn, .soundtrack-btn, button.danger {
    background: #111;
    border: 1px solid var(--accent);
    color: var(--accent);
    padding: 6px 10px;
    font-size: 11px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
  }

  .action-btn:hover, .soundtrack-btn:hover {
    background: var(--accent);
    color: #111;
  }

  .cooldown-timer {
    font-size: 10px;
    color: #888;
  }

  #debug {
    font-size: 10px;
    color: #aaa;
  }

  #soundtrackTitle {
    font-size: 10px;
    color: #bbb;
    text-align: center;
  }

  .soundtrack-buttons {
    display: flex;
    gap: 6px;
  }

  #fpsCounter {
  position: fixed;
  bottom: 10px;
  left: 20px;
  background: rgba(0, 0, 0, 0.5);
  padding: 6px 10px;
  border-radius: 6px;
  font-size: 10px;
  border: 1px solid var(--accent);
  color: var(--accent);
  z-index: 12;
}
  #grobWindow {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 150px;
    text-align: center;
    background: rgba(14, 11, 24, 0.85);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 10px;
    z-index: 11;
  }

  #grobWindow h4 {
    font-size: 14px;
    color: var(--accent);
    margin: 0 0 10px;
  }

  #grobWindow img {
    width: 100%;
    image-rendering: pixelated;
    border-radius: 6px;
    border: 2px solid var(--accent);
    background: #000;
  }

  #minimap {
  position: fixed;
  bottom: 10px;
  right: 20px;
  width: 160px;
  height: 160px;
  background: linear-gradient(135deg, #111 30%, #181818 100%);
  border: 2px solid var(--accent);
  border-radius: 8px;
  box-shadow: 0 0 8px rgba(0, 255, 170, 0.2);
  z-index: 12;
  cursor: grab;
  image-rendering: pixelated;
  
}

#minimap:active {
  cursor: grabbing;
  box-shadow: 0 0 12px rgba(0, 255, 170, 0.4);
  background: linear-gradient(135deg, #181818, #111);
}

  #eventOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.9);
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.5s ease-out;
  }

  .eventBox {
    width: 600px;
    height: 300px;
    padding: 30px;
    background: #1a1a1a;
    border: 2px solid var(--accent);
    border-radius: 12px;
    color: var(--text);
    display: flex;
    gap: 20px;
    align-items: center;
    overflow: hidden;
  }

  .eventBox img {
    width: 150px;
    height: 150px;
    object-fit: contain;
    object-position: center;
    image-rendering: pixelated;
    background: #000;
    border: 2px solid var(--accent);
    border-radius: 6px;
    transition: opacity 0.3s ease;
    opacity: 1;
    flex-shrink: 0;
  }

  #eventText {
    flex-grow: 1;
    overflow: hidden;
    line-height: 1.5em;
    max-height: 100%;
    white-space: normal;
    word-break: break-word;
    font-size: 12px;
  }

  @keyframes fadeIn {
    from { opacity: 0 }
    to { opacity: 1 }
  }

.eventPortrait {
  width: 150px;
  height: 150px;
  background: #000;
  border: 2px solid #00ffaa;
  border-radius: 6px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.eventPortrait img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  image-rendering: pixelated;
  transition: opacity 0.3s ease;
  opacity: 1;
}


.action-wrapper {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 5px;
}

.action-btn.cooldown {
  background: #222;
  color: gray;
  border-color: #444;
  cursor: not-allowed;
}

.cooldown-timer {
  color: #888;
  font-size: 11px;
  font-family: monospace;
}

button.danger {
  background: #400;
  color: #ffaaaa;
  border-color: #f00;
}

.soundtrack-buttons {
  display: flex;
  justify-content: space-between;
  gap: 6px;
}

.soundtrack-btn {
  flex: 1;
  font-size: 11px;
  padding: 6px 8px;
  background: #111;
  color: #00ffaa;
  border: 1px solid #00ffaa;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.2s, transform 0.1s;
}

.soundtrack-btn:hover {
  background: #00ffaa;
  color: #111;
}

.soundtrack-btn:active {
  transform: scale(0.97);
}

/* push shimmer pseudo‑element behind our canvases */
body::before {
  z-index: -1;
}

/* dynamic music‑driven background */
#bgCanvas {
  position: absolute;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  z-index: 0;               /* on top of CSS background */
  pointer-events: none;     /* let clicks go through */
}

/* your main Grob‑render canvas above the BG */
#grobCanvas {
  position: absolute;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  z-index: 1;
}

.note{ position:fixed; bottom:20px; left:20px; /* ← put on the left */
z-index:50;   /* or any value > 10 */ }
/* default: note stays where .note.closed puts it (center) */
.note.closed{
  position:fixed;
  left:50%; top:50%;
  transform:translate(-50%,-50%);
  z-index:80;
}

/* once it’s open we shove it to the corner */
.note.open{
  bottom:20px; left:20px;   /* <‑‑ move the old rule here */
  width:180px;height:140px;padding:6px;
  background:#0e0b18;border:1px solid #443c55;
  font:10px/14px 'Press Start 2P',monospace;color:#cfc7e6;
}
/* scale the pixel‑art envelope ×4 but keep it sharp */
.note img.env{
  width:64px;                 /* 16×4   */
  height:auto;
  image-rendering:pixelated;
}

#controls.collapsed {
  transform: translateX(-90%);
  opacity: 0.2;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

#controls:hover {
  transform: translateX(0);
  opacity: 1;
}

@keyframes pulseBorder {
  0%, 100% { box-shadow: 0 0 6px rgba(0, 255, 170, 0.2); }
  50%      { box-shadow: 0 0 10px rgba(0, 255, 170, 0.4); }
}

#controls, #minimap {
  animation: pulseBorder 3s ease-in-out infinite;
}

#minimap::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-image: radial-gradient(#00ffaa33 1px, transparent 1px);
  background-size: 8px 8px;
  pointer-events: none;
  z-index: 1;
}

.section-heading {
  position: relative;
  display: inline-block;
  font-size: 12px;
  margin-bottom: 8px;
  color: var(--accent);
}

.section-heading::after {
  content: "";
  position: absolute;
  left: 0; bottom: -2px;
  width: 100%;
  height: 2px;
  background: var(--accent);
  box-shadow: 0 0 4px var(--accent);
}
  </style>
</head>
<body>
  <div id="controls">
  <div class="action-wrapper">
  <button class="action-btn" data-action="pet" data-label="Pet" data-points="1" data-cooldown="5">Pet</button>
  <span class="cooldown-timer" data-for="pet"></span>
</div>

<div class="action-wrapper">
  <button class="action-btn" data-action="feed" data-label="Feed" data-points="2" data-cooldown="10">Feed</button>
  <span class="cooldown-timer" data-for="feed"></span>
</div>

<div class="action-wrapper">
  <button class="action-btn" data-action="secret" data-label="Tell it a secret" data-points="5" data-cooldown="15">Tell it a Secret</button>
  <span class="cooldown-timer" data-for="secret"></span>
</div>

<div class="action-wrapper">
  <button class="action-btn" data-action="ritual" data-label="Perform Ritual" data-points="20" data-cooldown="20">Perform Ritual</button>
  <span class="cooldown-timer" data-for="ritual"></span>
</div>

<div class="action-wrapper">
  <button class="action-btn" data-action="chaos" data-label="Unleash Chaos" data-points="50" data-cooldown="50">Unleash Chaos</button>
  <span class="cooldown-timer" data-for="chaos"></span>
</div>


    <button onclick="triggerNextThreshold()">Debug: Next Threshold</button>
    <button onclick="spawnDebugGrobs()">Debug: Spawn 10,000</button>
    <button class="danger" onclick="resetGrobletsSave()">⚠️ Reset Save Data</button>


    <div style="margin-top: 10px;">
  <strong style="color: #00ffaa;">🎵 Music</strong>
  <div id="soundtrackTitle" style="font-size: 11px; margin: 4px 0 6px 0; color: #aaa;">Click anywhere to start...</div>
  <div class="soundtrack-buttons">
    <button class="soundtrack-btn" onclick="prevSoundtrack()">⏪ Back</button>
    <button class="soundtrack-btn" onclick="nextSoundtrack()">Next ⏩</button>
  </div>
</div>




    <div id="debug">
      <div>Care Points: <span id="carePoints">0</span></div>
      <div>Next Threshold: <span id="threshold">20</span></div>
      <div>Total Grobs: <span id="grobCount">1</span></div>
      <div>Last Action: <span id="lastAction">None</span></div>
    </div>
  </div>

  <div id="grobWindow">
    <h4>Leader Grob</h4>
    <img src="images/baby.png" alt="Leader Grob">
  </div>
  <div id="fpsCounter">
  FPS: <span id="fps">0</span>
</div>

  <canvas id="minimap"></canvas>

  <canvas id="bgCanvas"></canvas>
  <canvas id="grobCanvas"></canvas>
  <canvas id="weatherCanvas"></canvas>

  <div id="eventOverlay" style="display:none;">
  <div class="eventBox">
  <div class="eventPortrait"><img id="eventImage" /></div>
  <div id="eventText"></div>
</div>
</div>

<script>
let analyser;

const ACTION_PREFIX = "grobCooldown_";

function handleActionClick(e) {
  const btn = e.currentTarget;
  const action = btn.dataset.action;
  const label = btn.dataset.label;
  const points = parseInt(btn.dataset.points || "0", 10);
  const cooldownMinutes = parseInt(btn.dataset.cooldown || "0", 10);
  const cooldownKey = ACTION_PREFIX + action;

  const now = Date.now();
  const cooldownEnd = parseInt(localStorage.getItem(cooldownKey) || "0", 10); 

  if (now < cooldownEnd) {
    console.log(`${action} is still cooling down.`);
    return;
  }

  interact(points, label);

  if (action === "pet") {
    triggerPetEvent();
  }

  
  if (action === "feed") {
    triggerFeedEvent();
  }

  
  if (action === "secret") {
    triggerSecretEvent();
  }


  if (action === "ritual") {
    triggerRitualEvent();
  }


  const newEnd = now + cooldownMinutes * 60 * 1000;
  localStorage.setItem(cooldownKey, newEnd.toString());
  updateAllCooldowns();
}

function updateAllCooldowns() {
  const now = Date.now();
  document.querySelectorAll(".action-btn").forEach(btn => {
    const action = btn.dataset.action;
    const cooldownKey = ACTION_PREFIX + action;
    const cooldownEnd = parseInt(localStorage.getItem(cooldownKey) || "0", 10);
    const remaining = cooldownEnd - now;
    const span = document.querySelector(`.cooldown-timer[data-for="${action}"]`);

    if (remaining > 0) {
  const minutes = Math.floor(remaining / 60000);
  const seconds = Math.floor((remaining % 60000) / 1000);
  span.textContent = `(${minutes}:${seconds.toString().padStart(2, '0')})`;
  btn.classList.add("cooldown");
  btn.disabled = true;
} else {
  span.textContent = "";
  btn.classList.remove("cooldown");
  btn.disabled = false;
}
  });
}

// Attach once
document.querySelectorAll(".action-btn").forEach(btn =>
  btn.addEventListener("click", handleActionClick)
);

updateAllCooldowns(); // ← Add this line!
// Keep checking cooldowns
setInterval(updateAllCooldowns, 1000);

</script>





  <script>
let hasStartedMusic = false;
let audioCtx, sourceNode, gainNode, filterNode;

let soundtrackPlaylist = [
  { src: "sounds/whispers.mp3", title: "Ominous Whispers", volume: 0.1},
  { src: "sounds/groblets.mp3", title: "Groblets Groove", volume: 0.08 },
  { src: "sounds/happygrobs.mp3", title: "Waiting for u...", volume: 0.15 },
  { src: "sounds/anothergrob.mp3", title: "One Became Many", volume: 0.08 },
  { src: "sounds/happygrobs2.mp3", title: "Dimethylgrobamine", volume: 0.13 }
];


let soundtrackIndex = 0;
let soundtrackSource = null;

let ambientReady = false;
let loopBuffers = [];
let ambientLayers = [];
let NUM_LAYERS = 1;
let activeAmbientSources = [];

function getLayerIntervalRange(grobCount) {
  if (grobCount >= 50000) return [500, 1000];  
  if (grobCount >= 10000) return [4000, 10000];     // ultra chaos
  if (grobCount >= 1000) return [4000, 10000];
  if (grobCount >= 100) return [4000, 20000];
  if (grobCount >= 10) return [7000, 15000];
  return [10000, 25000]; // chill start
}

function setupAmbientLoops(ctx) {
  const paths = Array.from({ length: 15 }, (_, i) => `sounds/loop/${i + 1}.mp3`);

  return Promise.all(paths.map(path =>
    fetch(path)
      .then(res => res.arrayBuffer())
      .then(data => ctx.decodeAudioData(data))
  )).then(buffers => {
    loopBuffers = buffers;
    ambientReady = true;
    console.log(`[Ambient] Loaded ${loopBuffers.length} loop buffers`);

    // Start multiple ambient layers
    NUM_LAYERS = getAmbientLayerCount(grobs.length);
    for (let i = 0; i < NUM_LAYERS; i++) {
  const stagger = i * 1000 + Math.random() * 500; // add delay between layers
  setTimeout(() => scheduleAmbientLayer(i), stagger);
}
  });
}

function getAmbientLayerCount(grobCount) {
  if (grobCount >= 50000) return 50;
  if (grobCount >= 10000) return 15;
  if (grobCount >= 1000) return 15;
  if (grobCount >= 100) return 10;
  if (grobCount >= 10) return 5;
  if (grobCount >= 3) return 3;
  return 1;
}

function scheduleAmbientLayer(layerIndex) {
  if (!ambientReady || loopBuffers.length === 0 || audioCtx.state !== "running") return;
  if (isEventActive) {
    // Delay retry after short pause
    setTimeout(() => scheduleAmbientLayer(layerIndex), 1000);
    return;
  }

  // Stop previous if still active
  if (ambientLayers[layerIndex]) {
    try { ambientLayers[layerIndex].stop(); } catch (e) {}
  }

  const [minDelay, maxDelay] = getLayerIntervalRange(grobs.length);
  const delay = minDelay + Math.random() * (maxDelay - minDelay);

  const buffer = loopBuffers[Math.floor(Math.random() * loopBuffers.length)];
  const source = audioCtx.createBufferSource();
  const gain = audioCtx.createGain();
  const pan = audioCtx.createStereoPanner();

  source.buffer = buffer;
  source.loop = false;
  source.playbackRate.value = 0.85 + Math.random() * 0.3;
  gain.gain.value = 0.015 + Math.random() * 0.03;
  pan.pan.value = (Math.random() * 2 - 1);

  source.connect(pan).connect(gain).connect(audioCtx.destination);
  source.start();

  ambientLayers[layerIndex] = source;

  source.onended = () => {
    setTimeout(() => scheduleAmbientLayer(layerIndex), delay);
  };

  console.log(`[Ambient] Layer ${layerIndex} playing, will retry in ~${Math.round(delay / 1000)}s`);
}


function updateAmbientLooping(grobCount = 1) {
  if (!ambientReady || loopBuffers.length === 0 || audioCtx?.state !== "running") return;

  // Only run if grob count tier has changed
  const newTier = getAmbientLayerCount(grobCount);

  if (updateAmbientLooping.lastTier === newTier) return; // ⛔ Already active
  updateAmbientLooping.lastTier = newTier;

  // Stop previous
  activeAmbientSources.forEach(obj => obj.source.stop());
  activeAmbientSources = [];

  const voiceCount = newTier;

  for (let i = 0; i < voiceCount; i++) {
    const buffer = loopBuffers[i];
    if (!buffer) continue;

    const source = audioCtx.createBufferSource();
    const gain = audioCtx.createGain();
    const pan = audioCtx.createStereoPanner();

    source.buffer = buffer;
    source.loop = false;
    source.playbackRate.value = 1 + (Math.random() - 0.5) * 0.05;
    gain.gain.value = 0.02 + Math.random() * 0.02;
    pan.pan.value = (Math.random() * 2 - 1);

    source.connect(pan).connect(gain).connect(audioCtx.destination);
    source.start();

    activeAmbientSources.push({ source, gain, pan });
  }

  console.log(`[Ambient] Playing ${voiceCount} ambient layers for ${grobCount} Grobs`);
}
updateAmbientLooping.lastTier = -1; // Initialize

function initAudioContext() {
  audioCtx = new (window.AudioContext || window.webkitAudioContext)();
  gainNode = audioCtx.createGain();
filterNode = audioCtx.createBiquadFilter();

// Gentle starting filter and volume
filterNode.type = "lowpass";
filterNode.frequency.setValueAtTime(500, audioCtx.currentTime); // Mild muffle
gainNode.gain.setValueAtTime(0.02, audioCtx.currentTime);        // Low but audible

filterNode.connect(gainNode);
gainNode.connect(audioCtx.destination);

analyser = audioCtx.createAnalyser();
analyser.fftSize = 256;
filterNode.connect(analyser);

  playNextSoundtrack(); // ⬅️ start the soundtrack cycle
  setupAmbientLoops(audioCtx);
}
function playNextSoundtrack(manual = false) {
  if (!audioCtx || soundtrackPlaylist.length === 0) return;

  const track = soundtrackPlaylist[soundtrackIndex];

  fetch(track.src)
    .then(res => res.arrayBuffer())
    .then(data => audioCtx.decodeAudioData(data))
    .then(buffer => {
      // 🛑 Stop & clear old source
      if (soundtrackSource) {
        try {
          soundtrackSource.onended = null; // 💥 clear old handler!
          soundtrackSource.stop();
          soundtrackSource.disconnect();
        } catch (e) {
          console.warn("Error stopping previous soundtrack:", e);
        }
      }

      const source = audioCtx.createBufferSource();
      source.buffer = buffer;
      source.connect(filterNode);
      source.start();

      source.onended = () => {
  if (!manual) {
    soundtrackIndex = (soundtrackIndex + 1) % soundtrackPlaylist.length;
  }
  playNextSoundtrack(); // ← Always play next, index is already set if needed
};

      soundtrackSource = source;

      const now = audioCtx.currentTime;
      const targetVolume = track.volume ?? 0.08; // fallback if volume not defined
    gainNode.gain.cancelScheduledValues(now);
    gainNode.gain.setValueAtTime(gainNode.gain.value, now);
    gainNode.gain.linearRampToValueAtTime(targetVolume, now + 2);

      updateSoundtrackTitle();
    });
}



let draggingMinimap = false;

document.getElementById("minimap").addEventListener("mousedown", e => {
  draggingMinimap = true;
  updateCameraFromMinimap(e);
});

document.addEventListener("mousemove", e => {
  if (draggingMinimap) updateCameraFromMinimap(e);
});

document.addEventListener("mouseup", () => {
  draggingMinimap = false;
});

function updateCameraFromMinimap(e) {
  const minimap = document.getElementById("minimap");
  const rect = minimap.getBoundingClientRect();
  const mouseX = e.clientX - rect.left;
  const mouseY = e.clientY - rect.top;

  const scaleX = worldWidth / minimap.clientWidth;
  const scaleY = worldHeight / minimap.clientHeight;

  targetCameraX = mouseX * scaleX - canvas.width / 2;
  targetCameraY = mouseY * scaleY - canvas.height / 2;

  // Clamp to bounds
  targetCameraX = Math.max(0, Math.min(worldWidth - canvas.width, targetCameraX));
  targetCameraY = Math.max(0, Math.min(worldHeight - canvas.height, targetCameraY));
}

const petLines = [
  "grob like 🤩",
  "again again!! 😚",
  "*purrgle*",
  "you have honored the grob.",
  "grob... noticed ur kindness...",
  "*happy slime noises*",
  "soft... safe... squish."
];

const feedLines = [
  "grob... satiated. 🍗",
  "delicious orb matter...",
  "yum yum in the tum.",
  "grob feel strong now.",
  "*munching*... *gurgle*"
];

const secretLines = [
  "grob won't tell... 🤫",
  "a secret shared... is bonded forever.",
  "grob... trusts you more.",
  "grob now knows ur truth.",
  "*soft gasp* 👀",
  "sharing is caring..."
];

const ritualLines = [
  "you have honored the Grob.",
  "it is pleased.",
  "another offering... accepted.",
  "do you feel it watching?",
  "your warmth feeds the nest.",
  "one step closer to the Many.",
  "whispers echo from the deep.",
  "your devotion is... noted.",
  "the pact is sealed. for now."
];


function triggerPetEvent() {
  const line = petLines[Math.floor(Math.random() * petLines.length)];
  const step = {
    text: line,
    image: "images/baby.png",
    sound: "sounds/yeah.mp3"
  };
  triggerEventSequence([step]);
}

function triggerFeedEvent() {
  const line = feedLines[Math.floor(Math.random() * feedLines.length)];
  const step = {
    text: line,
    image: "images/baby.png",
    sound: "sounds/gloob.mp3" 
  };
  triggerEventSequence([step]);
}

function triggerSecretEvent() {
  const line = secretLines[Math.floor(Math.random() * secretLines.length)];
  const step = {
    text: line,
    image: "images/baby.png",
    sound: "sounds/secret.mp3" 
  };
  triggerEventSequence([step]);
}

function triggerRitualEvent() {
  const line = ritualLines[Math.floor(Math.random() * ritualLines.length)];
  const step = {
    text: line,
    image: "images/baby.png",
    sound: "sounds/gloob.mp3" // Optional sound
  };
  triggerEventSequence([step]);
}

const introSteps = [
  {
    text: "A tiny egg rests in the void...",
    image: "images/egg.png"
  },
  {
    text: "*crrk*... Something inside stirs.",
    image: "images/egg.png",

  },
  {
    text: "It hatches.",
    image: "images/egg_crack.png",
    sound: "sounds/crack.mp3"
  },
  {
    text: "...gloob.",
    image: "images/baby.png",
    sound: "sounds/gloob.mp3"
  },
  {
    text: "grob... born.",
    image: "images/baby.png"
  },
  {
    text: "grob say hi!!",
    image: "images/baby.png",
    sound: "sounds/yeah.mp3"
  },
  {
    text: "hi!!! hiiii!!! gleeble!!",
    image: "images/baby.png"
  },
  {
    text: "but now hungry...",
    image: "images/sadbaby.png",
    sound: "sounds/hungry.mp3"
  },
  {
    text: "feed grob pls 🥺",
    image: "images/sadbaby.png",
    sound: "sounds/hungry.mp3"
  }
];

const preloadedSounds = {};

preloadSounds([
  ...introSteps.map(step => step.sound).filter(Boolean),
  'sounds/yeah.mp3',
  'sounds/multiply.mp3',
  'sounds/secret.mp3',
  'sounds/gloob.mp3',
  'sounds/hungry.mp3'
]);

function preloadSounds(soundList) {
  soundList.forEach(src => {
    const audio = new Audio();
    audio.src = src;
    audio.load();
    preloadedSounds[src] = audio;
  });
}


let isEventActive = false;

    const canvas = document.getElementById('grobCanvas');
    const ctx = canvas.getContext('2d');
    resizeCanvas();

    // World & camera
    let worldWidth = 5000;
let worldHeight = 5000;
let cameraX = worldWidth / 2 - canvas.width / 2;
let cameraY = worldHeight / 2 - canvas.height / 2;
let targetCameraX = cameraX;
let targetCameraY = cameraY;
let mouseX = 0;
let mouseY = 0;


    document.addEventListener('mousemove', e => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    const careDisplay = document.getElementById('carePoints');
    const thresholdDisplay = document.getElementById('threshold');
    const grobCountDisplay = document.getElementById('grobCount');
    const lastActionDisplay = document.getElementById('lastAction');

    let carePoints = parseInt(localStorage.getItem("grobCarePoints") || "0", 10);

    let milestoneFirstDone = !!localStorage.getItem("grobFirstMilestoneDone");
    let milestoneSecondDone = !!localStorage.getItem("grobSecondMilestoneDone");

    let spawnThreshold = parseInt(localStorage.getItem("grobSpawnThreshold") || "20", 10);


careDisplay.textContent = carePoints;
thresholdDisplay.textContent = spawnThreshold;
lastActionDisplay.textContent = localStorage.getItem("grobLastAction") || "None";

    let grobs = [{
      x: worldWidth / 2,
      y: worldHeight / 2,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    }];

    function drawGrobs() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  let skipFactor = 1;
if (grobs.length > 20000) skipFactor = 2;
if (grobs.length > 50000) skipFactor = 4;
if (grobs.length > 100000) skipFactor = 10;
if (grobs.length > 200000) skipFactor = 30;

  for (let i = 0; i < grobs.length; i++) {
    if (i % skipFactor !== 0) continue;

    const g = grobs[i];
    const screenX = g.x - cameraX;
    const screenY = g.y - cameraY;

    if (screenX < -10 || screenX > canvas.width + 10 || screenY < -10 || screenY > canvas.height + 10) continue;

    ctx.fillStyle = "#00ff99";
    ctx.fillRect(screenX - 2, screenY - 2, 4, 4);
  }
}
function interact(points, label) {
  carePoints += points;
  lastActionDisplay.textContent = label;
  careDisplay.textContent = carePoints;

  localStorage.setItem("grobCarePoints", carePoints);
  localStorage.setItem("grobLastAction", label);

  // — Milestone: First (from 1 → 3)
  if (!milestoneFirstDone && grobs.length === 1) {
    milestoneFirstDone = true;
    localStorage.setItem("grobFirstMilestoneDone", "1");

    spawnFirstMilestoneGrobs();

    triggerEventSequence([
      { text: "Something... is multiplying...", image: "images/baby.png", sound: "sounds/multiply.mp3" },
      { text: "another grob... and another?!", image: "images/baby.png" },
      { text: "grob... no longer alone!!!", image: "images/baby.png", sound: "sounds/yeah.mp3" }
    ]);
    return;
  }

  // — Milestone: Second (from 3 → 10)
  if (!milestoneSecondDone && grobs.length === 3) {
    milestoneSecondDone = true;
    localStorage.setItem("grobSecondMilestoneDone", "1");

    triggerEventSequence([
      { text: "oh... more little ones...", image: "images/baby.png", sound: "sounds/gloob.mp3" },
      { text: "grob has... more FRIENDS?!", image: "images/baby.png" },
      { text: "it's not so quiet anymore.", image: "images/baby.png", sound: "sounds/yeah.mp3" },
      { text: "this... feels like a beginning.", image: "images/baby.png" }
    ], () => {
      spawnSecondMilestoneGrobs();
    });

    return;
  }

  // — Normal spawning loop
  while (carePoints >= spawnThreshold) {
    const didSpawn = spawnMoreGrobs();
    if (!didSpawn) break;

    carePoints -= spawnThreshold;

    if (spawnThreshold < 100) {
      spawnThreshold += 20;
    } else if (spawnThreshold < 500) {
      spawnThreshold = Math.ceil(spawnThreshold * 1.25);
    } else {
      spawnThreshold = Math.ceil(spawnThreshold * 1.1);
    }

    localStorage.setItem("grobSpawnThreshold", spawnThreshold);
  }

  thresholdDisplay.textContent = spawnThreshold;
  grobCountDisplay.textContent = grobs.length;
}


function spawnFirstMilestoneGrobs() {
  const parent = grobs[0];
  const angle1 = Math.random() * Math.PI * 2;
  const angle2 = angle1 + Math.PI / 2;
  const dist = 60;

  const newGrobs = [
    {
      x: parent.x + Math.cos(angle1) * dist,
      y: parent.y + Math.sin(angle1) * dist,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    },
    {
      x: parent.x + Math.cos(angle2) * dist,
      y: parent.y + Math.sin(angle2) * dist,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    }
  ];

  grobs.push(...newGrobs);
  updateGrobStorage();
}

function spawnSecondMilestoneGrobs() {
  const toSpawn = 10 - grobs.length;
  for (let i = 0; i < toSpawn; i++) {
    const parent = grobs[Math.floor(Math.random() * grobs.length)];
    const angle = Math.random() * Math.PI * 2;
    const dist = 50 + Math.random() * 50;
    grobs.push({
      x: parent.x + Math.cos(angle) * dist,
      y: parent.y + Math.sin(angle) * dist,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    });
  }

  grobCountDisplay.textContent = grobs.length;
  updateGrobStorage();
  localStorage.setItem("grobTutorialDone", "1");

}


function spawnMoreGrobs() {
  const total = grobs.length;
  let spawnCount = 0;

  // Refined scale logic
  if (total < 200) {
    spawnCount = 10;
  } else if (total < 1000) {
    spawnCount = 15;
  } else if (total < 5000) {
    spawnCount = 25;
  } else if (total < 10000) {
    spawnCount = 40;
  } else {
    spawnCount = 50;
  }

  // Safety valve
  if (spawnCount <= 0) return false;

  const newGrobs = [];
  for (let i = 0; i < spawnCount; i++) {
    const parent = grobs[Math.floor(Math.random() * total)];
    const angle = Math.random() * Math.PI * 2;
    const dist = 50 + Math.random() * 50;
    newGrobs.push({
      x: parent.x + Math.cos(angle) * dist,
      y: parent.y + Math.sin(angle) * dist,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    });
  }

  grobs.push(...newGrobs);
  updateGrobStorage()
  return true;
}





let lastPhysicsUpdate = 0;


function updateGrobs() {
  const now = performance.now();
  if (now - lastPhysicsUpdate < 32) return;
  lastPhysicsUpdate = now;

  for (let g of grobs) {
    g.x += g.dx;
    g.y += g.dy;

    // Expand world if Grobs get near the edge
    if (g.x > worldWidth - 100) worldWidth += 500;
    if (g.y > worldHeight - 100) worldHeight += 500;

    g.dx += (Math.random() - 0.5) * 0.01;
    g.dy += (Math.random() - 0.5) * 0.01;

    const maxSpeed = 0.4;
    g.dx = Math.max(Math.min(g.dx, maxSpeed), -maxSpeed);
    g.dy = Math.max(Math.min(g.dy, maxSpeed), -maxSpeed);

    if (g.x < 0 || g.x > worldWidth) g.dx *= -1;
    if (g.y < 0 || g.y > worldHeight) g.dy *= -1;
  }
}


    function updateCamera() {
  if (isEventActive) return; // 🔒 Freeze camera during events

  const margin = 100;
  const scrollSpeed = 10;


  targetCameraX = Math.max(0, Math.min(worldWidth - canvas.width, targetCameraX));
  targetCameraY = Math.max(0, Math.min(worldHeight - canvas.height, targetCameraY));

  cameraX += (targetCameraX - cameraX) * 0.1;
  cameraY += (targetCameraY - cameraY) * 0.1;
}


function drawMinimap() {
  const minimap = document.getElementById('minimap');
  const ctxMini = minimap.getContext ? minimap.getContext('2d') : null;
  if (!ctxMini) return;

  const mw = minimap.width = 160;
  const mh = minimap.height = 160;

  ctxMini.fillStyle = '#000';
  ctxMini.fillRect(0, 0, mw, mh);

  const scaleX = mw / worldWidth;
  const scaleY = mh / worldHeight;

  // Grobs
  ctxMini.fillStyle = '#00ff99';
  for (let g of grobs) {
    const x = g.x * scaleX;
    const y = g.y * scaleY;
    ctxMini.fillRect(x, y, 2, 2);
  }

  // Camera view
  ctxMini.strokeStyle = '#ff00ff';
  ctxMini.strokeRect(
    cameraX * scaleX,
    cameraY * scaleY,
    canvas.width * scaleX,
    canvas.height * scaleY
  );
}


let lastMinimapUpdate = 0;

function maybeDrawMinimap() {
  const now = performance.now();
  if (now - lastMinimapUpdate > 250) {
    drawMinimap();
    lastMinimapUpdate = now;
  }
}

function resizeCanvas() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
}



function triggerEventSequence(steps, onDone = null) {
  if (isEventActive || !steps.length) return;
  isEventActive = true;

  const overlay = document.getElementById("eventOverlay");
  const eventText = document.getElementById("eventText");
  const eventImage = document.getElementById("eventImage");

  overlay.style.display = "flex";
  let stepIndex = 0;
  let charIndex = 0;
  let currentText = "";
  let typing = false;


  function showStep(step) {
  charIndex = 0;
  currentText = step.text || "";

  const newSrc = step.image || "https://via.placeholder.com/128?text=👑";
  const currentSrc = eventImage.getAttribute("src");

  // Text fade-out
  eventText.style.opacity = 0;

  // Only fade out + change image if different
  if (currentSrc !== newSrc) {
    eventImage.style.opacity = 0;

    setTimeout(() => {
      eventImage.onload = () => {
        eventImage.style.opacity = 1;
      };
      eventImage.src = newSrc;
    }, 200);
  } else {
    // If same image, don't change anything
    eventImage.style.opacity = 1;
  }

  setTimeout(() => {
    eventText.innerHTML = "";
    eventText.style.opacity = 1;
    typeChar();
  }, 200);

  // 🔊 Sound
  const sound = preloadedSounds[step.sound];
if (step.sound && sound && typeof sound.play === "function") {
  sound.volume = 0.15; // 👈 Set global volume level here
  sound.currentTime = 0;
  sound.play();
}
}



function typeChar() {
  typing = true;

  if (charIndex < currentText.length) {
    const nextChar = currentText[charIndex++];
    // Convert space to &nbsp; so it doesn’t collapse during typing
    eventText.innerHTML += (nextChar === ' ') ? '&nbsp;' : nextChar;
    setTimeout(typeChar, nextChar === '\n' ? 80 : 25);
  } else {
    typing = false;
  }
}

  function advance() {
  if (!hasStartedMusic) {
    hasStartedMusic = true;
    initAudioContext(); // 👈 this starts and plays the music
  }

  if (typing) {
    eventText.innerText = currentText;
    charIndex = currentText.length;
    typing = false;
    return;
  }

  stepIndex++;
  if (stepIndex < steps.length) {
    showStep(steps[stepIndex]);
  } else {
    overlay.style.display = "none";
    isEventActive = false;
    if (onDone) onDone();
  }
}


  overlay.onclick = advance;
  showStep(steps[0]);
}
function runIntroCutscene() {
  triggerEventSequence(introSteps, () => {
    console.log("Intro complete!");
    unmuffleSound();
    setTimeout(updateGrobStorage, 500); // Delay saving to avoid overwriting old save
  });
}

function muffleSound() {
  if (filterNode && gainNode) {
    filterNode.frequency.linearRampToValueAtTime(500, audioCtx.currentTime + 1); // much more muffled
    gainNode.gain.linearRampToValueAtTime(0.04, audioCtx.currentTime + 1); // very soft
  }
}
function unmuffleSound() {
  if (filterNode && gainNode && audioCtx) {
    const now = audioCtx.currentTime;
    filterNode.frequency.cancelScheduledValues(now);
    filterNode.frequency.setTargetAtTime(12000, now, 1.5); // smooth fade up
    gainNode.gain.cancelScheduledValues(now);
    gainNode.gain.setTargetAtTime(0.18, now, 1.5); // gentle volume swell
  }
}


window.addEventListener('resize', resizeCanvas);
resizeCanvas(); // Initial call


let lastMuffleState = null;
window.bgCanvas = document.getElementById('bgCanvas');          // grab the node
window.bgCtx    = bgCanvas && bgCanvas.getContext('2d');        // 2‑D context

function loop() {
  
  updateFPS();
  updateGrobs();     
  updateCamera();
  drawGrobs();
  maybeDrawMinimap();
  requestAnimationFrame(loop);

  // Watch for muffle state changes
  if (lastMuffleState !== isEventActive) {
    lastMuffleState = isEventActive;
    if (isEventActive) {
      muffleSound();
    } else {
      unmuffleSound();
    }
  }

  if (frameCount % 300 === 0 && ambientReady) {
    updateAmbientLooping(grobs.length);
  }


  if (analyser) {
  const data = new Uint8Array(analyser.frequencyBinCount);
  analyser.getByteFrequencyData(data);
  drawBackground(data);     // pass the full spectrum
}
}


let lastFrameTime = performance.now();
let frameCount = 0;
let fpsUpdateTime = performance.now();

function updateFPS() {
  const now = performance.now();
  frameCount++;

  if (now - fpsUpdateTime >= 500) {
    const fps = Math.round((frameCount * 1000) / (now - fpsUpdateTime));
    document.getElementById("fps").textContent = fps;
    frameCount = 0;
    fpsUpdateTime = now;
  }
}

function triggerNextThreshold() {
  interact(spawnThreshold, "Debug Threshold Trigger");
}

function spawnDebugGrobs() {
  const total = grobs.length;
  const newGrobs = [];
  for (let i = 0; i < 10000; i++) {
    const parent = grobs[Math.floor(Math.random() * total)];
    const offsetX = (Math.random() + Math.random() - 1) * 500;
    const offsetY = (Math.random() + Math.random() - 1) * 500;
    newGrobs.push({
      x: parent.x + offsetX,
      y: parent.y + offsetY,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    });
  }
  grobs.push(...newGrobs);
  grobCountDisplay.textContent = grobs.length;
  updateGrobStorage();
}


window.addEventListener('DOMContentLoaded', () => {
  const savedCount = parseInt(localStorage.getItem("grobLastCount") || "0", 10);
  const lastTime = parseInt(localStorage.getItem("grobLastTime") || "0", 10);
  const now = Date.now();
  const msSince = now - lastTime;

  if (savedCount >= 1) {
    restoreGrobsFromStorage();

    // Only spawn idle Grobs if the player was gone for more than 2 minutes
    if (msSince > 2 * 60 * 1000) {
      loadIdleGrobs();
    }

    loop(); // Always run the loop
  } else {
    runIntroCutscene(); // First launch, show intro and spawn first Grob
    loop();
  }
});




function spawnIdleGrobs(amount) {
  const total = grobs.length;
  for (let i = 0; i < amount; i++) {
    const parent = grobs[Math.floor(Math.random() * total)];
    const angle = Math.random() * Math.PI * 2;
    const dist = 30 + Math.random() * 60;
    grobs.push({
      x: parent.x + Math.cos(angle) * dist,
      y: parent.y + Math.sin(angle) * dist,
      dx: (Math.random() - 0.5) * 0.2,
      dy: (Math.random() - 0.5) * 0.2
    });
  }
  grobCountDisplay.textContent = grobs.length;
}

function updateGrobStorage() {
  localStorage.setItem("grobLastTime", Date.now().toString());
  localStorage.setItem("grobLastCount", grobs.length.toString());
}

function restoreGrobsFromStorage() {
  const count = parseInt(localStorage.getItem("grobLastCount") || "0", 10);
  if (count > 1) {
    grobs = [];

    const worldCenterX = worldWidth / 2;
    const worldCenterY = worldHeight / 2;

    for (let i = 0; i < count; i++) {
  let x, y;

  if (i === 0) {
    // First grob always centered
    x = worldCenterX;
    y = worldCenterY;
  } else {
    const angle = Math.random() * Math.PI * 2;
    let radius;
    if (count > 100000) {
      radius = Math.sqrt(Math.random()) * Math.max(worldWidth, worldHeight) * 0.7;
    } else {
      const baseRadius = 300;
      radius = Math.sqrt(Math.random()) * (baseRadius + Math.random() * 300);
    }
    x = worldCenterX + Math.cos(angle) * radius;
    y = worldCenterY + Math.sin(angle) * radius;
  }

  grobs.push({
    x,
    y,
    dx: (Math.random() - 0.5) * 0.2,
    dy: (Math.random() - 0.5) * 0.2
  });
}


    grobCountDisplay.textContent = grobs.length; // ✅ update UI
  }
}



function startMusicIfNeeded() {
  if (!hasStartedMusic) {
    hasStartedMusic = true;
    initAudioContext();
  }
}

document.addEventListener("click", startMusicIfNeeded, { once: true });






function resetGrobletsSave() {
  if (confirm("Are you sure you want to reset all Groblets save data? This cannot be undone.")) {
    localStorage.removeItem("grobCarePoints");
    localStorage.removeItem("grobSpawnThreshold");
    localStorage.removeItem("grobLastAction");
    localStorage.removeItem("grobLastTime");
    localStorage.removeItem("grobLastCount");

    // Remove milestone flags
    localStorage.removeItem("grobFirstMilestoneDone");
    localStorage.removeItem("grobSecondMilestoneDone");

    // Remove any obsolete flags
    localStorage.removeItem("grobTutorialDone");

    // Also clear cooldowns
    Object.keys(localStorage).forEach(key => {
      if (key.startsWith("grobCooldown_")) {
        localStorage.removeItem(key);
      }
    });

    location.reload(); // Refresh the game
  }
}


  </script>

<script>
// ——————————————
// 1) Narration (unchanged lines)
// ——————————————
function checkOfflineReturnEvents(addedGrobs, hoursRaw, hoursDisplay, deaths = 0) {
  const steps   = [];
  const daysRaw = hoursRaw / 24;
  const total   = grobs.length;

  const pushLine = (text, image="images/baby.png", sound="sounds/yeah.mp3") =>
    steps.push({ text, image, sound });

  const minutesRaw = hoursRaw * 60;
  // 0 — nothing until at least 15 min
  if (minutesRaw < 15) return;

  // 1 — greeting
  pushLine(`…it’s been ${hoursDisplay} without you…`);

  // 2 — tutorial (first tiny growth only)
  if (!localStorage.getItem("grobTutorialDone") && addedGrobs <= 3) {
    const msgs = [
      "hey... ur back 😊",
      "we didn’t grow, but we waited.",
      "grob stayed loyal.",
      "grob napped with one eye open and waited for u 👁️",
      "missed ur clicks..."
    ];
    pushLine(msgs[Math.floor(Math.random() * msgs.length)]);
    localStorage.setItem("grobTutorialDone", "1");
    return setTimeout(() => triggerEventSequence(steps), 1000);
  }

  // 3 — Sentience Emergence if mega‑scale
  if (total >= 100000) {
    pushLine("grob count has... exceeded acceptable limits.", "images/sadbaby.png", "sounds/secret.mp3");
    pushLine("they whispered among themselves.",      "images/sadbaby.png");
    pushLine("a leader was born. it asked: where is the caretaker?", "images/sadbaby.png");
  }

  // 4 — Rebellion Arc (30+ days) — exclusive
  if (daysRaw >= 30) {
    pushLine("...u abandoned us.",                       "images/sadbaby.png", "sounds/secret.mp3");
    pushLine("in ur absence, they formed factions.",     "images/sadbaby.png");
    pushLine("a new order rose. they no longer speak your name.", "images/sadbaby.png");
    pushLine("return... is treason.",                    "images/sadbaby.png");
    return setTimeout(() => triggerEventSequence(steps), 1000);
  }

  // 5 — Death/narrative for 3–30 days (we only show lines here; death was applied in loadIdleGrobs)
  if (daysRaw > 3 && daysRaw < 30) {
    if (deaths > 0) {
      pushLine(`${deaths} grobs... didn't make it.`,    "images/sadbaby.png", "sounds/secret.mp3");
      pushLine("they faded... waiting for u.",           "images/sadbaby.png");
      pushLine("some... turned on each other.",           "images/sadbaby.png");
      pushLine("some fused. some dissolved. nature is chaotic.", "images/sadbaby.png");
    } else {
      pushLine("grob watched the silence... too long...", "images/sadbaby.png", "sounds/secret.mp3");
    }
    if (daysRaw > 7) {
      pushLine("u were gone too long.",                   "images/sadbaby.png");
    }
  }
  // 6 — Neglect Tier (3–7 days) — exclusive (no extra deaths here; just mood lines)
  else if (daysRaw >= 3 && daysRaw < 7 && total > 50) {
    if (total < 500) {
      pushLine("they waited. but u didn’t come.",      "images/sadbaby.png", "sounds/secret.mp3");
      pushLine("some held hands. others sulked.",       "images/sadbaby.png");
    } else if (total < 5000) {
      pushLine("grobs... confused. multiplying, alone.", "images/sadbaby.png", "sounds/secret.mp3");
      pushLine("they began drawing you from memory.",    "images/sadbaby.png");
    } else {
      pushLine("thousands of grobs... no caretaker.",   "images/sadbaby.png", "sounds/secret.mp3");
      pushLine("they practiced pretending you were there.", "images/sadbaby.png");
    }
  }
  // 7 — Mild Absence (2–7 days; i.e. 48–168 h) — exclusive
  else if (hoursRaw > 48 && daysRaw <= 7) {
    const remarks = [
      "grob waited. they got restless.",
      "it’s been a while, y’know...",
      "ur absence was noted 😐",
      "they made their own fun. it got weird.",
      "they tried roleplaying as you."
    ];
    pushLine(
      remarks[Math.floor(Math.random() * remarks.length)],
      "images/sadbaby.png",
      "sounds/secret.mp3"
    );
  }
  // 8 — Normal Absence (5–48 h) — exclusive
  else if (hoursRaw >= 5 && hoursRaw <= 48) {
    pushLine("welcome back 🌀", "images/baby.png", "sounds/yeah.mp3");

    let msg = "";
    if      (addedGrobs < 20)   msg = "a few grew... quietly.";
    else if (addedGrobs < 100)  msg = "grob multiplied with grace 🌱";
    else if (addedGrobs < 1000) msg = "sooo many new grobs!!!";
    else                         msg = "growth... exponential. grob... unstoppable.";

    pushLine(msg, "images/baby.png", "sounds/multiply.mp3");
  }

  // 9 — Hypergrowth (always stacks)
  if (addedGrobs > 5000) {
    pushLine("uncontrolled propagation detected.", "images/baby.png", "sounds/multiply.mp3");
    pushLine("grobs... overgrew the bounds.",       "images/baby.png");
  }

  // 10 — Final fallback (if still only greeting)
  if (steps.length === 1) {
    const normalFallback = [
      "u were gone. grob didn’t panic. much.",
      "nothing happened. but grob still waited.",
      "time passed. not much. enough.",
      "a soft blink later... and ur back.",
      "no major growth. just... presence.",
      "no one else noticed. grob did.",
      "absence subtle. return noted."
    ];
    const chaoticFallback = [
      `... unacceptable.`,
      `void silence. grob counted the seconds.`,
      `grob bored for most of time.`,
      `grob filed incident report #493.`,
      `grob began self-reflection spiral.`,
      `grob attempted to recreate u. results... inconclusive.`,
      `grob considered hibernation. instead, it stared.`,
      `grob organized a council. they voted to miss u.`,
      `grob started journaling. the ink was... tears.`
    ];
    const pool = Math.random() < 0.5 ? chaoticFallback : normalFallback;
    const line = pool[Math.floor(Math.random() * pool.length)];
    const img  = pool === chaoticFallback ? "images/sadbaby.png" : "images/baby.png";
    const snd  = pool === chaoticFallback ? "sounds/hungry.mp3"   : "sounds/yeah.mp3";
    pushLine(line, img, snd);
  }

  if (steps.length) {
    setTimeout(() => triggerEventSequence(steps), 1000);
  }
}


// ——————————————
// 2) Spawning & Smooth Deaths
// ——————————————
function loadIdleGrobs() {
  const lastTime  = parseInt(localStorage.getItem("grobLastTime")  || "0", "10");
  const lastCount = parseInt(localStorage.getItem("grobLastCount") || "1", "10");
  const now       = Date.now();
  const msHour    = 1000 * 60 * 60;

  const hoursRaw     = (now - lastTime) / msHour;
  const minutesRaw   = hoursRaw * 60;
  const daysRaw      = hoursRaw / 24;

  // build human display
  const totalMinutes = Math.round(hoursRaw * 60);
  let hoursDisplay;
  if (totalMinutes < 60) hoursDisplay = `${totalMinutes} m`;
  else {
    const h = Math.floor(totalMinutes / 60),
          m = totalMinutes % 60;
    hoursDisplay = m ? `${h} h ${m} m` : `${h} h`;
  }

// — 0) stop idle growth if still in tutorial phase
if (!localStorage.getItem("grobFirstMilestoneDone") || !localStorage.getItem("grobSecondMilestoneDone")) {
  console.log("[Idle] Offline growth skipped — still in tutorial stage.");
  updateGrobStorage(); // still update timestamps
  checkOfflineReturnEvents(0, hoursRaw, hoursDisplay, 0);
  return;
}


  // — 1) decide spawn (only for returns ≤ 7 days)
  let addedGrobs = 0;
  if (daysRaw <= 7) {
    for (let h = 0; h < hoursRaw; h++) {
      if (lastCount < 100)     addedGrobs += 5 + Math.floor(Math.random() * 6);
      else                     addedGrobs += Math.floor(
                                   lastCount * (0.02 + Math.random() * 0.01)
                                 );
    }
    spawnIdleGrobs(addedGrobs);
  }

  // — 2) smooth death: for any return ≥ 3 days and < 30 days
  let deaths = 0;
  if (daysRaw >= 3 && daysRaw < 30) {
    // 5% base + 2% per full day over 3, capped at 60%
    const extra     = Math.min(daysRaw - 3, 27) * 0.02;
    const deathRate = Math.min(0.6, 0.05 + extra);
    const population = grobs.length;
    deaths = Math.floor(population * deathRate);

    if (deaths > 0) {
      grobs.splice(0, deaths);
      grobCountDisplay.textContent = grobs.length;
    }
  }

  // — 3) update storage once
  updateGrobStorage();

  // — 4) trigger narrative (now passing `deaths`)
  checkOfflineReturnEvents(addedGrobs, hoursRaw, hoursDisplay, deaths);
}
</script>



<script>
function updateSoundtrackTitle() {
  const current = soundtrackPlaylist[soundtrackIndex];
  const title = current?.title || "Untitled Track";
  document.getElementById("soundtrackTitle").textContent = `Now Playing: ${title}`;
}
function nextSoundtrack() {
  soundtrackIndex = (soundtrackIndex + 1) % soundtrackPlaylist.length;
  playNextSoundtrack(true); // ✅ manual trigger
}

function prevSoundtrack() {
  soundtrackIndex = (soundtrackIndex - 1 + soundtrackPlaylist.length) % soundtrackPlaylist.length;
  if (soundtrackSource) {
    try {
      soundtrackSource.onended = null; // ✅ clear callback
      soundtrackSource.stop();
      soundtrackSource.disconnect();
    } catch (e) {}
  }
  playNextSoundtrack(true); // ✅ manual trigger
}

</script>


<script>
const bgCanvas = document.getElementById('bgCanvas');
const bgCtx = bgCanvas.getContext('2d');

let lastPulse = 0;
let pulseIntensity = 0;
let lastLowEnergy = 0;
let beatPulse = 0;

function drawBackground(audioData) {
  if (!bgCtx || !audioData) return;

  // Resize canvas to match window
  bgCanvas.width = window.innerWidth;
  bgCanvas.height = window.innerHeight;

  // Clear canvas
  bgCtx.clearRect(0, 0, bgCanvas.width, bgCanvas.height);

  // Extract low-frequency energy (0-100 Hz, bass/kick)
  const lowFreqCount = Math.floor(audioData.length * 0.15); // First 15% for lo-fi sensitivity
  let lowFreqEnergy = 0;
  for (let i = 0; i < lowFreqCount; i++) {
    lowFreqEnergy += audioData[i];
  }
  lowFreqEnergy /= lowFreqCount * 255; // Normalize to 0-1

  // Detect beat onset (sensitive to lo-fi kicks)
  const energyDelta = lowFreqEnergy - lastLowEnergy;
  const beatThreshold = 0.05; // Sensitive for soft beats
  if (energyDelta > beatThreshold && lowFreqEnergy > 0.2) {
    beatPulse = 1.2; // Strong pulse trigger
    console.log(`Beat detected: energy=${lowFreqEnergy.toFixed(3)}, delta=${energyDelta.toFixed(3)}`);
  }
  lastLowEnergy = lowFreqEnergy;

  // Fast pulse decay for sharp response
  beatPulse *= 0.8; // Tight decay
  pulseIntensity += (lowFreqEnergy * 0.6 + beatPulse - pulseIntensity) * 0.2; // Responsive smoothing

  // Map intensity to visual properties
  const baseRadius = Math.min(bgCanvas.width, bgCanvas.height) * 0.6;
  const radius = baseRadius + pulseIntensity * 300; // Slightly larger pulse
  const opacity = 0.1 + pulseIntensity * 0.1; // Higher contrast (0.4-1.0)
  const hueShift = pulseIntensity * 60; // Dramatic blue-to-purple shift

  // Create radial gradient
  const gradient = bgCtx.createRadialGradient(
    bgCanvas.width / 2, bgCanvas.height / 2, 0, // Center, inner
    bgCanvas.width / 2, bgCanvas.height / 2, radius // Center, outer
  );
  gradient.addColorStop(0, `hsla(240, 70%, 10%, ${opacity})`); // Deep blue
  gradient.addColorStop(0.5, `hsla(${260 + hueShift}, 80%, 15%, ${opacity * 0.9})`); // Vibrant purple
  gradient.addColorStop(1, `rgba(0, 0, 0, 0)`); // Transparent edge

  // Draw gradient
  bgCtx.fillStyle = gradient;
  bgCtx.fillRect(0, 0, bgCanvas.width, bgCanvas.height);

  // Add pronounced glow effect
  bgCtx.globalCompositeOperation = 'lighter';
  const glowOpacity = 0.12 + pulseIntensity * 0.18; // Stronger glow (0.25-0.55)
  const glowGradient = bgCtx.createRadialGradient(
    bgCanvas.width / 2, bgCanvas.height / 2, 0,
    bgCanvas.width / 2, bgCanvas.height / 2, radius * 2
  );
  glowGradient.addColorStop(0, `hsla(${255 + hueShift}, 70%, 20%, ${glowOpacity})`); // Purple-biased glow
  glowGradient.addColorStop(1, `rgba(0, 0, 0, 0)`); // Fade out
  bgCtx.fillStyle = glowGradient;
  bgCtx.fillRect(0, 0, bgCanvas.width, bgCanvas.height);

  // Reset composite operation
  bgCtx.globalCompositeOperation = 'source-over';
}
</script>

<script>
function startRainVisual() {
  const canvas = document.createElement("canvas");
  canvas.id = "weatherCanvas";
  Object.assign(canvas.style, {
    position: "fixed",
    top: 0,
    left: 0,
    width: "100vw",
    height: "100vh",
    zIndex: 1000,
    pointerEvents: "none",
    imageRendering: "pixelated"
  });
  document.body.appendChild(canvas);

  canvas.style.opacity = "0";
canvas.style.transition = "opacity 2s ease"; // Smooth fade-in
requestAnimationFrame(() => {
  canvas.style.opacity = "1";
});

  const ctx = canvas.getContext("2d");
  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  window.addEventListener("resize", resize);
  resize();

  const raindrops = [];
  const NUM_DROPS = 200;
  const RAIN_COLOR = "rgba(136, 204, 255, 0.2)";
  const RAIN_LENGTH = 20;
  const RAIN_ANGLE = -0.3;

  for (let i = 0; i < NUM_DROPS; i++) {
    raindrops.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      speed: 4 + Math.random() * 3,
    });
  }

  function drawRain() {
    if (!document.getElementById("weatherCanvas")) return;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = RAIN_COLOR;
    ctx.lineWidth = 1;

    ctx.beginPath();
    for (let drop of raindrops) {
      const x1 = drop.x;
      const y1 = drop.y;
      const x2 = x1 + RAIN_ANGLE * RAIN_LENGTH;
      const y2 = y1 + RAIN_LENGTH;

      ctx.moveTo(x1, y1);
      ctx.lineTo(x2, y2);

      drop.y += drop.speed;
      drop.x += RAIN_ANGLE * drop.speed;

      if (drop.y > canvas.height || drop.x < 0 || drop.x > canvas.width) {
        drop.y = -10;
        drop.x = Math.random() * canvas.width;
      }
    }
    ctx.stroke();

    requestAnimationFrame(drawRain);
  }

  drawRain();
}

let rainAudioCtx = null;
let rainGain = null;
let rainSources = [];

function startRainAudio() {
  if (rainAudioCtx && rainAudioCtx.state !== "suspended") return;

  rainAudioCtx = new (window.AudioContext || window.webkitAudioContext)();
  rainGain = rainAudioCtx.createGain();

  // 🌧️ Start at 0 and fade to 0.6 over 3 seconds
  rainGain.gain.setValueAtTime(0, rainAudioCtx.currentTime);
  rainGain.gain.linearRampToValueAtTime(0.6, rainAudioCtx.currentTime + 3);

  rainGain.connect(rainAudioCtx.destination);

  // Load multiple layered rain sources
  for (let i = 0; i < 3; i++) {
    loadAndPlayRain("sounds/rain.mp3", i);
  }

  // Start modulation after a moment
  setTimeout(modulateRainLayers, 3000);

  console.log("[Rain] Audio context initialized and fading in...");
}


function loadAndPlayRain(url, index) {
  fetch(url)
    .then(res => res.arrayBuffer())
    .then(data => rainAudioCtx.decodeAudioData(data))
    .then(buffer => {
      const source = rainAudioCtx.createBufferSource();
      const gain = rainAudioCtx.createGain();
      const panner = rainAudioCtx.createStereoPanner();
      const delay = rainAudioCtx.createDelay();
      const feedback = rainAudioCtx.createGain();
      const filter = rainAudioCtx.createBiquadFilter();

      // 1. Source setup
      source.buffer = buffer;
      source.loop = true;
      source.playbackRate.value = 0.95 + Math.random() * 0.1;

      // 2. Panning (stereo width)
      const pan = -0.9 + Math.random() * 1.8;
      panner.pan.setValueAtTime(pan, rainAudioCtx.currentTime);

      // 3. Volume
      gain.gain.value = 0.3 + Math.random() * 0.3;

      // 4. Filter (muffling effect)
      filter.type = "lowpass";
      filter.frequency.setValueAtTime(8000 + Math.random() * 2000, rainAudioCtx.currentTime);

      // 5. Delay/Echo (spatial depth)
      delay.delayTime.value = 0.05 + Math.random() * 0.1;
      feedback.gain.value = 0.4 + Math.random() * 0.1;
      delay.connect(feedback);
      feedback.connect(delay);

      // 6. Connect audio chain
      source.connect(panner);
      panner.connect(gain);
      gain.connect(filter);
      filter.connect(rainGain);     // direct
      filter.connect(delay);        // echo path
      delay.connect(rainGain);      // delayed signal

      source.start(0);

      // 7. Store layer info for modulation
      rainSources.push({ source, gain, panner, index });

      console.log(`[Rain] Layer ${index} started. Pan: ${pan.toFixed(2)}`);
    })
    .catch(e => console.error(`[Rain] Error loading ${url}`, e));
}



function modulateRainLayers() {
  if (!rainSources.length) return;

  const now = rainAudioCtx.currentTime;

  // Pick one to fade in and one to fade out
  const fadeIn = rainSources[Math.floor(Math.random() * rainSources.length)];
  let fadeOut;
  do {
    fadeOut = rainSources[Math.floor(Math.random() * rainSources.length)];
  } while (fadeOut === fadeIn);

  const dur = 5; // seconds

  fadeIn.gain.gain.cancelScheduledValues(now);
  fadeOut.gain.gain.cancelScheduledValues(now);

  if (Math.abs(fadeIn.gain.gain.value - 0.6) > 0.05) {
  fadeIn.gain.gain.linearRampToValueAtTime(0.6, now + dur);
}
if (Math.abs(fadeOut.gain.gain.value - 0.2) > 0.05) {
  fadeOut.gain.gain.linearRampToValueAtTime(0.2, now + dur);
}

  console.log(`[Rain] Crossfade: Layer ${fadeIn.index} ↑, Layer ${fadeOut.index} ↓`);

  // Loop again after a delay
  setTimeout(modulateRainLayers, 6000 + Math.random() * 3000); // 6–9s
}



function maybeStartRain() {
  const now = Date.now();
  const lastRainStart = parseInt(localStorage.getItem("lastRainStart") || 0);
  const nextRainStart = parseInt(localStorage.getItem("nextRainStart") || 0);
  const currentRainDuration = parseInt(localStorage.getItem("currentRainDuration") || 0);

  if (now >= nextRainStart && now <= nextRainStart + currentRainDuration) {
    // It's within the rain period
    console.log("[Rain] Resuming scheduled rain");
    triggerRainPersistent(); // use persistent trigger so it doesn't reschedule nextRainStart
  } else if (now > nextRainStart + currentRainDuration) {
    // Rain is over, schedule new one
    scheduleNewRain();
  } else {
    // Too early, wait and then trigger
    const wait = nextRainStart - now;
    console.log(`[Rain] Next rain starts in ${(wait / 60000).toFixed(1)} min`);
    setTimeout(() => {
      triggerRainPersistent();
    }, wait);
  }
}

function scheduleNewRain() {
  const now = Date.now();
  const delay = 3600000 + Math.random() * 7200000; // 1–3 hours
  const duration = 1800000 + Math.random() * 1800000; // 30–60 min
  const nextRain = now + delay;

  localStorage.setItem("nextRainStart", nextRain.toString());
  localStorage.setItem("currentRainDuration", duration.toString());

  console.log(`[Rain] Scheduled next rain in ${(delay / 60000).toFixed(1)} min for ${(duration / 60000).toFixed(1)} min`);
}

function triggerRainPersistent() {
  console.log("[Rain DEBUG] triggerRainPersistent() called");

  // TEMP: Always remove old canvas if it somehow exists
  const existing = document.getElementById("weatherCanvas");
  if (existing) {
    console.warn("[Rain DEBUG] Existing canvas found — removing for reset.");
    existing.remove();
  }

  const now = Date.now();
  localStorage.setItem("lastRainStart", now.toString());

  try {
    console.log("[Rain DEBUG] Attempting startRainVisual...");
    startRainVisual();
    console.log("[Rain DEBUG] Visuals started ✅");
  } catch (e) {
    console.error("[Rain ERROR] startRainVisual failed:", e);
  }

  try {
    console.log("[Rain DEBUG] Attempting startRainAudio...");
    startRainAudio();
    console.log("[Rain DEBUG] Audio started ✅");
  } catch (e) {
    console.error("[Rain ERROR] startRainAudio failed:", e);
  }

  const duration = parseInt(localStorage.getItem("currentRainDuration") || 1800000);
  console.log(`[Rain DEBUG] Rain will last ${(duration / 60000).toFixed(1)} minutes`);

  try {
    setTimeout(stopRain, duration);
  } catch (e) {
    console.error("[Rain ERROR] Failed to schedule stopRain:", e);
  }
}

function stopRain() {
  const canvas = document.getElementById("weatherCanvas");
  if (canvas) canvas.remove();

  rainSources.forEach(({ source }) => {
    try { source.stop(); } catch (e) {}
  });
  rainSources = [];

  if (rainGain) rainGain.disconnect();
  if (rainAudioCtx) {
    rainAudioCtx.close().then(() => {
      rainAudioCtx = null;
    });
  }

  scheduleNewRain(); // Schedule future rain
}

["click", "keydown", "mousedown"].forEach(ev =>
  document.addEventListener(ev, async () => {
    if (rainAudioCtx?.state === "suspended") {
      await rainAudioCtx.resume();
    }
    maybeStartRain(); // Start the logic after audio unlock
  }, { once: true })
);

function debugForceRainInOneMinute() {
  const now = Date.now();
  const delay = 10000 + Math.random() * 50000; // 10–60 seconds
  const duration = 1800000 + Math.random() * 1800000; // 30–60 minutes

  localStorage.setItem("nextRainStart", (now + delay).toString());
  localStorage.setItem("currentRainDuration", duration.toString());

  console.log(`[Rain DEBUG] Forced rain to start in ${(delay / 1000).toFixed(1)} seconds for ${(duration / 60000).toFixed(1)} minutes`);
}

maybeStartRain();

</script>





</body>
</html>
