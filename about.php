<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Atlas Multimedia Productions</title>
    <meta name="description" content="Specialist in institutional audiovisual and events for green energy in Morocco. Offices in Rabat & Casablanca.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <a href="index.php" class="logo-wrapper">
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="about.php" class="active">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem; color: #050807;">Free Quote</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="Language"><i class="fa-solid fa-globe"></i> EN <i class="fa-solid fa-chevron-down"></i></button>
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
            <span class="section-subtitle">Our Agency</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">About Us</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">8 years of experience in producing high-impact campaigns and organizing major forums in Morocco.</p>
        </div>
    </section>

    <!-- Our Journey Split Section -->
    <section class="section-padding" style="border-top: 1px solid var(--border-color);">
        <div class="container about-split">
            <div>
                <span class="section-subtitle">Our History</span>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">Mastering Audiovisual for a Sustainable Future</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">
                    Since 2017, Atlas Multimedia has produced institutional content, commercials, and corporate podcasts. We also coordinate professional events, live streams, and conferences for national and international clients.
                </p>
                <p style="color: var(--text-muted); margin-bottom: 20px;">
                    As institutional AV specialists, we are based in Rabat, giving us deep knowledge of the administrative protocols, security clearances, and permits required to film in government ministries, embassies, and public spaces. 
                </p>
                <p style="color: var(--text-muted); margin-bottom: 30px;">
                    With offices in both Rabat and Casablanca, we provide dual-city coverage for agencies and clients hosting simultaneous press conferences or multi-stage events across both major hubs.
                </p>
            </div>
            <div class="about-img-box" style="border: 1px solid var(--border-color); display: flex; flex-direction: column; justify-content: center; padding: 24px; background: var(--bg-surface); gap: 24px; border-radius: var(--border-radius);">
                <div style="border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color); aspect-ratio: 16/9; background: #000;">
                    <video src="assets/videos/AMP (Logo dynamique).mp4" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 12px; font-size: 1.3rem;"><i class="fa-solid fa-map-pin"></i> Dual-City Advantage</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px;">
                        Having fully staffed physical teams in both Rabat (the institutional capital) and Casablanca (the economic hub) allows us to coordinate cross-city coverage and local logistic support more efficiently than single-city agencies.
                    </p>
                    <div style="border-top: 1px solid var(--border-color); padding-top: 16px; display: flex; justify-content: space-around; text-align: center;">
                        <div>
                            <h4 style="color: #fff; font-size: 1.1rem;">Rabat</h4>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">Head Office</span>
                        </div>
                        <div style="border-left: 1px solid var(--border-color); height: 30px;"></div>
                        <div>
                            <h4 style="color: #fff; font-size: 1.1rem;">Casablanca</h4>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">Branch Office</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Liaison Section -->
    <section class="section-padding" style="background-color: var(--bg-surface-elevated); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
        <div class="container" style="max-width: 900px; text-align: center;">
            <span class="section-subtitle">Rabat Liaison & Local Execution</span>
            <h2 style="font-size: 2.2rem; margin-bottom: 20px;">Zero-Travel Production for Out-of-City & Foreign Partners</h2>
            <p style="color: var(--text-muted); margin-bottom: 24px; font-size: 1.1rem;">
                Embassy relations, governmental ministries, NGOs, and public institutions are all headquartered in Rabat. As the local institutional AV specialist, AMP manages all local administrative protocols, CCM filming permits, site security clearance, and staging logistics.
            </p>
            <p style="color: var(--text-muted); margin-bottom: 30px;">
                You don't need to send your production team or project managers to Rabat. We coordinate everything on the ground and offer real-time collaboration with live video monitors, so you can direct and supervise remotely with absolute confidence.
            </p>
            <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600;"><i class="fa-solid fa-file-signature"></i> Official Permits & CCM</div>
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600;"><i class="fa-solid fa-lock"></i> Security Clearances</div>
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600;"><i class="fa-solid fa-tower-broadcast"></i> Real-time Live Streams</div>
            </div>
        </div>
    </section>

    <!-- Material Inventory (Simplified Capabilities) -->
    <section class="section-padding" style="background-color: var(--bg-surface); border-bottom: 1px solid var(--border-color);">
        <div class="container">
            <div class="text-center" style="margin-bottom: 50px;">
                <span class="section-subtitle">Technical Capabilities</span>
                <h2 class="section-title">Professional Production & Broadcasting Arsenal</h2>
                <p class="section-desc">We leverage state-of-the-art tools to ensure premium visual and auditory quality for every campaign and event.</p>
            </div>
            
            <div class="grid-3" style="margin-bottom: 40px;">
                <div class="glass-card" style="padding: 24px; text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-camera"></i></div>
                    <h3 style="margin-bottom: 12px;">Ultra-HD Cinema Cameras</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">High-end digital cinema systems and professional optics optimized for stunning corporate videos and documentaries.</p>
                </div>
                <div class="glass-card" style="padding: 24px; text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-microphone"></i></div>
                    <h3 style="margin-bottom: 12px;">Broadcast Sound & Lights</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Premium wireless audio capture, high-fidelity sound systems, and studio-grade cinematic lighting fixtures.</p>
                </div>
                <div class="glass-card" style="padding: 24px; text-align: center;">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"><i class="fa-solid fa-server"></i></div>
                    <h3 style="margin-bottom: 12px;">Staging, Displays & Studios</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Giant modular LED screens, full staging logistics, and an advanced post-production studio in Rabat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners / Reassurance Marquee -->
    <section class="marquee-section" style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 40px 0; background: rgba(10, 20, 17, 0.2);">
        <div class="container" style="padding-bottom: 12px;"><h4 style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 15px; text-align: center;">They trust us</h4></div>
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
                <p class="footer-desc">Since 2017, specializing in producing multimedia campaigns, event organization, and video captation for institutions and companies committed to energy efficiency & sustainability.</p>
                <div class="footer-socials">
                    <a href="https://www.linkedin.com/company/hhbhbj/" target="_blank" class="social-icon" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100066799973840" target="_blank" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/channel/UCvHi1qz3QXP5QazH4JHUcog" target="_blank" class="social-icon" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://x.com/AmpAtlas" target="_blank" class="social-icon" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            <div>
                <h4 class="footer-title">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact & Quote</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Our Locations</h4>
                <div class="office-info" style="margin-bottom: 10px;">
                    <strong>Head Office:</strong> Rabat, Morocco
                </div>
                <div class="office-info" style="margin-bottom: 10px;">
                    <strong>Branch Office:</strong> Casablanca, Morocco
                </div>
                <div class="office-info">
                    <strong>Direct Email:</strong><br>
                    <a href="mailto:h.barakat00@gmail.com" style="color: var(--primary);">h.barakat00@gmail.com</a>
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2026 Atlas Multimedia Productions. All rights reserved.</p>
            <p>Designed for the Energy Transition & Sustainability in Morocco.</p>
        </div>
    </footer>

    <script src="app.js"></script>
</body>
</html>
