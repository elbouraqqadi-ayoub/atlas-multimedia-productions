<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Atlas Multimedia Productions</title>
    <meta name="description" content="Our audiovisual achievements. Discover our gallery of video productions and event captations in Morocco.">
    <link rel="stylesheet" href="style.css">
    <!-- Plyr Player CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <a href="index.php" class="logo-wrapper">
                <img src="assets/logos/Logo (AMP).png" alt="AMP Logo" class="logo-img" onerror="this.style.display='none';">
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
                    <li><a href="portfolio.php" class="active">Portfolio</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem; color: #050807;">Free Quote</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="Language"><i class="fa-solid fa-globe"></i> EN <i class="fa-solid fa-chevron-down"></i></button>
                        <div class="lang-dropdown">
                            <a href="portfolio.php">English</a>
                            <a href="portfolio-fr.php">Français</a>
                            <a href="portfolio-ar.php" class="ar-font">العربية</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner -->
    <section class="section-padding" style="background: linear-gradient(180deg, var(--bg-surface) 0%, var(--bg-main) 100%); margin-top: var(--header-height); padding: 80px 0 40px 0;">
        <div class="container text-center">
            <span class="section-subtitle">Our Achievements</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">Portfolio Gallery</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Explore our latest video productions, event coverages, and promotional clips made in Rabat, Casablanca, and across Morocco.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section-padding" style="border-top: 1px solid var(--border-color);">
        <div class="container">
            
            <!-- Filters -->
            <div class="portfolio-filters">
                <button class="filter-btn active" data-filter="all">All Projects</button>
                <button class="filter-btn" data-filter="pub">Advertising</button>
                <button class="filter-btn" data-filter="evenement">Events</button>
                <button class="filter-btn" data-filter="live">Web Series & Live</button>
            </div>

            <!-- Video Grid -->
            <div class="portfolio-grid">
                
                <!-- DYNAMIC CMS PROJECTS -->
                <?php
                $cms_projects = cms_portfolio('en');
                foreach ($cms_projects as $proj):
                ?>
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="<?= htmlspecialchars($proj['category']) ?>" data-video-src="<?= htmlspecialchars($proj['video_url'] ?? $proj['image_url']) ?>">
                    <div class="portfolio-thumb">
                        <?php if (strpos($proj['video_url'] ?? $proj['image_url'], '.mp4') !== false): ?>
                            <video class="portfolio-thumb-video" autoplay muted loop playsinline><source src="<?= htmlspecialchars($proj['video_url'] ?? $proj['image_url']) ?>" type="video/mp4"></video>
                        <?php else: ?>
                            <img src="<?= htmlspecialchars($proj['image_url']) ?>" alt="<?= htmlspecialchars($proj['title']) ?>" style="width:100%; height:100%; object-fit:cover;">
                        <?php endif; ?>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag"><?= htmlspecialchars($proj['category']) ?></span>
                        </div>
                        <h4 class="portfolio-title"><?= htmlspecialchars($proj['title']) ?></h4>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- END DYNAMIC CMS PROJECTS -->

                
                <!-- Video 1 (Local - Criminology Conference) -->
                <div class="portfolio-item" data-category="evenement" data-video-src="assets/videos/VID-20241130-WA0006 (Ongoing Conference).mp4">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1b3a24 0%, #0d1e13 100%); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 3rem;"><i class="fa-solid fa-microphone-lines"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Events</span>
                            <span class="tag">Conference</span>
                        </div>
                        <h4 class="portfolio-title">National Criminology Observatory (Conference)</h4>
                        <div class="portfolio-client">Client: National Criminology Observatory</div>
                    </div>
                </div>

                <!-- Video 2 (Local - Studio Crew) -->
                <div class="portfolio-item" data-category="live" data-video-src="assets/videos/VID-20241130-WA0007 (Studio Crew).mp4">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #0e2938 0%, #07151e 100%); display: flex; align-items: center; justify-content: center; color: var(--secondary); font-size: 3rem;"><i class="fa-solid fa-camera-retro"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Web Series & Live</span>
                            <span class="tag">Behind the Scenes</span>
                        </div>
                        <h4 class="portfolio-title">On-Set Shooting & Mobile Control Room</h4>
                        <div class="portfolio-client">Client: Atlas Multimedia Productions - Casablanca</div>
                    </div>
                </div>

                <!-- Video 3 (Local - Feature Film Trailer "STOP") -->
                <div class="portfolio-item" data-category="pub" data-video-src="assets/videos/Feature Film Trailer (STOP).mp4">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1f1f1f 0%, #0d0d0d 100%); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 3rem;"><i class="fa-solid fa-clapperboard"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Advertising</span>
                            <span class="tag">Cinema</span>
                        </div>
                        <h4 class="portfolio-title">Feature Film Trailer "STOP"</h4>
                        <div class="portfolio-client">Client: Film Production - Morocco</div>
                    </div>
                </div>

                <!-- Video 4 (YouTube - Karim) -->
                <div class="portfolio-item" data-category="pub" data-video-src="https://www.youtube.com/watch?v=agTN3tf9EQA">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #332d16 0%, #18150a 100%); display: flex; align-items: center; justify-content: center; color: #ffd043; font-size: 3rem;"><i class="fa-solid fa-music"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Advertising</span>
                            <span class="tag">Official Clip</span>
                        </div>
                        <h4 class="portfolio-title">Music Video Production - Karim</h4>
                        <div class="portfolio-client">Client: Moroccan Artistic Label</div>
                    </div>
                </div>

                <!-- Video 5 (YouTube - Rafie Lmadi Mat) -->
                <div class="portfolio-item" data-category="pub" data-video-src="https://www.youtube.com/watch?v=JYMQ8iCXhEc">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #163332 0%, #0a1817 100%); display: flex; align-items: center; justify-content: center; color: #43ffea; font-size: 3rem;"><i class="fa-solid fa-guitar"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Advertising</span>
                            <span class="tag">Official Clip</span>
                        </div>
                        <h4 class="portfolio-title">Music Video "Lmadi Mat" - Rafie</h4>
                        <div class="portfolio-client">Client: Artistic Production - Rabat</div>
                    </div>
                </div>

                <!-- Video 6 (YouTube - Rafie Qsadt Lbhar) -->
                <div class="portfolio-item" data-category="pub" data-video-src="https://www.youtube.com/watch?v=jEwq4g7fu0s">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1b1633 0%, #0c0a18 100%); display: flex; align-items: center; justify-content: center; color: #766dff; font-size: 3rem;"><i class="fa-solid fa-water"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Advertising</span>
                            <span class="tag">Official Clip</span>
                        </div>
                        <h4 class="portfolio-title">Music Video "Qsadt Lbhar" - Rafie</h4>
                        <div class="portfolio-client">Client: Artistic Production - Rabat</div>
                    </div>
                </div>

                <!-- Video 7 (YouTube - Dekkat saat) -->
                <div class="portfolio-item" data-category="live" data-video-src="https://www.youtube.com/watch?v=8jJ0K7iMzF0">
                    <div class="portfolio-thumb">
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #33162a 0%, #180a13 100%); display: flex; align-items: center; justify-content: center; color: #ff6dc0; font-size: 3rem;"><i class="fa-solid fa-tower-broadcast"></i></div>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">Web Series & Live</span>
                            <span class="tag">Live Captation</span>
                        </div>
                        <h4 class="portfolio-title">Live Capture "Saat Al Borhane"</h4>
                        <div class="portfolio-client">Client: Al Borhane - Live Event</div>
                    </div>
                </div>

            </div>

            <!-- Double CTA -->
            <div class="glass-card text-center" style="padding: 40px; border-color: rgba(0, 208, 120, 0.15);">
                <h3 style="font-size: 1.8rem; margin-bottom: 12px;">Do you have an upcoming audiovisual project?</h3>
                <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto 30px auto;">Our teams based in Rabat and Casablanca are ready to advise you on sizing, equipment requirements, and narrative identity.</p>
                <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                    <a href="contact.php" class="btn btn-primary">Get a Quote</a>
                    <a href="contact.html?type=expert" class="btn btn-secondary">Talk to an Expert</a>
                </div>
            </div>

        </div>
    </section>

    <!-- Custom Pop-up Video Modal -->
    <div class="video-modal" id="video-modal">
        <div class="modal-content">
            <button class="close-modal" id="close-modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-video-wrapper">
                <!-- Video player (HTML5 or Youtube) will be dynamically injected here -->
            </div>
            <div class="modal-info-panel">
                <h3 id="modal-video-title" style="margin-bottom: 8px;">Video Title</h3>
                <p id="modal-video-desc" style="color: var(--text-muted); font-size: 0.9rem;">Client description</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container footer-grid">
            <div>
                <div class="footer-logo logo-text" style="font-size: 1.5rem;">ATLAS<span>MULTIMEDIA</span></div>
                <p class="footer-desc">Since 2017, specializing in producing multimedia campaigns, event organization, and video captation for institutions and companies committed to energy efficiency.</p>
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
                <div class="office-info" style="margin-bottom: 16px;">
                    <strong>Head Office (Rabat):</strong><br>
                    13 Avenue Abderrahmane Al Ghafiki, N°9, Agdal, 10090 Rabat
                </div>
                <div class="office-info">
                    <strong>Branch Office (Casablanca):</strong><br>
                    22, Rue Franceville, N°28, Oasis, 20103 Casablanca
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2026 Atlas Multimedia Productions. All rights reserved.</p>
            <p>Designed for the Energy Transition in Morocco.</p>
        </div>
    </footer>

    <!-- Plyr library JS -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="app.js"></script>
</body>
</html>
