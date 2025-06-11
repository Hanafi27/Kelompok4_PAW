<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - E-Voting</title>
    {{-- Menggunakan Bootstrap 5 CSS untuk dark mode theme attribute --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Tambahkan link untuk Font Awesome 6 untuk ikon toggle tema --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            /* Light Mode Variables */
            --body-bg-light: #f8f9fa;
            --card-bg-light: #ffffff;
            --card-border-light: 1px solid #e9ecef;
            --text-color-light: #343a40;
            --link-color-light: #007bff;
            --button-primary-background: #007bff; /* Warna biru utama */
            --button-primary-color: #ffffff;
            --button-primary-hover: #0056b3; /* Warna biru lebih gelap untuk hover */
            /* Variables for 3D background compatibility */
            --canvas-z-index: 1;
            --content-z-index: 2;
            --content-bg: rgba(255, 255, 255, 0.1);
            --content-backdrop-filter: blur(10px);
        }

        [data-bs-theme="dark"] {
            --body-bg-dark: #212529;
            --card-bg-dark: #1E90FF; /* Menggunakan warna biru yang diminta */
            --card-border-dark: none;
            --text-color-dark: #ffffff;
            --link-color-dark: #ffffff;
            --button-primary-background: #1E90FF; /* Menggunakan warna biru yang diminta */
            --button-primary-color: #ffffff;
            --button-primary-hover: #1873CC; /* Warna hover yang sedikit lebih gelap */
            /* Variables for 3D background compatibility in dark mode */
            --content-bg: rgba(0, 0, 0, 0.5);
            --content-backdrop-filter: blur(8px);
        }

        /* Ensure html and body take full viewport height and prevent scroll */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Prevent scrollbars */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--body-bg-light); /* Use variable */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center; /* Center content horizontally */
            position: relative; /* Needed for z-index context */
            z-index: 1; /* Ensure body is above canvas */
            transition: background-color 0.3s ease, color 0.3s ease; /* Add transition */
        }

        /* Apply dark mode background and text color if theme attribute is set */
        body[data-bs-theme="dark"] {
            background: var(--body-bg-dark); /* Use dark mode variable */
            color: var(--text-color-dark); /* Use dark mode variable */
        }

        /* Style for 3D background container */
         #canvas-container {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             z-index: var(--canvas-z-index); /* Use variable for z-index */
             pointer-events: none; /* Allow clicks to pass through canvas */
         }

        .login-container {
            background: var(--box-bg-light); /* Use variable */
            border-radius: 20px;
            box-shadow: var(--box-shadow-light); /* Use variable */
            backdrop-filter: var(--content-backdrop-filter); /* Use variable */
            -webkit-backdrop-filter: var(--content-backdrop-filter); /* For Safari */
            padding: 2rem;
            max-width: 400px;
            width: 100%;
            margin: 0 auto; /* Ensure centering */
            position: relative; /* Ensure container is above canvas */
            z-index: var(--content-z-index); /* Use variable for z-index */
            transition: background 0.3s ease, box-shadow 0.3s ease, backdrop-filter 0.3s ease;
        }

        /* Apply dark mode styles to login container */
        body[data-bs-theme="dark"] .login-container {
             background: var(--box-bg-dark);
             box-shadow: var(--box-shadow-dark);
             backdrop-filter: var(--content-backdrop-filter);
             -webkit-backdrop-filter: var(--content-backdrop-filter);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h1 {
            color: var(--text-color-light); /* Use variable */
            font-weight: 600;
            font-size: 1.8rem;
             transition: color 0.3s ease;
        }
         body[data-bs-theme="dark"] .login-header h1 {
             color: var(--text-color-dark);
         }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem 1rem;
            border: var(--input-border-light); /* Use variable */
            background: var(--input-bg-light); /* Use variable */
            color: var(--text-color-light); /* Use variable */
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        body[data-bs-theme="dark"] .form-control {
             border: var(--input-border-dark);
             background: var(--input-bg-dark);
             color: var(--text-color-dark);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(65, 105, 225, 0.25);
            border-color: #4169E1;
        }
        body[data-bs-theme="dark"] .form-control:focus {
             /* Adjust focus styles for dark mode */
             box-shadow: 0 0 0 0.2rem rgba(137, 180, 244, 0.25);
             border-color: #89b4f4;
        }

        .btn-login {
            background: var(--button-primary-background); /* Use variable */
            border: var(--button-primary-border-light); /* Use variable */
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 500;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
             color: var(--button-primary-color); /* Ensure text is white */
        }
        body[data-bs-theme="dark"] .btn-login {
             background: var(--button-primary-background);
             border: var(--button-primary-border-dark);
        }

        .btn-login:hover {
            background: var(--button-primary-hover); /* Use variable */
            transform: translateY(-2px);
        }
         body[data-bs-theme="dark"] .btn-login:hover {
              background: var(--button-primary-hover); /* Adjust hover effect for dark mode */
         }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        .back-link a {
            color: var(--link-color-light); /* Use variable */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
         body[data-bs-theme="dark"] .back-link a {
             color: var(--link-color-dark);
         }

        .back-link a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 1rem;
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

    </style>
</head>
{{-- Add data-bs-theme attribute based on user preference or system setting if needed --}}
<body data-bs-theme="light"> {{-- Default to light --}}
     <div id="canvas-container"></div> {{-- Container for 3D animation --}}
    {{-- Theme Toggle Button --}}
    <button id="theme-toggle" class="theme-toggle">
        <i class="fas fa-moon"></i> {{-- Default icon (moon for light mode) --}}
    </button>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h1>Login Admin</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">Login</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script for 3D animation and Dark Mode toggle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script> {{-- Three.js --}}
    {{-- Pastikan versi Bootstrap 5 JS dimuat untuk data-bs-theme dan modal --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

     <script>
         // 3D Animation Setup (Copy from welcome.blade.php)
         const scene = new THREE.Scene();
         const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
         const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
         renderer.setSize(window.innerWidth, window.innerHeight);
         // Append canvas to body or a specific container if needed
         document.getElementById('canvas-container').appendChild(renderer.domElement);

         // Create particles
         const particlesGeometry = new THREE.BufferGeometry();
         const particlesCount = 2000; // Adjust particle count as needed
         const posArray = new Float32Array(particlesCount * 3);

         for(let i = 0; i < particlesCount * 3; i++) {
             posArray[i] = (Math.random() - 0.5) * 5; // Adjust particle distribution
         }

         particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

         const particlesMaterial = new THREE.PointsMaterial({
             size: 0.005, // Adjust particle size
             color: '#4169E1', // Particle color
             transparent: true,
             opacity: 0.8 // Particle opacity
         });

         const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
         scene.add(particlesMesh);

         camera.position.z = 2; // Adjust camera position

         // Animation
         function animate() {
             requestAnimationFrame(animate);
             particlesMesh.rotation.x += 0.0005; // Adjust rotation speed
             particlesMesh.rotation.y += 0.0005; // Adjust rotation speed
             renderer.render(scene, camera);
         }

         animate();

         // Handle window resize
         window.addEventListener('resize', () => {
             camera.aspect = window.innerWidth / window.innerHeight;
             camera.updateProjectionMatrix();
             renderer.setSize(window.innerWidth, window.innerHeight);
         });


        // Dark Mode Toggle Script (Copy from welcome.blade.php)
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

            if (themeToggleBtn) { // Check if button exists
                themeToggleBtn.addEventListener('click', () => {
                    const currentTheme = body.getAttribute('data-bs-theme') || 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    body.setAttribute('data-bs-theme', newTheme);
                    localStorage.setItem('themePreference', newTheme); // Save preference
                    updateToggleIcon(newTheme);
                });
            }

            function updateToggleIcon(theme) {
                 if (!themeToggleBtn) return; // Exit if button doesn't exist
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