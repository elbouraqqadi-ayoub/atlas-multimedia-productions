<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact & Quote - Atlas Multimedia Productions</title>
    <meta name="description" content="Request a free estimated quote for your audiovisual production or event captation project in Morocco. Offices in Rabat and Casablanca.">
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php" class="active">Contact & Quote</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="Language"><i class="fa-solid fa-globe"></i> EN <i class="fa-solid fa-chevron-down"></i></button>
                        <div class="lang-dropdown">
                            <a href="contact.php">English</a>
                            <a href="contact-fr.php">Français</a>
                            <a href="contact-ar.php" class="ar-font">العربية</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner -->
    <section class="section-padding" style="background: linear-gradient(180deg, var(--bg-surface) 0%, var(--bg-main) 100%); margin-top: var(--header-height); padding: 80px 0 40px 0;">
        <div class="container text-center">
            <span class="section-subtitle">Contact Us</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">Request a Quote</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Plan your audiovisual or event project. Fill out our multi-step form to receive an estimate within 24h.</p>
            <p style="color: var(--text-muted); max-width: 600px; margin: 15px auto 0 auto;">Or email us directly at: <a href="mailto:h.barakat00@gmail.com" style="color: var(--primary); font-weight: 600; text-decoration: none;">h.barakat00@gmail.com</a></p>
        </div>
    </section>

    <!-- Multi-step Form Section -->
    <section class="section-padding" style="border-top: 1px solid var(--border-color);">
        <div class="container" style="max-width: 800px;">
            <div class="glass-card form-container">
                
                <!-- Progress bar -->
                <div class="form-progress">
                    <div class="progress-step active">1</div>
                    <div class="progress-step">2</div>
                    <div class="progress-step">3</div>
                </div>

                <form id="quote-form" novalidate>
                    <!-- Hidden field to store selected project type -->
                    <input type="hidden" name="project_type" id="project-type-input" value="">

                    <!-- STEP 1: Select Project Type -->
                    <div class="form-step active" data-step="0">
                        <h3 style="margin-bottom: 24px; font-size: 1.5rem; text-align: center;">What type of project are you planning?</h3>
                        <div class="options-grid">
                            <!-- Card 1 -->
                            <div class="option-card" data-value="multimedia">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-photo-film"></i></div>
                                <h4>Multimedia Campaign</h4>
                                <p>Advertising spots, corporate podcasts, or short vertical social media clips (9:16).</p>
                            </div>
                            <!-- Card 2 -->
                            <div class="option-card" data-value="evenement">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-people-group"></i></div>
                                <h4>Event & Forum</h4>
                                <p>Professional conference, exhibition booth logistics, and total media coverage.</p>
                            </div>
                            <!-- Card 3 -->
                            <div class="option-card" data-value="captation">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-tower-broadcast"></i></div>
                                <h4>Captation & Live Stream</h4>
                                <p>Multi-camera live video streaming on the internet or educational web-series.</p>
                            </div>
                            <!-- Card 4 -->
                            <div class="option-card" data-value="postprod">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-film"></i></div>
                                <h4>Post-Prod & Studio (Exclusively in Rabat)</h4>
                                <p>DaVinci Resolve color grading, editing, or cyclorama studio usage (Exclusively at Rabat Head Office).</p>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: Contact & Company Details -->
                    <div class="form-step" data-step="1">
                        <h3 style="margin-bottom: 24px; font-size: 1.5rem; text-align: center;">Introduce yourself & detail your requirements</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-name">Full Name *</label>
                                <input type="text" id="form-name" class="form-control" placeholder="Ex: John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="form-email">Email Address *</label>
                                <input type="email" id="form-email" class="form-control" placeholder="Ex: contact@company.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-phone">Phone Number</label>
                                <input type="tel" id="form-phone" class="form-control" placeholder="Ex: +212 600 000 000">
                            </div>
                            <div class="form-group">
                                <label for="form-company">Company / Organization Name</label>
                                <input type="text" id="form-company" class="form-control" placeholder="Ex: ClimateTech Morocco">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form-desc">Short Project Description *</label>
                            <textarea id="form-desc" class="form-control" rows="4" placeholder="Describe the objectives, estimated duration, and any specific requirements..." required></textarea>
                        </div>
                    </div>

                    <!-- STEP 3: Budget, Location & Dates -->
                    <div class="form-step" data-step="2">
                        <h3 style="margin-bottom: 24px; font-size: 1.5rem; text-align: center;">Planning Details</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-location">Main Project Location *</label>
                                <select id="form-location" class="form-control" required>
                                    <option value="" disabled selected>Select a city</option>
                                    <option value="rabat">Rabat (Head Office)</option>
                                    <option value="casablanca">Casablanca (Branch)</option>
                                    <option value="other-maroc">Other city in Morocco</option>
                                    <option value="international">Outside Morocco</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form-budget">Estimated Budget (MAD) *</label>
                                <select id="form-budget" class="form-control" required>
                                    <option value="" disabled selected>Select a range</option>
                                    <option value="low">Under 20,000 MAD</option>
                                    <option value="mid">20,000 - 50,000 MAD</option>
                                    <option value="high">50,000 - 150,000 MAD</option>
                                    <option value="premium">Over 150,000 MAD</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-date">Desired Completion Date</label>
                                <input type="date" id="form-date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label style="opacity: 0;">Spacer</label>
                                <div style="font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 8px; height: 50px;">
                                    <i class="fa-solid fa-lock" style="color: var(--primary);"></i> Your data is encrypted and confidential.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="form-actions">
                        <button type="button" id="prev-step" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-chevron-left" style="margin-right: 8px;"></i> Previous</button>
                        <button type="button" id="next-step" class="btn btn-primary">Next <i class="fa-solid fa-chevron-right" style="margin-left: 8px;"></i></button>
                        <button type="submit" id="submit-form" class="btn btn-primary" style="display: none;">Submit Request <i class="fa-solid fa-paper-plane" style="margin-left: 8px;"></i></button>
                    </div>
                </form>

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
