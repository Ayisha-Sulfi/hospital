<!DOCTYPE html>
<html>
<head>
    <title>MediCare - Hospital Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4CAF50;
            --dark-color: #1f2937;
            --light-color: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        nav {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background: var(--primary-color);
            color: white;
        }

        .auth-buttons a {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
        }

        .login-btn {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .register-btn {
            background: var(--primary-color);
            color: white !important;
        }

        .hero {
            background: linear-gradient(rgba(67, 97, 238, 0.9), rgba(63, 55, 201, 0.9)), url('/api/placeholder/1920/600');
            background-size: cover;
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .features {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }

        .feature-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            margin-bottom: 1rem;
        }

        .portal-section {
            background: var(--light-color);
            padding: 4rem 2rem;
            text-align: center;
        }

        .portal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto 0;
        }

        .portal-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .portal-card:hover {
            transform: translateY(-5px);
        }

        .portal-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .portal-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .portal-buttons a {
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login {
            background: var(--primary-color);
            color: white;
        }

        .btn-register {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .portal-buttons {
                flex-direction: column;
            }

            .portal-buttons a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="#" class="logo">MediCare</a>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <div class="auth-buttons">
                <a href="user_login.php" class="login-btn">Sign In</a>
                <a href="user_register.php" class="register-btn">Register</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome to MediCare</h1>
        <p>Your trusted partner in healthcare management and patient care</p>
    </section>

    <section class="features">
        <h2 style="text-align: center">Our Services</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-calendar-check"></i>
                <h3>Easy Appointments</h3>
                <p>Schedule appointments with our doctors quickly and efficiently</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-user-md"></i>
                <h3>Expert Doctors</h3>
                <p>Access to highly qualified and experienced medical professionals</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-clock"></i>
                <h3>24/7 Support</h3>
                <p>Round-the-clock medical support and emergency services</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-hospital"></i>
                <h3>Modern Facilities</h3>
                <p>State-of-the-art medical facilities and equipment</p>
            </div>
        </div>
    </section>

    <section class="portal-section">
        <h2>Access Your Portal</h2>
        <div class="portal-grid">
            <div class="portal-card">
                <i class="fas fa-user-circle" style="font-size: 2rem; color: var(--primary-color);"></i>
                <h3>Patient Portal</h3>
                <p>Access your medical records, appointments, and more</p>
                <div class="portal-buttons">
                    <a href="user_login.php" class="btn-login">Sign In</a>
                    <a href="user_register.php" class="btn-register">Register</a>
                </div>
            </div>
            <div class="portal-card">
                <i class="fas fa-user-md" style="font-size: 2rem; color: var(--primary-color);"></i>
                <h3>Doctor Portal</h3>
                <p>Manage your schedule and patient appointments</p>
                <div class="portal-buttons">
                    <a href="doctor_login.php" class="btn-login">Doctor Sign In</a>
                </div>
            </div>
            <div class="portal-card">
                <i class="fas fa-user-shield" style="font-size: 2rem; color: var(--primary-color);"></i>
                <h3>Admin Portal</h3>
                <p>Hospital management and administrative tools</p>
                <div class="portal-buttons">
                    <a href="admin_login.php" class="btn-login">Admin Sign In</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 MediCare. All rights reserved.</p>
    </footer>
</body>
</html>