<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin - E-Voting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        :root {
            --primary-color: #4169E1;
            --secondary-color: #1E90FF;
            --bg-light: #f8f9fa;
            --bg-dark: #1a1d21;
            --text-light: #2c3e50;
            --text-dark: #e9ecef;
            --card-bg-light: rgba(255, 255, 255, 0.9);
            --card-bg-dark: rgba(33, 37, 41, 0.9);
            --transition-speed: 0.3s;
        }

        [data-bs-theme="dark"] {
            --bs-body-bg: var(--bg-dark);
            --bs-body-color: var(--text-dark);
        }

        body {
            font-family: 'Poppins', sans-serif;
            transition: background-color var(--transition-speed), color var(--transition-speed);
            min-height: 100vh;
            overflow-x: hidden;
        }

        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.5;
        }

        .admin-wrapper {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 280px;
            background: var(--card-bg-light);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed);
            height: 100vh;
            position: fixed;
        }

        [data-bs-theme="dark"] .sidebar {
            background: var(--card-bg-dark);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: all var(--transition-speed);
        }

        .nav-link {
            color: var(--text-light);
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            margin: 0.3rem 1rem;
            transition: all var(--transition-speed);
        }

        [data-bs-theme="dark"] .nav-link {
            color: var(--text-dark);
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateX(5px);
        }

        .card {
            background: var(--card-bg-light);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            backdrop-filter: blur(4px);
            transition: all var(--transition-speed);
        }

        [data-bs-theme="dark"] .card {
            background: var(--card-bg-dark);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.2);
        }

        .theme-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            background: var(--card-bg-light);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed);
        }

        [data-bs-theme="dark"] .theme-toggle {
            background: var(--card-bg-dark);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        .stats-card {
            padding: 1.5rem;
            border-radius: 15px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            transition: all var(--transition-speed);
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div id="canvas-container"></div>
    
    <div class="admin-wrapper">
        <div class="sidebar">
            <div class="p-4">
                <h4 class="mb-4">Panel Admin</h4>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="/admin/dashboard">
                        <i class="bi bi-speedometer2 me-2"></i> Dasbor
                    </a>
                    <a class="nav-link" href="/admin/users">
                        <i class="bi bi-people me-2"></i> Pengguna
                    </a>
                    <a class="nav-link" href="/admin/candidates">
                        <i class="bi bi-person-badge me-2"></i> Kandidat
                    </a>
                    <a class="nav-link" href="/admin/votes">
                        <i class="bi bi-check2-square me-2"></i> Suara
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <button class="theme-toggle" id="themeToggle">
        <i class="bi bi-moon-fill"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Three.js Background
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('canvas-container').appendChild(renderer.domElement);

        // Create particles
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 2000;
        const posArray = new Float32Array(particlesCount * 3);

        for(let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 5;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.005,
            color: '#4169E1',
            transparent: true,
            opacity: 0.8
        });

        const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particlesMesh);

        camera.position.z = 2;

        // Animation
        function animate() {
            requestAnimationFrame(animate);
            particlesMesh.rotation.x += 0.0005;
            particlesMesh.rotation.y += 0.0005;
            renderer.render(scene, camera);
        }

        animate();

        // Handle window resize
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const icon = themeToggle.querySelector('i');

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            html.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);
        }

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            icon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
        }
    </script>
</body>
</html> 