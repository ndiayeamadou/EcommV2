<div class="relative min-h-[80vh] flex flex-col items-center justify-center overflow-hidden bg-gradient-to-b from-purple-100 to-white">
    <!-- Canvas for Fireworks -->
    <canvas id="fireworksCanvas" class="fixed inset-0 pointer-events-none z-0 opacity-80"></canvas>

    <!-- Confetti Container -->
    <div id="confettiContainer" class="fixed inset-0 pointer-events-none overflow-hidden"></div>
    
    <!-- Main Content -->
    <div id="thankYouContent" class="z-10 text-center max-w-3xl px-6 py-16 transition-all duration-1000 opacity-0 translate-y-10">
        <div class="animate-bounce mb-6">
            <svg class="w-16 h-16 mx-auto text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 animate-scale-in">
            Merci pour votre achat!
        </h1>
        
        <p class="text-xl text-gray-600 mb-8 animate-fade-in" style="animation-delay: 0.5s">
            Votre commande a été reçue et est en cours de traitement.
            Un email de confirmation a été envoyé à votre adresse.
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in" style="animation-delay: 0.8s">
            <a href="{{ route('home') }}" wire:navigate class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white flex items-center justify-center gap-2 px-5 py-3 rounded-md transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Retour à l'accueil</span>
            </a>
            <a href="{{ route('products') }}" wire:navigate class="w-full sm:w-auto border border-purple-600 text-purple-600 hover:bg-purple-50 flex items-center justify-center gap-2 px-5 py-3 rounded-md transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span>Continuer vos achats</span>
            </a>
        </div>
        
        <div class="mt-16 animate-fade-in" style="animation-delay: 1s">
            {{-- <p class="text-gray-500 mb-2">Numéro de commande: <span class="font-medium">{{ $orderNumber }}</span></p> --}}
            <p class="text-gray-500 mb-2">Numéro de commande: <span class="font-medium">CMD-0000000000</span></p>
            <p class="text-gray-500">Nous vous contacterons dès que votre colis sera expédié.</p>
        </div>
    </div>


<!-- Animation Styles -->
<style>
    @keyframes fall {
        0% {
            transform: translateY(-10px) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0.3;
        }
    }
    
    @keyframes fade-in {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes scale-in {
        0% {
            transform: scale(0.95);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }
    
    .animate-scale-in {
        animation: scale-in 0.2s ease-out forwards;
    }
</style>

<!-- Animation Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show content with animation
    setTimeout(() => {
        document.getElementById('thankYouContent').classList.remove('opacity-0', 'translate-y-10');
    }, 300);
    
    // Initialize confetti
    createConfetti();
    
    // Initialize fireworks
    initFireworks();
});

// Confetti Animation
function createConfetti() {
    const confettiContainer = document.getElementById('confettiContainer');
    const colors = [
        '#FF5370', '#FFCB6B', '#82AAFF', '#C3E88D', '#F78C6C', '#C792EA', '#89DDFF', '#FFFFFF'
    ];
    
    // Create 100 confetti pieces
    for (let i = 0; i < 100; i++) {
        const confetti = document.createElement('div');
        
        const size = Math.random() * 8 + 5; // 5-13px
        const animationDuration = Math.random() * 5 + 7; // 7-12s
        const delay = Math.random() * 7; // 0-7s
        
        confetti.style.position = 'absolute';
        confetti.style.left = `${Math.random() * 100}%`;
        confetti.style.top = `-10px`;
        confetti.style.width = `${size}px`;
        confetti.style.height = `${size}px`;
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.borderRadius = '4px';
        confetti.style.opacity = '0.8';
        confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
        confetti.style.animation = `fall ${animationDuration}s linear ${delay}s infinite`;
        
        confettiContainer.appendChild(confetti);
    }
}

// Fireworks Animation
function initFireworks() {
    const canvas = document.getElementById('fireworksCanvas');
    const ctx = canvas.getContext('2d');
    
    // Set canvas to full screen
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    // Handle window resize
    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    });
    
    // Colors for fireworks
    const colors = [
        '#FF5370', '#FFCB6B', '#82AAFF', '#C3E88D', '#F78C6C', '#C792EA', '#89DDFF'
    ];
    
    let fireworks = [];
    let particles = [];
    
    // Firework class
    class Firework {
        constructor(startX, startY, targetX, targetY) {
            // Position
            this.x = startX;
            this.y = startY;
            
            // Target coordinates
            this.targetY = targetY;
            this.targetX = targetX;
            
            // Speed and direction
            const angle = Math.atan2(targetY - startY, targetX - startX);
            this.speed = 5;
            this.angle = angle;
            this.friction = 0.99;
            this.gravity = 0.2;
            
            // Visual properties
            this.hue = colors[Math.floor(Math.random() * colors.length)];
            this.brightness = Math.random() * 50 + 50;
            this.alpha = 1;
            this.radius = 2;
            
            // Trail effect
            this.coordinates = [];
            this.coordinateCount = 3;
            
            while (this.coordinateCount--) {
                this.coordinates.push([this.x, this.y]);
            }
        }
        
        update(index) {
            // Update previous coordinates
            this.coordinates.pop();
            this.coordinates.unshift([this.x, this.y]);
            
            // Apply friction
            this.speed *= this.friction;
            
            // Calculate movement
            const velX = Math.cos(this.angle) * this.speed;
            const velY = Math.sin(this.angle) * this.speed + this.gravity;
            
            // Update position
            this.x += velX;
            this.y += velY;
            
            // Check if firework has reached target
            if (this.y <= this.targetY) {
                // Create explosion particles
                const particleCount = 80;
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle(this.x, this.y));
                }
                
                // Remove firework
                fireworks.splice(index, 1);
            }
        }
        
        draw() {
            ctx.beginPath();
            
            // Move to last tracked coordinate in the set, then draw line to current x,y
            ctx.moveTo(this.coordinates[this.coordinates.length - 1][0], this.coordinates[this.coordinates.length - 1][1]);
            ctx.lineTo(this.x, this.y);
            ctx.strokeStyle = this.hue;
            ctx.lineWidth = this.radius;
            ctx.stroke();
        }
    }
    
    // Particle class (explosion particles)
    class Particle {
        constructor(x, y) {
            // Position
            this.x = x;
            this.y = y;
            
            // Movement
            this.angle = Math.random() * Math.PI * 2;
            this.speed = Math.random() * 10 + 2;
            this.friction = 0.95;
            this.gravity = 0.2;
            
            // Visual properties
            this.hue = colors[Math.floor(Math.random() * colors.length)];
            this.brightness = Math.random() * 50 + 50;
            this.alpha = 1;
            this.decay = Math.random() * 0.03 + 0.015;
            this.radius = Math.random() * 3 + 1;
            
            // Trail effect
            this.coordinates = [];
            this.coordinateCount = 5;
            
            while (this.coordinateCount--) {
                this.coordinates.push([this.x, this.y]);
            }
        }
        
        update(index) {
            // Update previous coordinates
            this.coordinates.pop();
            this.coordinates.unshift([this.x, this.y]);
            
            // Slow down
            this.speed *= this.friction;
            
            // Apply gravity and calculate movement
            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed + this.gravity;
            
            // Fade out
            this.alpha -= this.decay;
            
            // Remove when invisible
            if (this.alpha <= this.decay) {
                particles.splice(index, 1);
            }
        }
        
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
            ctx.fillStyle = `hsla(${this.hue}, 100%, ${this.brightness}%, ${this.alpha})`;
            ctx.fill();
        }
    }
    
    // Launch fireworks periodically
    function launchFirework() {
        const startX = Math.random() * canvas.width;
        const startY = canvas.height;
        const targetX = Math.random() * canvas.width;
        const targetY = Math.random() * (canvas.height * 0.6);
        
        fireworks.push(new Firework(startX, startY, targetX, targetY));
    }
    
    // Initial fireworks
    for (let i = 0; i < 3; i++) {
        setTimeout(() => {
            launchFirework();
        }, i * 500);
    }
    
    // Launch fireworks periodically
    setInterval(() => {
        if (Math.random() < 0.3) { // 30% chance to launch a new firework
            launchFirework();
        }
    }, 1000);
    
    // Animation loop
    function animate() {
        // Clear canvas with semi-transparent black to create trail effect
        ctx.fillStyle = 'rgba(0, 0, 0, 0.2)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Update and draw fireworks
        for (let i = fireworks.length - 1; i >= 0; i--) {
            fireworks[i].draw();
            fireworks[i].update(i);
        }
        
        // Update and draw particles
        for (let i = particles.length - 1; i >= 0; i--) {
            particles[i].draw();
            particles[i].update(i);
        }
        
        // Loop animation
        requestAnimationFrame(animate);
    }
    
    animate();
}
</script>

</div>