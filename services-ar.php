<?php require_once 'cms_helper.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدماتنا - أطلس مالتي ميديا للإنتاج</title>
    <meta name="description" content="خدماتنا السمعية البصرية المتخصصة: حملات الوسائط المتعددة، تنظيم الفعاليات المهنية، وتصوير البث المباشر بالمغرب. مكاتبنا بالرباط والدار البيضاء.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container nav-container">
            <a href="index-ar.php" class="logo-wrapper">
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
                    <li><a href="index-ar.php">الرئيسية</a></li>
                    <li><a href="services-ar.php" class="active">خدماتنا</a></li>
                    <li><a href="portfolio-ar.php">أعمالنا</a></li>
                    <li><a href="about-ar.php">من نحن</a></li>
                    <li><a href="blog-ar.php">المدونة</a></li>
                    <li><a href="contact-ar.php" class="btn btn-primary" style="padding: 8px 20px; font-size: 0.9rem; color: #050807;">طلب تقدير تكلفة</a></li>
                    <li class="lang-switcher">
                        <button class="lang-btn" aria-label="اللغة"><i class="fa-solid fa-globe"></i> AR <i class="fa-solid fa-chevron-down"></i></button>
                        <div class="lang-dropdown">
                            <a href="services.php">English</a>
                            <a href="services-fr.php">Français</a>
                            <a href="services-ar.php" class="ar-font">العربية</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Subpage Banner -->
    <section class="section-padding" style="background: linear-gradient(180deg, var(--bg-surface) 0%, var(--bg-main) 100%); margin-top: var(--header-height); padding: 80px 0 40px 0;">
        <div class="container text-center">
            <span class="section-subtitle">خبرتنا</span>
            <h1 style="font-size: 3rem; margin-bottom: 16px;">خدماتنا السمعية البصرية</h1>
            <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">نجمع بين التميز التقني والسرد البصري المؤثر لتعزيز الانتقال البيئي، من الفعاليات إلى محتوى البث.</p>
        </div>
    </section>

    <!-- Detailed Services List -->
    <section class="section-padding" id="campagnes" style="border-top: 1px solid var(--border-color);">
        <div class="container about-split">
            <div>
                <div style="color: var(--primary); font-size: 3rem; margin-bottom: 20px;"><i class="fa-solid fa-photo-film"></i></div>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">القطب 1: إنتاج حملات الوسائط المتعددة</h2>
                <p style="color: var(--text-muted); margin-bottom: 16px;">نصمم حملات عالية التأثير مصممة خصيصًا لقنوات الاتصال الحديثة (التلفزيون، الأجهزة المحمولة، ومنصات البث الرقمي). يتولى فريقنا إدارة العملية الإبداعية والتقنية بأكملها، من كتابة السيناريو إلى الإنتاج النهائي.</p>
                <ul style="list-style: none; margin-bottom: 30px;">
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> إعلانات تلفزيونية وفيديوهات ترويجية للويب</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> محتوى مخصص للشبكات الاجتماعية (تنسيق عمودي 9:16)</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> أفلام وثائقية مؤسسية قصيرة</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> إنشاء وإنتاج بودكاست للشركات البيئية</li>
                </ul>
                <a href="contact-ar.html?service=campagne" class="btn btn-primary">ابدأ مشروعي</a>
            </div>
            <div class="glass-card" style="padding: 24px; background: rgba(14,22,18,0.4); text-align: center;">
                <div style="font-size: 4rem; color: var(--secondary); margin-bottom: 16px;"><i class="fa-solid fa-film"></i></div>
                <h4 style="margin-bottom: 12px;">جاهز للبث الرقمي OTT</h4>
                <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px;">تلبي إنتاجاتنا أدق معايير الترميز للبث السلس على منصات مثل يوتيوب، ونتفليكس، والشبكات الاجتماعية.</p>
                <div style="display: flex; justify-content: center; gap: 16px; font-size: 1.5rem; color: var(--text-muted);">
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fa-brands fa-tiktok"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding" id="evenements" style="background-color: var(--bg-surface); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color);">
        <div class="container about-split">
            <div class="glass-card" style="padding: 24px; background: rgba(8,12,10,0.4); text-align: center; order: 2;">
                <div style="font-size: 4rem; color: var(--secondary); margin-bottom: 16px;"><i class="fa-solid fa-tower-broadcast"></i></div>
                <h4 style="margin-bottom: 12px;">البث المباشر عالي الدقة</h4>
                <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px;">غرفة تحكم متنقلة مدمجة بكاميرات متعددة لبث ندواتك ومؤتمراتك مباشرة على منصات متعددة في وقت واحد، دون أي تأخير.</p>
                <div style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.8rem; background: rgba(255, 50, 50, 0.15); color: rgb(255, 80, 80); padding: 4px 12px; border-radius: 4px; font-weight: 700;">
                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: red; animation: pulse 1.5s infinite;"></span> مباشر
                </div>
            </div>
            <div style="order: 1;">
                <div style="color: var(--primary); font-size: 3rem; margin-bottom: 20px;"><i class="fa-solid fa-people-group"></i></div>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">القطب 2: تنظيم الفعاليات المتخصصة</h2>
                <p style="color: var(--text-muted); margin-bottom: 16px;">نصمم فعاليات مهنية مصممة خصيصًا لجمع شركائك معًا. من الخدمات اللوجستية إلى التغطية الإعلامية الكاملة، ننسق كل جانب من جوانب فعالياتك.</p>
                <ul style="list-style: none; margin-bottom: 30px;">
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> معارض ومؤتمرات نجاعة الطاقة والبيئة</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> منتديات الشركات والمؤتمرات القطاعية</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> تنظيم الويبينار والندوات عبر الإنترنت</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> لوجستيات الفعاليات، الخيام ومنصات العرض</li>
                </ul>
                <a href="contact-ar.html?service=evenement" class="btn btn-primary">خطط لفعالية</a>
            </div>
        </div>
    </section>

    <section class="section-padding" id="captation">
        <div class="container about-split">
            <div>
                <div style="color: var(--primary); font-size: 3rem; margin-bottom: 20px;"><i class="fa-solid fa-tower-broadcast"></i></div>
                <h2 style="font-size: 2.2rem; margin-bottom: 20px;">القطب 3: التصوير والمحتوى الرقمي</h2>
                <p style="color: var(--text-muted); margin-bottom: 16px;">نقدم تسجيلات عالية الجودة لتوثيق مؤتمراتك ومبادراتك. كما ننشئ مواد تعليمية متحركة لشرح ابتكاراتك البيئية.</p>
                <ul style="list-style: none; margin-bottom: 30px;">
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> سلاسل ويب تعليمية حول الانتقال البيئي</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> فيديوهات توضيحية (رسوم متحركة وإنفوجرافيك)</li>
                    <li style="margin-bottom: 12px; font-size: 0.95rem; display: flex; align-items: center; gap: 12px; color: var(--text-muted);"><i class="fa-solid fa-check" style="color: var(--primary);"></i> تصوير حفلات إطلاق المنتجات والأمسيات الافتتاحية</li>
                </ul>
                <a href="contact-ar.html?service=captation" class="btn btn-primary">طلب تقدير تكلفة</a>
            </div>
            <div class="glass-card" style="padding: 24px; background: rgba(14,22,18,0.4); text-align: center;">
                <div style="font-size: 4rem; color: var(--secondary); margin-bottom: 16px;"><i class="fa-solid fa-desktop"></i></div>
                <h4 style="margin-bottom: 12px;">الاستوديو ومرحلة ما بعد الإنتاج</h4>
                <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px;">محطات عمل مونتاج عالية الأداء واستوديو مجهز بخلفية كروما خضراء/بيضاء لجميع احتياجات التسجيل والدمج البصري بالرباط.</p>
                <span style="font-size: 0.8rem; color: var(--primary); font-weight: 700;"><i class="fa-solid fa-shield-halved"></i> مونتاج وتلوين سينمائي (متاح بالرباط فقط)</span>
            </div>
        </div>
    </section>

    <!-- Equipment & Technical Fleet Section -->
    <section class="section-padding" style="background-color: var(--bg-surface-elevated); border-top: 1px solid var(--border-color);">
        <div class="container">
            <div class="text-center" style="margin-bottom: 48px;">
                <span class="section-subtitle">أسطول التصوير والبث السينمائي</span>
                <h2 style="font-size: 2.5rem; margin-bottom: 12px;">المعدات والتقنيات الاحترافية</h2>
                <p style="color: var(--text-muted); max-width: 650px; margin: 0 auto;">أحدث الأجهزة والمعدات السمعية البصرية للإنتاجات المؤسسية رفيعة المستوى والفعاليات والأفلام الوثائقية حول الطاقة النظيفة بالمغرب.</p>
            </div>
            <div class="grid-3">
                <div class="glass-card" style="padding: 24px;">
                    <div style="color: var(--primary); font-size: 2rem; margin-bottom: 16px;"><i class="fa-solid fa-camera-retro"></i></div>
                    <h3 style="font-size: 1.25rem; margin-bottom: 12px;">كاميرات السينما والطائرات المسيرة</h3>
                    <ul style="list-style: none; color: var(--text-muted); font-size: 0.9rem; line-height: 1.8;">
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> أنظمة سينمائية ARRI Alexa و RED Dragon</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> كاميرات بث احترافية Sony و Canon 4K</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> طائرات درون 4K مع طيارين معتمدين</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> أنظمة تثبيت الحركة Steadicam و Gimbals</li>
                    </ul>
                </div>
                <div class="glass-card" style="padding: 24px;">
                    <div style="color: var(--primary); font-size: 2rem; margin-bottom: 16px;"><i class="fa-solid fa-microphone-lines"></i></div>
                    <h3 style="font-size: 1.25rem; margin-bottom: 12px;">الهندسة الصوتية والتسجيل High-End</h3>
                    <ul style="list-style: none; color: var(--text-muted); font-size: 0.9rem; line-height: 1.8;">
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> أنظمة لا سلكية متعددة القنوات Sennheiser</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> ميكروفونات موجهة وميكروفونات Rode HD</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> أنظمة مكبرات صوت متكاملة للمؤتمرات</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> أجهزة تسجيل رقمية عالية الجودة multi-track</li>
                    </ul>
                </div>
                <div class="glass-card" style="padding: 24px;">
                    <div style="color: var(--primary); font-size: 2rem; margin-bottom: 16px;"><i class="fa-solid fa-tv"></i></div>
                    <h3 style="font-size: 1.25rem; margin-bottom: 12px;">شاشات LED والعرض العملاق</h3>
                    <ul style="list-style: none; color: var(--text-muted); font-size: 0.9rem; line-height: 1.8;">
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> جدران شاشات LED تفاعلية (P2.6, P2.9, P3.9)</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> أجهزة عرض فيديو عالية الإضاءة HD</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> وحدات تحكم وبث مباشر متنقلة Mobile Switchers</li>
                        <li><i class="fa-solid fa-angle-left" style="color: var(--primary); margin-left: 6px;"></i> خيام ومستلزمات معارض مجهزة بالكامل</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners / Reassurance Marquee -->
    <section class="marquee-section" style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 40px 0; background: rgba(10, 20, 17, 0.2);">
        <div class="container" style="padding-bottom: 12px;"><h4 style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 15px; text-align: center;">شركاء يثقون بنا</h4></div>
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
                    <strong>الفرع (الدار البيضاء):</strong><br>
                    22، شارع فرانس فيل، رقم 28، الواحة، 20103 الدار البيضاء
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
