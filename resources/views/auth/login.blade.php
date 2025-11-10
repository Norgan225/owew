<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - OWEW</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4B0082;
            --secondary-color: #FF9800;
            --dark-color: #1A1A1A;
            --light-color: #F5F5F5;
            --white: #FFFFFF;
            --text-dark: #333333;
            --text-light: #666666;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, #6a1b9a 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto; /* Permet le scroll si besoin */
        }
        .auth-background { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; opacity: 0.1; }
        .floating-shape { position: absolute; border-radius: 50%; animation: float 20s ease-in-out infinite; }
        .shape1 { width: 300px; height: 300px; background: var(--secondary-color); top: -100px; left: -100px; animation-delay: 0s; }
        .shape2 { width: 200px; height: 200px; background: var(--secondary-color); bottom: -50px; right: -50px; animation-delay: 5s; }
        .shape3 { width: 150px; height: 150px; background: var(--secondary-color); top: 50%; right: 10%; animation-delay: 10s; }
        @keyframes float { 0%, 100% { transform: translateY(0) rotate(0deg);} 33% { transform: translateY(-30px) rotate(120deg);} 66% { transform: translateY(30px) rotate(240deg);} }
        .auth-container { position: relative; z-index: 1; max-width: 1000px; width: 100%; margin: 40px auto; }
        .auth-card { background: var(--white); border-radius: 30px; overflow: hidden; box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3); display: flex; min-height: 600px; }
        .auth-branding { flex: 1; background: linear-gradient(135deg, var(--primary-color), #6a1b9a); padding: 3rem; display: flex; flex-direction: column; justify-content: center; align-items: center; color: var(--white); position: relative; overflow: hidden; }
        .auth-branding::before { content: ''; position: absolute; top: -50%; right: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255, 152, 0, 0.2) 0%, transparent 70%); animation: pulse 15s ease-in-out infinite;}
        @keyframes pulse { 0%, 100% {transform: scale(1);} 50% {transform: scale(1.1);} }
        .auth-logo { width: 120px; height: 120px; margin-bottom: 2rem; position: relative; z-index: 1; animation: fadeInDown 1s ease; }
        .auth-logo img { width: 100%; height: 100%; border-radius: 50%; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); }
        .auth-branding-content { text-align: center; position: relative; z-index: 1; }
        .auth-branding-title { font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; animation: fadeInUp 1s ease 0.2s backwards; }
        .auth-branding-text { font-size: 1.1rem; opacity: 0.9; line-height: 1.8; animation: fadeInUp 1s ease 0.4s backwards; }
        .auth-features { margin-top: 3rem; animation: fadeInUp 1s ease 0.6s backwards; }
        .feature-item { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        .feature-icon { width: 50px; height: 50px; background: rgba(255, 152, 0, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--secondary-color); }
        .feature-text { text-align: left; font-size: 0.95rem; }
        .auth-form-container { flex: 1; padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
        .auth-form-header { margin-bottom: 2rem; }
        .auth-form-title { font-size: 2rem; font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem; }
        .auth-form-subtitle { color: var(--text-light); font-size: 1rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { font-weight: 500; color: var(--text-dark); margin-bottom: 0.5rem; display: block; }
        .form-control { border: 2px solid var(--light-color); border-radius: 12px; padding: 0.9rem 1.2rem; font-size: 1rem; transition: all 0.3s ease; width: 100%; }
        .form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 0.2rem rgba(75, 0, 130, 0.1); outline: none; }
        .input-group { position: relative; }
        .input-icon { position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: var(--text-light); font-size: 1.1rem; pointer-events: none; }
        .input-with-icon { padding-left: 3rem; }
        .password-toggle { position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 1.1rem; transition: color 0.3s ease; }
        .password-toggle:hover { color: var(--primary-color); }
        .form-check { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; }
        .form-check-input { width: 20px; height: 20px; border: 2px solid var(--primary-color); cursor: pointer; }
        .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }
        .form-check-label { color: var(--text-dark); font-size: 0.95rem; cursor: pointer; }
        .btn-auth { width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 600; border: none; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; margin-bottom: 1rem; }
        .btn-primary-auth { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: var(--white); box-shadow: 0 10px 30px rgba(75, 0, 130, 0.3); }
        .btn-primary-auth:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(75, 0, 130, 0.4); }
        .divider { display: flex; align-items: center; text-align: center; margin: 1.5rem 0; }
        .divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid var(--light-color); }
        .divider span { padding: 0 1rem; color: var(--text-light); font-size: 0.9rem; }
        .auth-links { text-align: center; margin-top: 1.5rem; }
        .auth-link { color: var(--primary-color); text-decoration: none; font-weight: 500; transition: color 0.3s ease; }
        .auth-link:hover { color: var(--secondary-color); }
        .forgot-password { text-align: right; margin-top: -0.5rem; margin-bottom: 1.5rem; }
        .forgot-password a { color: var(--primary-color); text-decoration: none; font-size: 0.9rem; transition: color 0.3s ease; }
        .forgot-password a:hover { color: var(--secondary-color); }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px);} to { opacity: 1; transform: translateY(0);} }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px);} to { opacity: 1; transform: translateY(0);} }
        .alert-custom { padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;}
        .alert-success { background: rgba(76, 175, 80, 0.1); border: 1px solid rgba(76, 175, 80, 0.3); color: #2e7d32; }
        .alert-error { background: rgba(244, 67, 54, 0.1); border: 1px solid rgba(244, 67, 54, 0.3); color: #c62828;}
        .back-to-home { position: absolute; top: 2rem; left: 2rem; z-index: 10; }
        .back-btn { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); color: var(--white); padding: 0.7rem 1.5rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: all 0.3s ease;}
        .back-btn:hover { background: rgba(255, 255, 255, 0.3); transform: translateX(-5px);}
        @media (max-width: 768px) {
            .auth-card { flex-direction: column;}
            .auth-branding { padding: 2rem; min-height: 300px;}
            .auth-logo { width: 80px; height: 80px;}
            .auth-branding-title { font-size: 2rem;}
            .auth-features { display: none;}
            .auth-form-container { padding: 2rem;}
            .auth-form-title { font-size: 1.5rem;}
            .back-to-home { top: 1rem; left: 1rem;}
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="auth-background">
        <div class="floating-shape shape1"></div>
        <div class="floating-shape shape2"></div>
        <div class="floating-shape shape3"></div>
    </div>

    <!-- Back to Home Button -->
    <div class="back-to-home">
        <a href="/" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour à l'accueil
        </a>
    </div>

    <!-- PAGE LOGIN -->
    <div class="auth-container" id="loginPage">
        <div class="auth-card">
            <div class="auth-branding">
                <div class="auth-logo">
                    <img src="{{ asset('frontend/img/logos/logo.png') }}" alt="OWEW Logo" height="30">
                </div>
                <div class="auth-branding-content">
                    <h1 class="auth-branding-title">Bienvenue sur OWEW</h1>
                    <p class="auth-branding-text">
                        Connectez-vous pour accéder à votre espace personnel et suivre l'impact de vos contributions.
                    </p>
                </div>
                <div class="auth-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="feature-text">
                            Suivez vos dons en temps réel
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="feature-text">
                            Recevez des notifications sur les projets
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="feature-text">
                            Rejoignez notre communauté
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth-form-container">
                <div class="auth-form-header">
                    <h2 class="auth-form-title">Connexion</h2>
                    <p class="auth-form-subtitle">Entrez vos identifiants pour accéder à votre compte</p>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Messages d'erreur globaux -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Message de succès (après inscription) -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label" for="email">Adresse Email</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input
                                type="email"
                                class="form-control input-with-icon @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="votre@email.com"
                                required
                                autofocus>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Mot de passe</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input
                                type="password"
                                class="form-control input-with-icon @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required>
                            <button type="button" class="password-toggle" onclick="togglePass('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-auth btn-primary-auth">
                        <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                    </button>

                    <div class="auth-links">
                        <p class="mb-0">
                            Pas encore de compte ?
                            <a href="{{ route('register') }}" class="auth-link">Créer un compte</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Script pour mot de passe et switch -->
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');
            if (input.type === "password") {
                input.type = "text";
                if (icon) icon.classList.remove('fa-eye');
                if (icon) icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                if (icon) icon.classList.remove('fa-eye-slash');
                if (icon) icon.classList.add('fa-eye');
            }
        }
        function switchToRegister() {
            document.getElementById('loginPage').style.display = 'none';
            document.getElementById('registerPage').style.display = 'block';
            window.scrollTo(0, 0);
        }
        function switchToLogin() {
            document.getElementById('registerPage').style.display = 'none';
            document.getElementById('loginPage').style.display = 'block';
            window.scrollTo(0, 0);
        }
    </script>
</body>
</html>
