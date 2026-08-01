<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أعمالنا - أطلس مالتي ميديا للإنتاج</title>
    <meta name="description" content="معرض أعمالنا السمعية البصرية. اكتشف مشاريع الإنتاج التلفزيوني وتصوير الفعاليات بالمغرب. مكاتبنا بالرباط والدار البيضاء.">
    <link rel="stylesheet" href="style.css">
    <!-- Plyr Player CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <a href="index-ar.php" class="logo-wrapper">
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
                    <li><a href="index-ar.php">الرئيسية</a></li>
                    <li><a href="services-ar.php">خدماتنا</a></li>
                    <li><a href="portfolio-ar.php" class="active">أعمالنا</a></li>
                    <li><a href="about-ar.php">من نحن</a></li>
                    <li><a href="blog-ar.php">المدونة</a></li>
                    <li><a href="contact-ar.php" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem; color: #050807;">طلب تقدير تكلفة</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="اللغة"><i class="fa-solid fa-globe"></i> AR <i class="fa-solid fa-chevron-down"></i></button>
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
            <span class="section-subtitle">أعمالنا</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">معرض المشاريع</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">اكتشف أحدث إنتاجاتنا المرئية، وتغطية الفعاليات، والمقاطع الترويجية المصورة في الرباط والدار البيضاء وعبر المغرب.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section-padding" style="border-top: 1px solid var(--border-color);">
        <div class="container">
            
            <!-- Filters -->
            <div class="portfolio-filters">
                <button class="filter-btn active" data-filter="all">جميع المشاريع</button>
                <button class="filter-btn" data-filter="pub">الدعاية والوسائط المتعددة</button>
                <button class="filter-btn" data-filter="evenement">الفعاليات والمؤتمرات</button>
                <button class="filter-btn" data-filter="live">سلاسل الويب والبث المباشر</button>
            </div>

            <!-- Video Grid -->
            <div class="portfolio-grid">
                
                <!-- Video 1 (Local - Criminology Conference) -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="evenement" data-video-src="assets/videos/VID-20241130-WA0006 (Ongoing Conference).mp4">
                    <div class="portfolio-thumb">
                        <video class="portfolio-thumb-video" autoplay muted loop playsinline><source src="assets/videos/VID-20241130-WA0006 (Ongoing Conference).mp4" type="video/mp4"></video>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">الفعاليات</span>
                            <span class="tag">مؤتمر</span>
                        </div>
                        <h4 class="portfolio-title">المرصد الوطني للجريمة (مؤتمر)</h4>
                    </div>
                </div>

                <!-- Video 2 (Local - Studio Crew) -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="live" data-video-src="assets/videos/VID-20241130-WA0007 (Studio Crew).mp4">
                    <div class="portfolio-thumb">
                        <video class="portfolio-thumb-video" autoplay muted loop playsinline><source src="assets/videos/VID-20241130-WA0007 (Studio Crew).mp4" type="video/mp4"></video>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">سلاسل الويب والبث المباشر</span>
                            <span class="tag">كواليس</span>
                        </div>
                        <h4 class="portfolio-title">التصوير البلاتوه وغرفة التحكم المتنقلة</h4>
                    </div>
                </div>

                <!-- Video 3 (Local - Feature Film Trailer "STOP") -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="pub" data-video-src="assets/videos/Feature Film Trailer (STOP).mp4">
                    <div class="portfolio-thumb">
                        <video class="portfolio-thumb-video" autoplay muted loop playsinline><source src="assets/videos/Feature Film Trailer (STOP).mp4" type="video/mp4"></video>
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">الدعاية والوسائط المتعددة</span>
                            <span class="tag">سينما</span>
                        </div>
                        <h4 class="portfolio-title">العرض الترويجي للفيلم الطويل "STOP"</h4>
                    </div>
                </div>

                <!-- Video 4 (YouTube - Karim) -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="pub" data-video-src="https://www.youtube.com/watch?v=agTN3tf9EQA">
                    <div class="portfolio-thumb">
                        <img src="https://img.youtube.com/vi/agTN3tf9EQA/hqdefault.jpg" alt="Music Video Production - Karim" class="portfolio-thumb-img">
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">الدعاية والوسائط المتعددة</span>
                            <span class="tag">كليب رسمي</span>
                        </div>
                        <h4 class="portfolio-title">إنتاج كليب موسيقي - كريم</h4>
                    </div>
                </div>

                <!-- Video 5 (YouTube - Rafie Lmadi Mat) -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="pub" data-video-src="https://www.youtube.com/watch?v=JYMQ8iCXhEc">
                    <div class="portfolio-thumb">
                        <img src="https://img.youtube.com/vi/JYMQ8iCXhEc/hqdefault.jpg" alt="Music Video Lmadi Mat" class="portfolio-thumb-img">
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">الدعاية والوسائط المتعددة</span>
                            <span class="tag">كليب رسمي</span>
                        </div>
                        <h4 class="portfolio-title">كليب موسيقي "الماضي مات" - رافع</h4>
                    </div>
                </div>

                <!-- Video 6 (YouTube - Rafie Qsadt Lbhar) -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="pub" data-video-src="https://www.youtube.com/watch?v=jEwq4g7fu0s">
                    <div class="portfolio-thumb">
                        <img src="https://img.youtube.com/vi/jEwq4g7fu0s/hqdefault.jpg" alt="Music Video Qsadt Lbhar" class="portfolio-thumb-img">
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">الدعاية والوسائط المتعددة</span>
                            <span class="tag">كليب رسمي</span>
                        </div>
                        <h4 class="portfolio-title">كليب موسيقي "قصدت البحر" - رافع</h4>
                    </div>
                </div>

                <!-- Video 7 (YouTube - Dekkat saat) -->
                <div class="portfolio-item" onclick="openVideoModal(this)" data-category="live" data-video-src="https://www.youtube.com/watch?v=8jJ0K7iMzF0">
                    <div class="portfolio-thumb">
                        <img src="https://img.youtube.com/vi/8jJ0K7iMzF0/hqdefault.jpg" alt="Live Capture Saat Al Borhane" class="portfolio-thumb-img">
                        <div class="play-overlay">
                            <div class="play-btn-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <div class="portfolio-meta">
                        <div class="portfolio-tags">
                            <span class="tag">سلاسل الويب والبث المباشر</span>
                            <span class="tag">بث مباشر</span>
                        </div>
                        <h4 class="portfolio-title">تصوير مباشر لـ "ساعة البرهان"</h4>
                    </div>
                </div>

            </div>

            <!-- Double CTA -->
            <div class="glass-card text-center" style="padding: 40px; border-color: rgba(0, 208, 120, 0.15);">
                <h3 style="font-size: 1.8rem; margin-bottom: 12px;">هل لديك مشروع سمعي بصري قريباً؟</h3>
                <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto 30px auto;">فرقنا في الرباط والدار البيضاء مستعدة لتقديم المشورة بشأن الحجم والمعدات اللازمة والهوية السردية الملائمة.</p>
                <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
                    <a href="contact-ar.php" class="btn btn-primary">طلب تقدير تكلفة</a>
                    <a href="contact-ar.html?type=expert" class="btn btn-secondary">تحدث مع خبير</a>
                </div>
            </div>

        </div>
    </section>

    <!-- Custom Pop-up Video Modal -->
    <div class="video-modal" id="video-modal">
        <div class="modal-content">
            <button class="close-modal" id="close-modal" aria-label="أغلق"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-video-wrapper">
                <!-- Video player (HTML5 or Youtube) will be dynamically injected here -->
            </div>
            <div class="modal-info-panel">
                <h3 id="modal-video-title" style="margin-bottom: 8px;">عنوان الفيديو</h3>
                <p id="modal-video-desc" style="color: var(--text-muted); font-size: 0.9rem;">وصف العميل</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container footer-grid">
            <div>
                <div class="footer-logo logo-text" style="font-size: 1.5rem;">ATLAS<span>MULTIMEDIA</span></div>
                <p class="footer-desc">منذ عام 2017، متخصصون في إنتاج حملات الوسائط المتعددة وتنظيم الفعاليات وتصوير الفيديو للمؤسسات والشركات الملتزمة بكفاءة الطاقة.</p>
                <div class="footer-socials">
                    <a href="https://www.linkedin.com/company/hhbhbj/" target="_blank" class="social-icon" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100066799973840" target="_blank" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/channel/UCvHi1qz3QXP5QazH4JHUcog" target="_blank" class="social-icon" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://x.com/AmpAtlas" target="_blank" class="social-icon" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            <div>
                <h4 class="footer-title">روابط سريعة</h4>
                <ul class="footer-links">
                    <li><a href="index-ar.php">الرئيسية</a></li>
                    <li><a href="services-ar.php">خدماتنا</a></li>
                    <li><a href="portfolio-ar.php">أعمالنا</a></li>
                    <li><a href="about-ar.php">من نحن</a></li>
                    <li><a href="blog-ar.php">المدونة</a></li>
                    <li><a href="contact-ar.php">طلب تقدير تكلفة</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">مكاتبنا</h4>
                <div class="office-info" style="margin-bottom: 16px;">
                    <strong>المقر الرئيسي (الرباط):</strong><br>
                    الرباط، المغرب
                </div>
                <div class="office-info">
                    <strong>المكتب التجاري (الدار البيضاء):</strong><br>
                    الدار البيضاء، المغرب
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2026 أطلس مالتي ميديا للإنتاج. جميع الحقوق محفوظة.</p>
            <p>صمم لخدمة الانتقال الطاقي والاستدامة في المغرب.</p>
        </div>
    </footer>

    <!-- Plyr library JS -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="app.js"></script>
</body>
</html>
