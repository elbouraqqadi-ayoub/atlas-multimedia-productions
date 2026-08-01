<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlas Multimedia Productions - Énergies Nouvelles & Efficacité Énergétique et Durabilité</title>
    <meta name="description" content="Production audiovisuelle spécialisée dans les énergies nouvelles et l'efficacité énergétique et durabilité au Maroc. Basé à Rabat & Casablanca.">
    <link rel="stylesheet" href="style.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <a href="index-fr.php" class="logo-wrapper">
                <img src="assets/logos/Logo (AMP).png" alt="Atlas Multimedia Productions" class="logo-img">
                <div class="logo-text">ATLAS<span>MULTIMEDIA</span></div>
            </a>
            <button class="mobile-menu-btn" aria-label="Menu" id="mobile-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="navbar">
                <ul>
                    <li><a href="index-fr.php" class="active">Accueil</a></li>
                    <li><a href="services-fr.php">Services</a></li>
                    <li><a href="portfolio-fr.php">Portfolio</a></li>
                    <li><a href="about-fr.php">À Propos</a></li>
                    <li><a href="blog-fr.php">Blog</a></li>
                    <li><a href="contact-fr.php" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem; color: #050807;">Devis Gratuit</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="Langue"><i class="fa-solid fa-globe"></i> FR <i class="fa-solid fa-chevron-down"></i></button>
                        <div class="lang-dropdown">
                            <a href="index.php">English</a>
                            <a href="index-fr.php">Français</a>
                            <a href="index-ar.php" class="ar-font">العربية</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Video Section -->
    <section class="hero">
        <div class="hero-video-container">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="assets/videos/energy_transition_reel.webm" type="video/webm">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="container hero-split-container">
            <div class="hero-content">
                <span class="section-subtitle" style="animation: fadeInUp 0.8s ease forwards;">Spécialiste Audiovisuel Institutionnel</span>
                <h1 class="fade-in-up">De Conteurs à <br><span class="text-gradient">Bâtisseurs d'Énergie</span></h1>
                <p class="fade-in-up">Depuis 8 ans, nous matérialisons l'invisible. Aujourd'hui, nous mettons notre expertise au service de la transition énergétique et durabilité en traduisant les données d'énergie verte en récits visuels captivants.</p>
                <div class="hero-ctas">
                    <a href="contact-fr.php" class="btn btn-primary">Parler à un expert <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
                    <a href="portfolio-fr.php" class="btn btn-secondary">Découvrir nos projets</a>
                </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="counters-section">
        <div class="container counters-grid">
            <div class="counter-card">
                <h3>8+</h3>
                <p>Années d'expérience</p>
            </div>
            <div class="counter-card">
                <h3>150+</h3>
                <p>Projets Audiovisuels</p>
            </div>
            <div class="counter-card">
                <h3>2</h3>
                <p>Bureaux (Rabat & Casablanca)</p>
            </div>
            <div class="counter-card">
                <h3>100%</h3>
                <p>Engagement Transition</p>
            </div>
        </div>
    </section>

    <!-- Pitch Section -->
    <section class="section-padding">
        <div class="container about-split">
            <div>
                <span class="section-subtitle">Pourquoi ce tournant ?</span>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">Votre innovation verte mérite une communication d'excellence</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">
                    La transition écologique et les technologies propres ne se limitent pas à des câbles et des kilowatts. Elles exigent une transformation comportementale profonde, la confiance des investisseurs et une solide compréhension publique. 
                </p>
                <p style="color: var(--text-muted); margin-bottom: 30px;">
                    Nous comblons le fossé entre l'excellence en ingénierie et l'engagement humain. Nous donnons vie aux économies d'énergie, produisons des documentaires convaincants pour capter des subventions, et concevons des événements mémorables.
                </p>
                <a href="about-fr.php" class="btn btn-secondary">Notre Vision</a>
            </div>
            <div class="about-img-box">
                <video autoplay muted loop playsinline style="border-radius: var(--border-radius); width: 100%; height: 100%; object-fit: cover;">
                    <source src="assets/videos/VID-20241130-WA0006 (Ongoing Conference).mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </section>

    <!-- Liaison Section -->
    <section class="section-padding" style="background-color: var(--bg-surface-elevated); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
        <div class="container" style="max-width: 900px; text-align: center;">
            <span class="section-subtitle">Liaison Rabat & Exécution Locale</span>
            <h2 style="font-size: 2.2rem; margin-bottom: 20px;">Production Sans Déplacement pour les Partenaires Hors-Ville & Étrangers</h2>
            <p style="color: var(--text-muted); margin-bottom: 24px; font-size: 1.1rem;">
                Les ministères gouvernementaux, les ambassades, les ONG et les administrations publiques sont tous basés à Rabat. En tant que spécialiste audiovisuel institutionnel local, AMP gère l'intégralité des protocoles administratifs, des autorisations de tournage CCM, des laissez-passer de sécurité et de la logistique d'accueil.
            </p>
            <p style="color: var(--text-muted); margin-bottom: 30px;">
                Vous n'avez pas besoin d'envoyer vos équipes de production ou directeurs de projet à Rabat. Nous coordonnons tout sur le terrain et mettons à votre disposition des outils de collaboration en temps réel (retours vidéo en direct) pour vous permettre de piloter le projet à distance en toute confiance.
            </p>
            <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600;"><i class="fa-solid fa-file-signature"></i> Autorisations CCM & Officielles</div>
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600;"><i class="fa-solid fa-lock"></i> Accès & Sécurité</div>
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600;"><i class="fa-solid fa-tower-broadcast"></i> Retours Vidéo Live</div>
            </div>
        </div>
    </section>

    <!-- Three Main Services Teaser -->
    <section class="section-padding" style="background-color: var(--bg-surface);">
        <div class="container">
            <div class="text-center">
                <span class="section-subtitle">Nos Activités</span>
                <h2 class="section-title">Trois Pôles de Services Audiovisuels Spécialisés</h2>
                <p class="section-desc">Des solutions techniques de pointe pour magnifier vos projets durables du concept à la diffusion.</p>
            </div>
            <div class="grid-3">
                <!-- Service 1 -->
                <div class="glass-card service-card">
                    <div class="service-icon"><i class="fa-solid fa-photo-film"></i></div>
                    <h3>Campagnes Multimédia</h3>
                    <p>Spots TV, vidéos pour les réseaux sociaux (9:16), documentaires institutionnels courts, et podcasts d'entreprise dédiés au secteur éco-responsable.</p>
                    <a href="services-fr.html#campagnes" class="learn-more">En savoir plus <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <!-- Service 2 -->
                <div class="glass-card service-card">
                    <div class="service-icon"><i class="fa-solid fa-people-group"></i></div>
                    <h3>Événements & Forums</h3>
                    <p>Organisation complète de salons professionnels, de forums sur l'efficacité énergétique et durabilité, de webinaires interactifs et de live-streaming multi-caméras.</p>
                    <a href="services-fr.html#evenements" class="learn-more">En savoir plus <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <!-- Service 3 -->
                <div class="glass-card service-card">
                    <div class="service-icon"><i class="fa-solid fa-tower-broadcast"></i></div>
                    <h3>Captation & Contenus</h3>
                    <p>Couverture audiovisuelle complète d'événements publics et administratifs, web-séries pédagogiques, tutoriels et lancements de produits éco-innovants.</p>
                    <a href="services-fr.html#captation" class="learn-more">En savoir plus <i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners / Reassurance Marquee -->
    <section class="marquee-section" style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 40px 0; background: rgba(10, 20, 17, 0.2);">
        <div class="container" style="padding-bottom: 12px;"><h4 style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 15px; text-align: center;">Ils nous font confiance</h4></div>
        <div class="marquee-container">
            <div class="marquee-content">
                <div class="marquee-item"><img src="assets/logos/CCM (Logo).jpg" alt="CCM Logo"></div>
                <div class="marquee-item"><img src="assets/logos/CINEATLAS Logo.png" alt="Cineatlas Logo"></div>
                <div class="marquee-item"><img src="assets/logos/ISESCO (Logo).jpg" alt="ISESCO Logo"></div>
                <div class="marquee-item"><img src="assets/logos/MJCC (Logo).webp" alt="MJCC Logo"></div>
                <!-- Duplicate for seamless scroll -->
                <div class="marquee-item"><img src="assets/logos/CCM (Logo).jpg" alt="CCM Logo"></div>
                <div class="marquee-item"><img src="assets/logos/CINEATLAS Logo.png" alt="Cineatlas Logo"></div>
                <div class="marquee-item"><img src="assets/logos/ISESCO (Logo).jpg" alt="ISESCO Logo"></div>
                <div class="marquee-item"><img src="assets/logos/MJCC (Logo).webp" alt="MJCC Logo"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container footer-grid">
            <div>
                <div class="footer-logo logo-text" style="font-size: 1.5rem;">ATLAS<span>MULTIMEDIA</span></div>
                <p class="footer-desc">Depuis 2017, spécialiste de la production de campagnes multimédias, organisation d'événements et captation vidéo pour les institutions et entreprises engagées dans l'efficacité énergétique et durabilité.</p>
                <div class="footer-socials">
                    <a href="https://www.linkedin.com/company/hhbhbj/" target="_blank" class="social-icon" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100066799973840" target="_blank" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/channel/UCvHi1qz3QXP5QazH4JHUcog" target="_blank" class="social-icon" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://x.com/AmpAtlas" target="_blank" class="social-icon" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            <div>
                <h4 class="footer-title">Liens Rapides</h4>
                <ul class="footer-links">
                    <li><a href="index-fr.php">Accueil</a></li>
                    <li><a href="services-fr.php">Services</a></li>
                    <li><a href="portfolio-fr.php">Portfolio</a></li>
                    <li><a href="about-fr.php">À Propos</a></li>
                    <li><a href="blog-fr.php">Blog</a></li>
                    <li><a href="contact-fr.php">Contact & Devis</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Nos Implantations</h4>
                <div class="office-info" style="margin-bottom: 16px;">
                    <strong>Siège Social (Rabat) :</strong><br>
                    Rabat, Morocco
                </div>
                <div class="office-info">
                    <strong>Bureau Commercial (Casablanca) :</strong><br>
                    Casablanca, Morocco
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2026 Atlas Multimedia Productions. Tous droits réservés.</p>
            <p>Conçu pour la Transition Énergétique et Durabilité au Maroc.</p>
        </div>
    </footer>

    <!-- Core Script -->
    <script src="app.js"></script>
</body>
</html>
