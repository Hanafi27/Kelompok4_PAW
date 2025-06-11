<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Voting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
        }

        :root {
            /* Light Mode Variables */
            --body-bg: #f8f9fa;
            --content-bg: rgba(255, 255, 255, 0.1);
            --card-bg: rgba(255, 255, 255, 0.9);
            --card-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
            --card-border: none;
            --card-backdrop-filter: blur(4px);
            --text-color-title: #2c3e50;
            --text-color-subtitle: #34495e;
            --text-color-card-title: #2c3e50;
            --text-color-card-text: #7f8c8d;
            --btn-primary-bg: linear-gradient(45deg, #4169E1, #1E90FF);
            --btn-primary-hover-bg: linear-gradient(45deg, #1E90FF, #4169E1);
            --btn-outline-primary-border: 2px solid #4169E1;
            --btn-outline-primary-color: #4169E1;
        }

        [data-bs-theme="dark"] {
            /* Dark Mode Variables */
            --body-bg: #212529;
            --content-bg: rgba(0, 0, 0, 0.3); /* Slightly darker overlay */
            --card-bg: rgba(0, 123, 255, 0.2); /* Blue background for cards in dark mode */
            --card-shadow: 0 8px 32px rgba(0, 0, 0, 0.4); /* More prominent shadow in dark mode */
            --card-border: none; /* Hapus border pada card di dark mode */
            --card-backdrop-filter: blur(6px); /* Slightly more blur */
            --text-color-title: #ecf0f1; /* Light text */
            --text-color-subtitle: #bdc3c7; /* Slightly darker light text */
            --text-color-card-title: #ecf0f1;
            --text-color-card-text: #bdc3c7;
            --btn-primary-bg: linear-gradient(45deg, #007bff, #0056b3); /* Blue gradient for primary buttons */
            --btn-primary-hover-bg: linear-gradient(45deg, #0056b3, #007bff); /* Darker blue gradient for hover */
            --btn-outline-primary-border: 2px solid #007bff; /* Blue border for outline buttons */
            --btn-outline-primary-color: #007bff; /* Blue text for outline buttons */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-color-subtitle); /* Default text color for body */
            margin: 0;
            overflow-x: hidden; /* Sembunyikan scrollbar horizontal */
            overflow-y: hidden; /* Sembunyikan scrollbar vertikal */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
            padding: 0; /* Hapus padding agar tidak menambah tinggi total */
        }
        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .content-wrapper {
            position: relative;
            z-index: 2;
            height: 100vh; /* Set tinggi content-wrapper agar pas 100% viewport */
            display: flex;
            align-items: center; /* Tengahkan konten vertikal di dalam content-wrapper */
            background: var(--content-bg); /* Use variable */
            backdrop-filter: var(--card-backdrop-filter); /* Use variable for blur */
             /* Tambahkan overflow: hidden jika ada elemen di dalam yang bisa melebihi tinggi */
            overflow: hidden;
        }
        .card {
            background: var(--card-bg); /* Use variable */
            border: var(--card-border); /* Use variable */
            border-radius: 20px;
            box-shadow: var(--card-shadow); /* Use variable */
            backdrop-filter: var(--card-backdrop-filter); /* Use variable for blur */
            transition: all 0.3s ease; /* Smooth transition */
            margin: 0 !important; /* Pastikan tidak ada margin yang mengganggu */
        }
        .card:hover {
            transform: translateY(-10px);
             box-shadow: var(--card-shadow); /* Keep shadow consistent on hover for simplicity */
        }
        .btn {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: var(--btn-primary-bg); /* Use variable */
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: var(--btn-primary-hover-bg); /* Use variable */
            transform: translateY(-2px);
        }
        .btn-outline-primary {
            border: var(--btn-outline-primary-border); /* Use variable */
            color: var(--btn-outline-primary-color); /* Use variable */
             background-color: transparent; /* Ensure transparent background in light mode */
        }
        .btn-outline-primary:hover {
             background: var(--btn-outline-primary-color); /* Use outline color variable for hover background */
            color: var(--body-bg); /* Use body background for hover text color (opposite theme) */
            transform: translateY(-2px);
        }
        .title-text {
            color: var(--text-color-title); /* Use variable */
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
             transition: color 0.3s ease; /* Smooth transition */
        }
        .subtitle-text {
            color: var(--text-color-subtitle); /* Use variable */
            margin-bottom: 3rem;
             transition: color 0.3s ease; /* Smooth transition */
        }
        .card-title {
            color: var(--text-color-card-title); /* Use variable */
            font-weight: 600;
             transition: color 0.3s ease; /* Smooth transition */
        }
        .card-text {
            color: var(--text-color-card-text); /* Use variable */
             transition: color 0.3s ease; /* Smooth transition */
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000; /* Ensure it's above other content */
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        [data-bs-theme="dark"] .theme-toggle {
             background-color: rgba(0, 0, 0, 0.5); /* Darker semi-transparent background */
             box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .theme-toggle i {
            color: #34495e; /* Icon color in light mode */
             transition: color 0.3s ease;
        }

        [data-bs-theme="dark"] .theme-toggle i {
             color: #ecf0f1; /* Icon color in dark mode */
        }

        .card-body {
             color: var(--text-color-card-text); /* Use variable */
             transition: color 0.3s ease; /* Smooth transition */
             padding: 2.5rem; /* Sedikit kurangi padding dari p-5 (3rem) */
             display: flex; /* Aktifkan Flexbox */
             flex-direction: column; /* Susun konten secara vertikal */
             justify-content: center; /* Tengahkan konten vertikal */
             align-items: center; /* Tengahkan konten horizontal */
         }

    </style>
</head>
<body data-bs-theme="light">
    <div id="canvas-container"></div>
    <button id="theme-toggle" class="theme-toggle">
        <i class="fas fa-moon"></i>
    </button>
    <section class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center mb-5 floating">
                    <h1 class="display-4 title-text">Sistem E-Voting</h1>
                    <p class="lead subtitle-text">Pilih pemimpin yang tepat untuk masa depan kampus kita</p>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center p-5">
                            <h3 class="card-title mb-4">User</h3>
                            <p class="card-text mb-4">Login atau daftar sebagai pemilih</p>
                            <div class="d-grid gap-3">
                                <a href="/login" class="btn btn-primary">Login User</a>
                                <a href="/register" class="btn btn-outline-primary">Register User</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center p-5">
                            <h3 class="card-title mb-4">Admin</h3>
                            <p class="card-text mb-4">Login sebagai administrator sistem</p>
                            <div class="d-grid">
                                <a href="/admin/login" class="btn btn-primary">Login Admin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Three.js setup
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

        // Dark Mode Toggle Script
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const body = document.body;

            // Apply saved theme on load
            const savedTheme = localStorage.getItem('themePreference');
            if (savedTheme) {
                body.setAttribute('data-bs-theme', savedTheme);
                updateToggleIcon(savedTheme);
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                 // Detect system preference if no saved theme
                 body.setAttribute('data-bs-theme', 'dark');
                 updateToggleIcon('dark');
            } else {
                 // Default to light if no preference
                 body.setAttribute('data-bs-theme', 'light');
                 updateToggleIcon('light');
            }

            themeToggleBtn.addEventListener('click', () => {
                const currentTheme = body.getAttribute('data-bs-theme') || 'light';
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                body.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('themePreference', newTheme); // Save preference
                updateToggleIcon(newTheme);
            });

            function updateToggleIcon(theme) {
                const icon = themeToggleBtn.querySelector('i');
                if (theme === 'dark') {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            }
        });

    </script>
</body>
</html>
