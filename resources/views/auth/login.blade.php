<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-Voting | Login</title>

        <link href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

                /* Dark Mode specific styles for login/register/admin login */
                /* Menargetkan card dengan lebih spesifik */
                body[data-bs-theme="dark"] .card,
                body[data-bs-theme="dark"] .card.card-outline,
                body[data-bs-theme="dark"] .card.card-primary {
                    background-color: var(--card-bg-dark) !important; /* Gunakan variabel dark mode dengan !important */
                    color: var(--text-color-dark) !important; /* Gunakan variabel dark mode dengan !important */
                    border-color: var(--card-border-dark) !important; /* Gunakan variabel dark mode dengan !important */
                }

                body[data-bs-theme="dark"] .card-header {
                    background-color: transparent !important; /* Pastikan transparan di dark mode jika header card tidak perlu warna biru */
                    border-bottom-color: var(--card-border-dark) !important; /* Gunakan variabel dark mode dengan !important */
                    color: var(--text-color-dark) !important; /* Gunakan variabel dark mode dengan !important */
                }

                body[data-bs-theme="dark"] .card-body {
                    color: var(--text-color-dark) !important; /* Gunakan variabel dark mode dengan !important */
                }

                body[data-bs-theme="dark"] .form-control {
                     background-color: var(--input-bg-dark) !important;
                     border-color: var(--input-border-dark) !important;
                     color: var(--text-color-dark) !important;
                 }

                 body[data-bs-theme="dark"] .form-control:focus {
                     border-color: var(--link-color-dark) !important; /* Highlight with dark mode link color */
                     box-shadow: 0 0 0 0.25rem rgba(137, 180, 244, 0.25) !important; /* Dark mode shadow */
                 }

                 body[data-bs-theme="dark"] .input-group-text {
                     background-color: var(--card-bg-dark) !important; /* Match card background in dark mode */
                     border-color: var(--input-border-dark) !important;
                     color: var(--text-color-dark) !important;
                 }

                body[data-bs-theme="dark"] p.mb-1 a,
                body[data-bs-theme="dark"] p.mb-0 a {
                    color: var(--link-color-dark) !important; /* Gunakan variabel dark mode */
                }

                body[data-bs-theme="dark"] .btn-primary {
                     background-color: var(--button-primary-background) !important; /* Gunakan variabel dark mode dengan !important */
                     border-color: var(--button-primary-background) !important; /* Gunakan variabel dark mode dengan !important */
                     color: var(--button-primary-color) !important; /* Gunakan variabel dark mode dengan !important */
                 }

                 body[data-bs-theme="dark"] .btn-primary:hover {
                      background-color: var(--button-primary-hover) !important; /* Gunakan variabel dark mode hover dengan !important */
                      border-color: var(--button-primary-hover) !important; /* Gunakan variabel dark mode hover dengan !important */
                 }

                body[data-bs-theme="dark"] .theme-toggle i {
                    color: var(--text-color-dark) !important; /* Icon color in dark mode */
                }

            }

            body.login-page {
                /* Fallback for no theme attribute, uses light mode vars */
                background-color: var(--body-bg-light);
                color: var(--text-color-light);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 30px 15px; /* Add some padding for small screens */
                transition: background-color 0.3s ease, color 0.3s ease;
                position: relative; /* Needed for z-index context */
                z-index: 1; /* Ensure body is above canvas */
                overflow: hidden; /* Hide scrollbars */
            }

            /* Apply dark mode background and text color if theme attribute is set */
            body.login-page[data-bs-theme="dark"] {
                background-color: var(--body-bg-dark);
                color: var(--text-color-dark);
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

            .login-box {
                width: 360px; /* Standard AdminLTE width */
                margin: 0 auto; /* Center the box */
                background-color: var(--login-box-bg-light);
                box-shadow: var(--login-box-shadow-light);
                border-radius: 10px; /* Rounded corners for the box */
                overflow: hidden; /* Ensure card corners match */
                transition: background-color 0.3s ease, box-shadow 0.3s ease;
                position: relative; /* Ensure login-box is above canvas */
                z-index: var(--content-z-index); /* Use variable for z-index */
                 backdrop-filter: var(--content-backdrop-filter); /* Apply blur behind login box */
            }

            /* Apply dark mode styles to login box */
            body[data-bs-theme="dark"] .login-box {
                 background-color: var(--login-box-bg-dark);
                 box-shadow: var(--login-box-shadow-dark);
                 backdrop-filter: var(--content-backdrop-filter);
            }

             @media (max-width: 576px) {
                .login-box {
                    width: 95%; /* Make box take more width on small screens */
                }
             }

            .card {
                 background-color: var(--card-bg-light);
                 color: var(--text-color-light);
                 border: var(--card-border-light);
                 box-shadow: none; /* Remove default card shadow inside login-box */
                 border-radius: 0; /* Remove default card radius inside login-box */
                 margin-bottom: 0; /* Remove bottom margin */
                 transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            }

             /* Apply dark mode styles to card */
             body[data-bs-theme="dark"] .card {
                 background-color: var(--card-bg-dark);
                 color: var(--text-color-dark);
                 border: var(--card-border-dark);
             }

            .card-header {
                 background-color: transparent; /* Use transparent header */
                 border-bottom: var(--card-border-light); /* Border from variable */
                 color: var(--text-color-light);
                 transition: border-color 0.3s ease, color 0.3s ease;
            }
            body[data-bs-theme="dark"] .card-header {
                 border-bottom: var(--card-border-dark);
                 color: var(--text-color-dark);
             }

            .card-body {
                 color: var(--text-color-light);
                 transition: color 0.3s ease;
            }
             body[data-bs-theme="dark"] .card-body {
                 color: var(--text-color-dark);
             }

             .form-control {
                 background-color: var(--input-bg-light);
                 border-color: var(--input-border-light);
                 color: var(--text-color-light);
                 transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
             }
             body[data-bs-theme="dark"] .form-control {
                 background-color: var(--input-bg-dark);
                 border-color: var(--input-border-dark);
                 color: var(--text-color-dark);
             }

             .form-control:focus {
                 border-color: var(--link-color-light); /* Highlight with primary color */
                 box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Bootstrap primary shadow */
             }
              body[data-bs-theme="dark"] .form-control:focus {
                 border-color: var(--link-color-dark); /* Highlight with dark mode link color */
                 box-shadow: 0 0 0 0.25rem rgba(137, 180, 244, 0.25); /* Dark mode shadow */
             }

             .input-group-text {
                 background-color: var(--card-bg-light); /* Match card background */
                 border-color: var(--input-border-light);
                 color: var(--text-color-light);
                  transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
             }
              body[data-bs-theme="dark"] .input-group-text {
                 background-color: var(--card-bg-dark);
                 border-color: var(--input-border-dark);
                 color: var(--text-color-dark);
             }

             .form-control.is-invalid ~ .input-group-append .input-group-text {
                 border-color: #dc3545; /* Error color */
             }

            /* Adjust link colors for dark mode */
             p.mb-1 a, p.mb-0 a {
                 color: var(--link-color-light);
                 transition: color 0.3s ease;
             }
             body[data-bs-theme="dark"] p.mb-1 a, body[data-bs-theme="dark"] p.mb-0 a {
                 color: var(--link-color-dark);
             }

            /* Adjust button styles for dark mode */
             .btn-primary {
                 background-color: var(--button-primary-background);
                 border-color: var(--button-primary-background);
                 color: var(--button-primary-color);
                 transition: all 0.3s ease;
             }
             body[data-bs-theme="dark"] .btn-primary {
                  background-color: var(--button-primary-background); /* Use dark mode primary */
                  border-color: var(--button-primary-background);
                  color: var(--button-primary-color);
             }

             .btn-primary:hover {
                 opacity: 0.9; /* Subtle hover effect */
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
    <body class="hold-transition login-page" data-bs-theme="light">
        <div id="canvas-container"></div>
        <button id="theme-toggle" class="theme-toggle">
            <i class="fas fa-moon"></i>
        </button>
        <div class="login-box">

            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>E-Voting</b></a>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                            Remember Me
                            </label>
                            </div>
                        </div>

                        <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>

                        </div>
                    </form>

                    <p class="mb-1">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Don't have an account? Register</a>
                    </p>
                </div>

            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

         <script>
             const scene = new THREE.Scene();
             const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
             const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
             renderer.setSize(window.innerWidth, window.innerHeight);
             document.getElementById('canvas-container').appendChild(renderer.domElement);

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

             function animate() {
                 requestAnimationFrame(animate);
                 particlesMesh.rotation.x += 0.0005;
                 particlesMesh.rotation.y += 0.0005;
                 renderer.render(scene, camera);
             }

             animate();

             window.addEventListener('resize', () => {
                 camera.aspect = window.innerWidth / window.innerHeight;
                 camera.updateProjectionMatrix();
                 renderer.setSize(window.innerWidth, window.innerHeight);
             });

            document.addEventListener('DOMContentLoaded', () => {
                const themeToggleBtn = document.getElementById('theme-toggle');
                const body = document.body;

                const savedTheme = localStorage.getItem('themePreference');
                if (savedTheme) {
                    body.setAttribute('data-bs-theme', savedTheme);
                    updateToggleIcon(savedTheme);
                } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                     body.setAttribute('data-bs-theme', 'dark');
                     updateToggleIcon('dark');
                } else {
                     body.setAttribute('data-bs-theme', 'light');
                     updateToggleIcon('light');
                }

                if (themeToggleBtn) {
                    themeToggleBtn.addEventListener('click', () => {
                        const currentTheme = body.getAttribute('data-bs-theme') || 'light';
                        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                        body.setAttribute('data-bs-theme', newTheme);
                        localStorage.setItem('themePreference', newTheme);
                        updateToggleIcon(newTheme);
                    });
                }

                function updateToggleIcon(theme) {
                     if (!themeToggleBtn) return;
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
