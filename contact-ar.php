<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا وطلب تقدير تكلفة - أطلس مالتي ميديا للإنتاج</title>
    <meta name="description" content="اطلب تقدير تكلفة مجاني لمشروع الإنتاج السمعي البصري أو تصوير الفعاليات بالمغرب. مكاتبنا بالرباط والدار البيضاء.">
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="portfolio-ar.php">أعمالنا</a></li>
                    <li><a href="about-ar.php">من نحن</a></li>
                    <li><a href="blog-ar.php">المدونة</a></li>
                    <li><a href="contact-ar.php" class="active">طلب تقدير تكلفة</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="اللغة"><i class="fa-solid fa-globe"></i> AR <i class="fa-solid fa-chevron-down"></i></button>
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
            <span class="section-subtitle">اتصل بنا</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">طلب تقدير تكلفة</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">خطط لمشروعك السمعي البصري أو التنظيمي. املأ استمارتنا التفاعلية لتلقي تقدير تكلفة في غضون 24 ساعة.</p>
            <p style="color: var(--text-muted); max-width: 600px; margin: 15px auto 0 auto;">أو راسلنا مباشرة عبر البريد الإلكتروني: <a href="mailto:h.barakat00@gmail.com" style="color: var(--primary); font-weight: 600; text-decoration: none;" dir="ltr">h.barakat00@gmail.com</a></p>
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
                        <h3 style="margin-bottom: 24px; font-size: 1.5rem; text-align: center;">ما هو نوع المشروع الذي تخطط له؟</h3>
                        <div class="options-grid">
                            <!-- Card 1 -->
                            <div class="option-card" data-value="multimedia">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-photo-film"></i></div>
                                <h4>حملة وسائط متعددة</h4>
                                <p>إعلانات تجارية، بودكاست للشركات، أو مقاطع فيديو قصيرة عمودية للشبكات الاجتماعية (9:16).</p>
                            </div>
                            <!-- Card 2 -->
                            <div class="option-card" data-value="evenement">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-people-group"></i></div>
                                <h4>فعالية ومنتدى</h4>
                                <p>مؤتمر مهني، تجهيزات أجنحة المعارض، وتغطية إعلامية سمعية بصرية شاملة.</p>
                            </div>
                            <!-- Card 3 -->
                            <div class="option-card" data-value="captation">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-tower-broadcast"></i></div>
                                <h4>تصوير وبث مباشر</h4>
                                <p>بث مباشر متعدد الكاميرات على الإنترنت أو سلاسل ويب تعليمية حول البيئة.</p>
                            </div>
                            <!-- Card 4 -->
                            <div class="option-card" data-value="postprod">
                                <div style="color: var(--primary); font-size: 1.8rem; margin-bottom: 12px;"><i class="fa-solid fa-film"></i></div>
                                <h4>إنتاج استوديو ومونتاج</h4>
                                <p>تلوين سينمائي DaVinci Resolve، مونتاج، أو حجز استوديو الكروما الأخضر/الأبيض.</p>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: Contact & Company Details -->
                    <div class="form-step" data-step="1">
                        <h3 style="margin-bottom: 24px; font-size: 1.5rem; text-align: center;">عرف عن نفسك وتفاصيل احتياجاتك</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-name">الاسم الكامل *</label>
                                <input type="text" id="form-name" class="form-control" placeholder="مثال: هشام بنجلون" required>
                            </div>
                            <div class="form-group">
                                <label for="form-email">البريد الإلكتروني *</label>
                                <input type="email" id="form-email" class="form-control" placeholder="مثال: contact@company.ma" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-phone">رقم الهاتف</label>
                                <input type="tel" id="form-phone" class="form-control" placeholder="مثال: +212 600 000 000">
                            </div>
                            <div class="form-group">
                                <label for="form-company">اسم الشركة / المؤسسة</label>
                                <input type="text" id="form-company" class="form-control" placeholder="مثال: كلايمت تيك المغرب">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="form-desc">وصف مختصر للمشروع *</label>
                            <textarea id="form-desc" class="form-control" rows="4" placeholder="صف أهداف المشروع، والمدة التقريبية، وأي متطلبات خاصة بالصوت أو الصورة..." required></textarea>
                        </div>
                    </div>

                    <!-- STEP 3: Budget, Location & Dates -->
                    <div class="form-step" data-step="2">
                        <h3 style="margin-bottom: 24px; font-size: 1.5rem; text-align: center;">تفاصيل التخطيط</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-location">الموقع الرئيسي للمشروع *</label>
                                <select id="form-location" class="form-control" required>
                                    <option value="" disabled selected>اختر المدينة</option>
                                    <option value="rabat">الرباط (المقر الرئيسي)</option>
                                    <option value="casablanca">الدار البيضاء (الفرع)</option>
                                    <option value="other-maroc">مدينة أخرى في المغرب</option>
                                    <option value="international">خارج المغرب</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form-budget">الميزانية التقديرية (درهم) *</label>
                                <select id="form-budget" class="form-control" required>
                                    <option value="" disabled selected>اختر النطاق</option>
                                    <option value="low">أقل من 20,000 درهم مغربي</option>
                                    <option value="mid">20,000 - 50,000 درهم مغربي</option>
                                    <option value="high">50,000 - 150,000 درهم مغربي</option>
                                    <option value="premium">أكثر من 150,000 درهم مغربي</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="form-date">التاريخ المطلوب للبدء</label>
                                <input type="date" id="form-date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label style="opacity: 0;">Spacer</label>
                                <div style="font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 8px; height: 50px;">
                                    <i class="fa-solid fa-lock" style="color: var(--primary);"></i> بياناتك مشفرة وتتمتع بالسرية التامة.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="form-actions">
                        <button type="button" id="prev-step" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-chevron-left" style="margin-left: 8px;"></i> السابق</button>
                        <button type="button" id="next-step" class="btn btn-primary">التالي <i class="fa-solid fa-chevron-right" style="margin-right: 8px;"></i></button>
                        <button type="submit" id="submit-form" class="btn btn-primary" style="display: none;">إرسال الطلب <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i></button>
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

    <script src="app.js"></script>
</body>
</html>
