<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance en cours - OWEW</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #4B0082;
            --secondary: #FF9800;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #6a1b9a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
            position: relative;
        }

        /* Animated background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: backgroundScroll 60s linear infinite;
        }

        @keyframes backgroundScroll {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }

        .maintenance-container {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 600px;
            padding: 2rem;
        }

        .maintenance-icon {
            width: 150px;
            height: 150px;
            margin: 0 auto 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.2);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.7);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(255, 152, 0, 0);
            }
        }

        .maintenance-icon i {
            font-size: 5rem;
            color: var(--secondary);
        }

        .maintenance-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .maintenance-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .maintenance-description {
            font-size: 1.1rem;
            opacity: 0.8;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin-top: 2rem;
        }

        .contact-card h4 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }

        .contact-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-size: 1.1rem;
            margin-top: 1rem;
        }

        .contact-info i {
            color: var(--secondary);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-link {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .social-link:hover {
            background: var(--secondary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 152, 0, 0.4);
        }

        .spinner {
            margin: 2rem auto;
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--secondary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-back-home {
            display: inline-block;
            margin-top: 2rem;
            padding: 1rem 2.5rem;
            background: var(--secondary);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(255, 152, 0, 0.3);
        }

        .btn-back-home:hover {
            background: #e68900;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 152, 0, 0.5);
            color: white;
        }

        @media (max-width: 768px) {
            .maintenance-title {
                font-size: 2rem;
            }

            .maintenance-subtitle {
                font-size: 1rem;
            }

            .maintenance-icon {
                width: 120px;
                height: 120px;
            }

            .maintenance-icon i {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">
            <i class="fas fa-tools"></i>
        </div>

        <h1 class="maintenance-title">Maintenance en Cours</h1>
        <p class="maintenance-subtitle">Nous améliorons votre expérience</p>
        <div class="spinner"></div>
        <p class="maintenance-description">
            Notre site est actuellement en maintenance pour vous offrir une meilleure expérience.
            Nous serons de retour très bientôt !
        </p>

        <div class="contact-card">
            <h4>Besoin d'aide ?</h4>
            <div class="contact-info">
                <i class="fas fa-envelope"></i>
                <a href="mailto:contact@owew.org" style="color: white; text-decoration: none;">
                    contact@owew.org
                </a>
            </div>
            <div class="social-links">
                <a href="#" class="social-link">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <small style="opacity: 0.6; margin-top: 2rem; display: block;">
            &copy; {{ date('Y') }} OWEW. Tous droits réservés.
        </small>
    </div>

    <script>
        setTimeout(() => { location.reload(); }, 30000);
    </script>
</body>
</html>
