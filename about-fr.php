<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Atlas Multimedia Productions</title>
    <meta name="description" content="Découvrez Atlas Multimedia Productions (AMP), spécialiste en production audiovisuelle institutionnelle à Rabat et Casablanca. Notre équipe, notre matériel et nos valeurs.">
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="index-fr.php">Accueil</a></li>
                    <li><a href="services-fr.php">Services</a></li>
                    <li><a href="portfolio-fr.php">Portfolio</a></li>
                    <li><a href="about-fr.php" class="active">À Propos</a></li>
                    <li><a href="blog-fr.php">Blog</a></li>
                    <li><a href="contact-fr.php" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem; color: #050807;">Devis Gratuit</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="Langue"><i class="fa-solid fa-globe"></i> FR <i class="fa-solid fa-chevron-down"></i></button>
                        <div class="lang-dropdown">
                            <a href="about.php">English</a>
                            <a href="about-fr.php">Français</a>
                            <a href="about-ar.php" class="ar-font">العربية</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner -->
    <section class="section-padding" style="background: linear-gradient(180deg, var(--bg-surface) 0%, var(--bg-main) 100%); margin-top: var(--header-height); padding: 80px 0 40px 0;">
        <div class="container text-center">
            <span class="section-subtitle">Qui Sommes-Nous</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">Notre Histoire & Engagement</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Présents depuis 2017 à Rabat et Casablanca, nous comblons le fossé entre la haute technologie et la communication humaine.</p>
        </div>
    </section>

    <!-- Content Split: Values & USP -->
    <section class="section-padding" style="border-top: 1px solid var(--border-color);">
        <div class="container about-split">
            <div>
                <span class="section-subtitle">Notre Différentiel</span>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">L'Expertise Institutionnelle double-implantation</h2>
                <p style="color: var(--text-muted); margin-bottom: 16px;">
                    Si votre organisation possède des implantations ou prépare des événements à la fois à Rabat et à Casablanca, nous vous garantissons une <strong>couverture double-ville</strong> fluide (ex: conférence de presse le matin à Rabat et lancement produit le soir à Casablanca).
                </p>
                <p style="color: var(--text-muted); margin-bottom: 20px;">
                    De plus, en tant que spécialiste basé à Rabat, nous maîtrisons sur le bout des doigts les protocoles administratifs, la coordination avec les ministères, les ambassades, les ONG et l'obtention rapide d'autorisations de tournage et de badges de sécurité dans les zones étatiques.
                </p>
                <div class="glass-card" style="padding: 20px; margin-top: 24px; border-color: rgba(0, 208, 120, 0.2);">
                    <h4 style="color: var(--primary); margin-bottom: 8px;"><i class="fa-solid fa-leaf" style="margin-right: 8px;"></i> Notre Engagement Responsable</h4>
                    <p style="font-size: 0.9rem; color: var(--text-muted);">
                        Inspirés par les meilleures agences vertes mondiales, nous intégrons une charte d'éco-production rigoureuse (réduction de notre empreinte carbone lors des tournages, compensation carbone des déplacements de nos équipes et logistique événementielle zéro déchet).
                    </p>
                </div>
            </div>
            <div class="about-img-box" style="border: 1px solid var(--border-color); display: flex; flex-direction: column; justify-content: center; padding: 24px; background: var(--bg-surface); gap: 24px; border-radius: var(--border-radius);">
                <div style="border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color); aspect-ratio: 16/9; background: #000;">
                    <video src="assets/videos/AMP (Logo dynamique).mp4" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>
                <div style="text-align: center;">
                    <h3 style="color: var(--primary); margin-bottom: 12px; font-size: 1.3rem;"><i class="fa-solid fa-gem"></i> Signature AMP</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">
                        Une signature créative dynamique. Notre identité visuelle incarne la rigueur de la production et la fluidité des idées.
                    </p>
                </div>
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

    <!-- Material Inventory (Simplified Capabilities) -->
    <section class="section-padding" style="background-color: var(--bg-surface); border-bottom: 1px solid var(--border-color);">
        <div class="container">
            <div class="text-center" style="margin-bottom: 50px;">
                <span class="section-subtitle">Capacités Techniques</span>
                <h2 class="section-title">Arsenal Professionnel de Production & de Diffusion</h2>
                <p class="section-desc">Nous exploitons des outils de dernière génération pour garantir une qualité visuelle et sonore premium à chaque campagne et événement.</p>
            </div>
            
            <div class="grid-3" style="margin-bottom: 40px;">
                <div class="glass-card" style="padding: 24px; text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-camera"></i></div>
                    <h3 style="margin-bottom: 12px;">Caméras Cinéma Ultra-HD</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Systèmes de caméras numériques haut de gamme et optiques professionnelles optimisées pour les documentaires et vidéos institutionnelles.</p>
                </div>
                <div class="glass-card" style="padding: 24px; text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-microphone"></i></div>
                    <h3 style="margin-bottom: 12px;">Éclairage & Son Professionnels</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Prise de son sans fil haute fidélité, sonorisation haut de gamme et projecteurs d'éclairage cinéma professionnels.</p>
                </div>
                <div class="glass-card" style="padding: 24px; text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-server"></i></div>
                    <h3 style="margin-bottom: 12px;">Scénographie, Écrans & Studio</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Murs LED géants modulables, logistique scénique complète et studio de post-production avancé à Rabat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Geographic Presence Details -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center">
                <span class="section-subtitle">Présence Physique</span>
                <h2 class="section-title">Nos Bureaux au Maroc</h2>
                <p class="section-desc" style="margin-bottom: 60px;">Rencontrez nos équipes à Rabat ou Casablanca pour structurer votre plan de communication durable.</p>
            </div>
            <div class="grid-3" style="grid-template-columns: repeat(2, 1fr);">
                <!-- Rabat Head Office -->
                <div class="glass-card" style="border-top: 4px solid var(--primary);">
                    <div style="font-size: 2rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-building-flag"></i></div>
                    <h3 style="margin-bottom: 12px;">Siège Social - Rabat</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 20px;">
                        Idéalement situé, notre siège coordonne la production technique et assure les relations avec les institutions et ministères.
                    </p>
                    <div style="font-size: 0.9rem; line-height: 1.6; color: var(--text-muted);">
                        <strong>Adresse:</strong><br>
                        Rabat, Maroc
                    </div>
                </div>
                <!-- Casablanca branch office -->
                <div class="glass-card" style="border-top: 4px solid var(--secondary);">
                    <div style="font-size: 2rem; color: var(--secondary); margin-bottom: 16px;"><i class="fa-solid fa-handshake"></i></div>
                    <h3 style="margin-bottom: 12px;">Antenne Commerciale - Casablanca</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 20px;">
                        Notre bureau commercial gère les comptes clés et assure le suivi opérationnel avec l'écosystème smart city casablanquais.
                    </p>
                    <div style="font-size: 0.9rem; line-height: 1.6; color: var(--text-muted);">
                        <strong>Adresse:</strong><br>
                        Casablanca, Maroc
                    </div>
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

    <script src="app.js"></script>
</body>
</html>
