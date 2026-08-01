/**
 * Atlas Multimedia Productions (AMP) - Main Application Script
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Navigation Menu Toggle
    const mobileToggle = document.getElementById('mobile-toggle');
    const navbar = document.getElementById('navbar');

    if (mobileToggle && navbar) {
        mobileToggle.addEventListener('click', () => {
            navbar.classList.toggle('open');
            // Toggle hamburger icon animation
            const spans = mobileToggle.querySelectorAll('span');
            if (navbar.classList.contains('open')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }

    // 2. Language Switcher Dropdown Click Toggle
    const langBtn = document.querySelector('.lang-btn');
    const langDropdown = document.querySelector('.lang-dropdown');
    if (langBtn && langDropdown) {
        langBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            langDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            langDropdown.classList.remove('show');
        });
    }

    // 3. Header Scroll Effect
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // 3. Stats / Counters Count Up Animation
    const counters = document.querySelectorAll('.counter-card h3');
    if (counters.length > 0) {
        const countUp = (counter) => {
            const targetText = counter.innerText;
            const isPercentage = targetText.includes('%');
            const isPlus = targetText.includes('+');
            const target = parseInt(targetText.replace(/[^0-9]/g, ''));
            const speed = 200; // time in ms
            const step = target / speed;
            let current = 0;

            const update = () => {
                current += step;
                if (current < target) {
                    counter.innerText = Math.floor(current) + (isPercentage ? '%' : '') + (isPlus ? '+' : '');
                    setTimeout(update, 1);
                } else {
                    counter.innerText = targetText;
                }
            };
            update();
        };

        // Trigger on load (or using IntersectionObserver for scroll-trigger)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const h3 = entry.target.querySelector('h3');
                    if (h3 && !h3.classList.contains('counted')) {
                        countUp(h3);
                        h3.classList.add('counted');
                    }
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.counter-card').forEach(card => {
            observer.observe(card);
        });
    }

    // 4. Portfolio Filters & Modal Video Player (on portfolio.php)
    const portfolioGrid = document.querySelector('.portfolio-grid');
    if (portfolioGrid) {
        setupPortfolio();
    }

    // 5. Multi-step Quote Form (on contact.php)
    const quoteForm = document.getElementById('quote-form');
    if (quoteForm) {
        setupQuoteForm();
    }

    // 6. Equipment Tab Switching (on about.php)
    const eqTabs = document.querySelectorAll('.equipment-tabs button');
    if (eqTabs.length > 0) {
        setupEquipmentTabs();
    }

    // 7. Custom Interactive Chatbot (Replacing placeholder Crisp)
    /* 
    To reactivate Crisp in the future, uncomment the block below and replace the website ID:
    window.$crisp = [];
    window.CRISP_WEBSITE_ID = "YOUR_REAL_CRISP_WEBSITE_ID";
    (function() {
        var d = document;
        var s = d.createElement("script");
        s.src = "https://client.crisp.chat/l.js";
        s.async = 1;
        d.getElementsByTagName("head")[0].appendChild(s);
    })();
    */
    setupCustomChatbot();
});

/**
 * Custom Interactive Chatbot for AMP website (EN, FR, AR)
 */
function setupCustomChatbot() {
    const lang = document.documentElement.lang || 'en';
    const isRtl = document.documentElement.dir === 'rtl';

    let chatState = {
        step: 'idle', // 'idle', 'awaiting_type', 'awaiting_location', 'awaiting_budget', 'awaiting_contact'
        data: {}
    };

    // Q&A Dictionary with interactive quote builders
    const chatData = {
        en: {
            botName: "AMP Assistant",
            welcome: "Hello! Welcome to Atlas Multimedia Productions. How can I help you today? Ask about our services, locations, or type **quote** to calculate an estimate.",
            placeholder: "Type a message...",
            questions: [
                "What services do you offer?",
                "Where are your offices located?",
                "How can I request a quote?",
                "What is your main expertise?"
            ],
            responses: {
                "services": "We specialize in three main areas:\n1. 🎬 **Multimedia Campaigns**: TV commercials, corporate podcasts, and optimized vertical social media content (9:16 format).\n2. 👥 **Events & Forums**: Organizing professional exhibitions, webinars, and green energy conferences.\n3. 📡 **Captation & Live Stream**: Multi-camera HD live broadcasting and educational web series.",
                "offices": "We have two locations in Morocco:\\n📍 **Head Office (Rabat)**: Rabat, Morocco",
                "quote": "You can request a free estimate by filling out our step-by-step form on the [Contact & Quote](contact.php) page, or just tell me **\"start quote\"** to build it here in the chat!",
                "expertise": "Since 2017, we have produced premium AV content. Today, we specialize in translating complex green tech, engineering achievements, and energy efficiency & sustainability data into human, high-impact visual stories."
            },
            greetResponse: "Hello! I am your AMP Assistant. Feel free to choose one of the questions below or ask me any details. You can also type **quote** to begin a conversational estimate builder.",
            unknown: "I'm sorry, I didn't quite catch that. Please select one of the suggested questions below, or contact us directly at contact@atlas-multimedia.com!",
            quoteStart: "Let's build your quote right here! 📋<br><br>First, **what type of project** are you planning?<br>1. **Campaign** (Ads, Promo videos, corporate podcasts)<br>2. **Event** (Professional conferences, forums, stands)<br>3. **Live** (Multi-camera streaming & broadcast)<br>4. **Post-Prod** (Color grading, editing, cyclorama studio)",
            quoteStepLocation: "Got it! **Where** will the project take place?<br>*(e.g., Rabat, Casablanca, other Moroccan city, or international)*",
            quoteStepBudget: "Understood. What is your **estimated budget**?<br>1. **Under 20,000 MAD**<br>2. **20,000 - 50,000 MAD**<br>3. **50,000 - 150,000 MAD**<br>4. **Over 150,000 MAD**",
            quoteStepContact: "Great! Finally, what is your **Full Name and Email Address**? (e.g., *John Doe, john@company.com*)",
            quoteSuccess: "Awesome! I have logged your request. Your Reference ID is **{refId}**.<br><br>Our team in Rabat & Casablanca will review it and send a detailed estimation to **{email}** within 24 hours. Thank you!",
            quoteError: "Oops, it seems the contact information you provided was not valid. Please enter your name and a valid email separated by a comma (e.g. *John Doe, name@company.com*)."
        },
        fr: {
            botName: "Assistant AMP",
            welcome: "Bonjour ! Bienvenue chez Atlas Multimedia Productions. Comment puis-je vous aider aujourd'hui ? Posez vos questions ou tapez **devis** pour créer une estimation.",
            placeholder: "Écrivez votre message...",
            questions: [
                "Quels services proposez-vous ?",
                "Où se trouvent vos bureaux ?",
                "Comment demander un devis ?",
                "Quelle est votre expertise principale ?"
            ],
            responses: {
                "services": "Nous sommes spécialisés dans trois pôles de services :\n1. 🎬 **Campagnes Multimédias** : Spots TV, podcasts d'entreprise et contenus réseaux sociaux au format vertical 9:16.\n2. 👥 **Événements & Forums** : Organisation complète de salons, webinaires et forums sur la transition énergétique et durabilité.\n3. 📡 **Captation & Live Stream** : Enregistrement HD de conférences et diffusion en direct multi-caméras sans latence.",
                "offices": "Nous sommes implantés dans deux villes au Maroc :\\n📍 **Siège Social (Rabat)** : Rabat, Morocco",
                "quote": "Vous pouvez demander un devis gratuit en complétant notre formulaire interactif sur la page [Contact & Devis](contact-fr.php), ou dites-moi **\"lancer devis\"** pour le faire ici par message !",
                "expertise": "Spécialiste de la production audiovisuelle institutionnelle depuis 8 ans, nous comblons le fossé entre l'ingénierie verte et l'engagement humain en concevant des récits visuels captivants."
            },
            greetResponse: "Bonjour ! Je suis votre assistant AMP. Vous pouvez me poser des questions sur nos services, m'indiquer vos besoins, ou taper **devis** pour lancer notre assistant interactif.",
            unknown: "Désolé, je n'ai pas bien compris. N'hésitez pas à cliquer sur une des questions suggérées ci-dessous ou à nous contacter à contact@atlas-multimedia.com !",
            quoteStart: "Créons votre devis ici ! 📋<br><br>Tout d'abord, **quel type de projet** planifiez-vous ?<br>1. **Campagne** (Publicités, vidéos promo, podcasts)<br>2. **Événement** (Conférences, salons, logistique)<br>3. **Direct** (Bureaux de régie, live stream multi-caméras)<br>4. **Post-Prod** (Montage, DaVinci, studio cyclo (Exclusivement à Rabat))",
            quoteStepLocation: "Reçu ! **Où** se déroulera le projet ?<br>*(ex: Rabat, Casablanca, autre ville au Maroc, international)*",
            quoteStepBudget: "Compris. Quel est votre **budget estimatif** ?<br>1. **Moins de 20 000 DH**<br>2. **20 000 - 50 000 DH**<br>3. **50 000 - 150 000 DH**<br>4. **Plus de 150 000 DH**",
            quoteStepContact: "Parfait ! Enfin, quels sont vos **Nom Complet et Adresse Email** ? (ex: *Jean Dupont, jean@entreprise.com*)",
            quoteSuccess: "Super ! Votre demande a été enregistrée. Référence de suivi : **{refId}**.<br><br>Notre équipe à Rabat et Casablanca va l'étudier et vous enverra un chiffrage détaillé à **{email}** sous 24h. Merci !",
            quoteError: "Oups, les informations fournies semblent incorrectes. Veuillez saisir votre nom et un e-mail valide séparés par une virgule (ex: *Jean Dupont, email@entreprise.com*)."
        },
        ar: {
            botName: "مساعد أطلس",
            welcome: "مرحباً بكم في أطلس مالتي ميديا للإنتاج! كيف يمكنني مساعدتكم اليوم؟ اسألني عن خدماتنا ومكاتبنا، أو اكتب **تقدير** لبدء بناء تقدير تكلفة هنا مباشرة.",
            placeholder: "اكتب رسالة...",
            questions: [
                "ما هي الخدمات التي تقدمونها؟",
                "أين توجد مكاتبكم؟",
                "كيف يمكنني طلب تقدير تكلفة؟",
                "ما هو مجال خبرتكم الرئيسي؟"
            ],
            responses: {
                "services": "نحن متخصصون في ثلاثة مجالات رئيسية:\n1. 🎬 **حملات الوسائط المتعددة**: إعلانات تلفزيونية، بودكاست للمؤسسات، وفيديوهات عمودية 9:16 للشبكات الاجتماعية.\n2. 👥 **الفعاليات والمنتديات**: تنظيم المعارض المهنية والويبينار والندوات حول نجاعة الطاقة.\n3. 📡 **البث المباشر والتصوير**: البث الحي عالي الدقة عبر كاميرات متعددة وسلسلة الويب التعليمية.",
                "offices": "مكاتبنا متواجدة في مدينتين بالمغرب:\\n📍 **المقر الرئيسي (الرباط)**: الرباط، المغرب",
                "quote": "يمكنكم طلب تقدير تكلفة مجاني عبر ملء استمارتنا التفاعلية في صفحة [الاتصال والتقدير](contact-ar.php)، أو قل لي **\"ابدأ التقدير\"** لبنائه في المحادثة مباشرة!",
                "expertise": "منذ 2017، نتخصص في الإنتاج السمعي البصري للمؤسسات. اليوم، نكرس خبرتنا لتبسيط مشاريع الطاقة المتجددة ونجاعة الطاقة وتحويل البيانات المعقدة إلى قصص مرئية مؤثرة."
            },
            greetResponse: "مرحباً! أنا مساعد أطلس للإنتاج. يسعدني الإجابة على استفساراتكم أو مساعدتكم في حساب تكلفة المشروع بمجرد كتابة **تقدير**.",
            unknown: "عذراً، لم أفهم ذلك تماماً. يرجى اختيار أحد الأسئلة المقترحة أدناه، أو التواصل معنا مباشرة عبر البريد contact@atlas-multimedia.com!",
            quoteStart: "دعنا نحدد تقدير التكلفة هنا! 📋<br><br>أولاً، **ما هو نوع المشروع** الذي تخطط له؟<br>1. **حملة** (إعلانات، بودكاست، فيديوهات ترويجية)<br>2. **فعالية** (مؤتمرات، معارض، لوجستيات)<br>3. **بث مباشر** (تصوير متعدد الكاميرات وبث حي)<br>4. **استوديو** (مونتاج، تلوين سينمائي، استوديو كروما)",
            quoteStepLocation: "مفهوم! **أين** سيتم تنفيذ المشروع؟<br>*(مثال: الرباط، الدار البيضاء، مدينة مغربية أخرى، أو خارج المغرب)*",
            quoteStepBudget: "حسناً. ما هي **الميزانية التقديرية**؟<br>1. **أقل من 20,000 درهم**<br>2. **20,000 - 50,000 درهم**<br>3. **50,000 - 150,000 درهم**<br>4. **أكثر من 150,000 درهم**",
            quoteStepContact: "ممتاز! أخيراً، ما هو **الاسم الكامل والبريد الإلكتروني** الخاص بك؟ (مثال: *أحمد علوي، ahmed@company.ma*)",
            quoteSuccess: "رائع! لقد تم تسجيل طلبك بنجاح. رقم المرجع: **{refId}**.<br><br>سيقوم فريقنا بالرباط والدار البيضاء بمراجعة طلبك وإرسال تقدير مفصل إلى البريد **{email}** خلال 24 ساعة. شكراً لك!",
            quoteError: "عذراً، يبدو أن المعلومات المدخلة غير صحيحة. يرجى إدخال اسمك وبريدك الإلكتروني بشكل صحيح مفصولين بفاصلة (مثال: *أحمد علوي، email@company.ma*)."
        }
    };

    const strings = chatData[lang] || chatData.en;

    // Inject Chatbot elements to DOM
    const widget = document.createElement('div');
    widget.className = 'chatbot-widget';
    widget.innerHTML = `
        <button class="chat-bubble" aria-label="Open chat">
            <i class="fa-solid fa-comments"></i>
        </button>
        <div class="chat-window">
            <div class="chat-header">
                <div class="chat-brand">
                    <div class="chat-avatar"><i class="fa-solid fa-robot"></i></div>
                    <div class="chat-title">
                        <h4>${strings.botName}</h4>
                        <span>Online</span>
                    </div>
                </div>
                <button class="chat-close" aria-label="Close chat"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="chat-messages">
                <div class="chat-msg bot">${strings.welcome}</div>
            </div>
            <div class="chat-suggested"></div>
            <div class="chat-input-area">
                <input type="text" class="chat-input" placeholder="${strings.placeholder}">
                <button class="chat-send" aria-label="Send"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
    `;
    document.body.appendChild(widget);

    const bubble = widget.querySelector('.chat-bubble');
    const win = widget.querySelector('.chat-window');
    const closeBtn = widget.querySelector('.chat-close');
    const messagesContainer = widget.querySelector('.chat-messages');
    const suggestedContainer = widget.querySelector('.chat-suggested');
    const input = widget.querySelector('.chat-input');
    const sendBtn = widget.querySelector('.chat-send');

    // Populate suggested questions
    function updateSuggested() {
        suggestedContainer.innerHTML = '';
        strings.questions.forEach((q, idx) => {
            const btn = document.createElement('button');
            btn.className = 'chat-btn-suggest';
            btn.innerText = q;
            btn.addEventListener('click', () => handleQuestionClick(q, idx));
            suggestedContainer.appendChild(btn);
        });
    }
    updateSuggested();

    // Toggle Chat
    bubble.addEventListener('click', () => {
        win.classList.toggle('open');
        if (win.classList.contains('open')) {
            input.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        win.classList.remove('open');
    });

    // Add Message helper
    function appendMsg(text, sender) {
        const msg = document.createElement('div');
        msg.className = `chat-msg ${sender}`;
        
        // Format bold text and links
        let formatted = text
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" style="text-decoration: underline; color: var(--secondary); font-weight: 600;">$1</a>');
            
        msg.innerHTML = formatted;
        messagesContainer.appendChild(msg);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Handle Question Clicks
    function handleQuestionClick(qText, idx) {
        appendMsg(qText, 'user');
        
        if (idx === 2) {
            // Conversational Quote flow trigger
            chatState.step = 'awaiting_type';
            chatState.data = {};
            setTimeout(() => {
                appendMsg(strings.quoteStart, 'bot');
            }, 400);
        } else {
            let key = 'services';
            if (idx === 1) key = 'offices';
            else if (idx === 3) key = 'expertise';

            setTimeout(() => {
                appendMsg(strings.responses[key], 'bot');
            }, 400);
        }
    }

    // Handle User Input & State Machine
    function handleSend() {
        const text = input.value.trim();
        if (!text) return;

        appendMsg(text, 'user');
        input.value = '';

        setTimeout(() => {
            const cleanText = text.toLowerCase();

            // Intercept quote builder state machine
            if (chatState.step === 'awaiting_type') {
                chatState.data.project_type = text;
                chatState.step = 'awaiting_location';
                appendMsg(strings.quoteStepLocation, 'bot');
                return;
            }

            if (chatState.step === 'awaiting_location') {
                chatState.data.location = text;
                chatState.step = 'awaiting_budget';
                appendMsg(strings.quoteStepBudget, 'bot');
                return;
            }

            if (chatState.step === 'awaiting_budget') {
                chatState.data.budget = text;
                chatState.step = 'awaiting_contact';
                appendMsg(strings.quoteStepContact, 'bot');
                return;
            }

            if (chatState.step === 'awaiting_contact') {
                // Parse email and name (e.g. John Doe, email@company.com)
                const emailRegex = /[^\s@]+@[^\s@]+\.[^\s@]+/g;
                const match = text.match(emailRegex);
                
                if (match && match.length > 0) {
                    const email = match[0];
                    let name = text.replace(email, '').replace(/,/g, '').trim();
                    if (!name) name = "Customer (Chat)";

                    chatState.data.email = email;
                    chatState.data.name = name;

                    // Asynchronously submit to submit_quote.php
                    const payload = {
                        project_type: chatState.data.project_type,
                        location: chatState.data.location,
                        budget: chatState.data.budget,
                        name: chatState.data.name,
                        email: chatState.data.email,
                        description: "Conversational Quote Request via Chatbot widget.",
                        source: "chatbot"
                    };

                    fetch('submit_quote.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    })
                    .then(res => res.json())
                    .then(resData => {
                        const refId = resData.refId || 'AMP-CH-' + Math.floor(1000 + Math.random() * 9000);
                        const msg = strings.quoteSuccess.replace('{refId}', refId).replace('{email}', email);
                        appendMsg(msg, 'bot');
                    })
                    .catch(err => {
                        const refId = 'AMP-CH-' + Math.floor(1000 + Math.random() * 9000);
                        const msg = strings.quoteSuccess.replace('{refId}', refId).replace('{email}', email);
                        appendMsg(msg, 'bot');
                    });

                    // Reset State
                    chatState.step = 'idle';
                    chatState.data = {};
                } else {
                    appendMsg(strings.quoteError, 'bot');
                }
                return;
            }

            // Normal Q&A / Greetings trigger
            let matched = false;
            
            if (cleanText.includes('hello') || cleanText.includes('hi') || cleanText.includes('bonjour') || cleanText.includes('salut') || cleanText.includes('salam') || cleanText.includes('مرحبا')) {
                appendMsg(strings.greetResponse, 'bot');
                matched = true;
            } else if (cleanText.includes('service') || cleanText.includes('خدم') || cleanText.includes('pôle') || cleanText.includes('activité')) {
                appendMsg(strings.responses.services, 'bot');
                matched = true;
            } else if (cleanText.includes('bureau') || cleanText.includes('office') || cleanText.includes('adresse') || cleanText.includes('lieu') || cleanText.includes('rabat') || cleanText.includes('casa') || cleanText.includes('عنوان') || cleanText.includes('مكتب')) {
                appendMsg(strings.responses.offices, 'bot');
                matched = true;
            } else if (cleanText.includes('devis') || cleanText.includes('estimation') || cleanText.includes('quote') || cleanText.includes('cost') || cleanText.includes('chiffrage') || cleanText.includes('سعر') || cleanText.includes('تكلفة') || cleanText.includes('طلب') || cleanText.includes('تقدير')) {
                chatState.step = 'awaiting_type';
                chatState.data = {};
                appendMsg(strings.quoteStart, 'bot');
                matched = true;
            } else if (cleanText.includes('expertise') || cleanText.includes('spécial') || cleanText.includes('transition') || cleanText.includes('énergie') || cleanText.includes('énergétique') || cleanText.includes('خبرة') || cleanText.includes('طاقة') || cleanText.includes('بيئة')) {
                appendMsg(strings.responses.expertise, 'bot');
                matched = true;
            }

            if (!matched) {
                appendMsg(strings.unknown, 'bot');
            }
        }, 500);
    }

    sendBtn.addEventListener('click', handleSend);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            handleSend();
        }
    });
}

/**
 * Portfolio page setup (Filters, Custom Plyr Modal)
 */
function setupPortfolio() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.portfolio-item');
    const modal = document.getElementById('video-modal');
    const modalVideo = document.getElementById('modal-video');
    const modalTitle = document.getElementById('modal-video-title');
    const modalDesc = document.getElementById('modal-video-desc');
    const closeModalBtn = document.getElementById('close-modal');
    
    let playerInstance = null;

    // Filters
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            items.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Modal & Player setup
    items.forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation();
            window.openVideoModal(item);
        });
    });

    // Global openVideoModal function
    window.openVideoModal = function(item) {
        if (!item) return;
        const videoSrc = item.getAttribute('data-video-src');
        if (!videoSrc) return;

        const modalEl = document.getElementById('video-modal');
        const modalTitleEl = document.getElementById('modal-video-title');
        const modalDescEl = document.getElementById('modal-video-desc');
        const wrapper = document.querySelector('.modal-video-wrapper');
        if (!modalEl || !wrapper) return;

        const isYoutube = videoSrc.includes('youtube.com') || videoSrc.includes('youtu.be');
        const titleElem = item.querySelector('.portfolio-title');
        const title = titleElem ? titleElem.innerText : 'Portfolio Project';

        if (modalTitleEl) modalTitleEl.innerText = title;
        if (modalDescEl) modalDescEl.style.display = 'none';

        if (isYoutube) {
            let ytId = '';
            if (videoSrc.includes('youtu.be/')) {
                ytId = videoSrc.split('youtu.be/')[1].split('?')[0].split('#')[0];
            } else if (videoSrc.includes('v=')) {
                ytId = videoSrc.split('v=')[1].split('&')[0].split('#')[0];
            }
            wrapper.innerHTML = `<iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border:none;"></iframe>`;
        } else {
            wrapper.innerHTML = `<video id="player-container" controls autoplay playsinline style="width:100%; height:100%; border-radius:8px;">
                <source src="${videoSrc}" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>`;

            const videoEl = document.getElementById('player-container');
            if (videoEl) {
                videoEl.play().catch(e => console.log('Autoplay handled:', e));
            }
        }

        modalEl.classList.add('open');
        document.body.style.overflow = 'hidden';

        // Request Fullscreen safely
        const targetFullscreen = isYoutube ? wrapper : (document.getElementById('player-container') || wrapper);
        requestFullscreenMode(targetFullscreen || modalEl);
    };

    const requestFullscreenMode = (targetEl) => {
        if (!targetEl) return;
        const req = targetEl.requestFullscreen || targetEl.webkitRequestFullscreen || targetEl.mozRequestFullScreen || targetEl.msRequestFullscreen;
        if (req) {
            try {
                req.call(targetEl).catch(err => console.log('Fullscreen trigger info:', err));
            } catch (e) {}
        }
    };

    const exitFullscreenMode = () => {
        if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement) {
            const exit = document.exitFullscreen || document.webkitExitFullscreen || document.mozCancelFullScreen || document.msExitFullscreen;
            if (exit) {
                try { exit.call(document).catch(e => {}); } catch (e) {}
            }
        }
    };

    // Close Modal helper
    const closeModal = () => {
        if (modal) modal.classList.remove('open');
        document.body.style.overflow = '';
        exitFullscreenMode();
        const wrapper = document.querySelector('.modal-video-wrapper');
        if (wrapper) wrapper.innerHTML = ''; // Clear video
    };

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && modal.classList.contains('open')) {
            closeModal();
        }
    });
}

/**
 * Multi-step Form validation and step swapping
 */
function setupQuoteForm() {
    const steps = document.querySelectorAll('.form-step');
    const prevBtn = document.getElementById('prev-step');
    const nextBtn = document.getElementById('next-step');
    const submitBtn = document.getElementById('submit-form');
    const progressSteps = document.querySelectorAll('.progress-step');
    
    let currentStep = 0;

    const updateFormSteps = () => {
        steps.forEach((step, idx) => {
            step.classList.toggle('active', idx === currentStep);
        });

        progressSteps.forEach((step, idx) => {
            step.classList.toggle('active', idx === currentStep);
            step.classList.toggle('completed', idx < currentStep);
        });

        // Toggle buttons visibility
        prevBtn.style.display = currentStep === 0 ? 'none' : 'inline-flex';
        
        if (currentStep === steps.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-flex';
        } else {
            nextBtn.style.display = 'inline-flex';
            submitBtn.style.display = 'none';
        }
    };

    // Card selection (step 1 - options grid)
    const cards = document.querySelectorAll('.option-card');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            cards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            
            // Set value to hidden input
            const input = document.getElementById('project-type-input');
            if (input) {
                input.value = card.getAttribute('data-value');
            }
        });
    });

    nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            currentStep++;
            updateFormSteps();
        }
    });

    prevBtn.addEventListener('click', () => {
        currentStep--;
        updateFormSteps();
    });

    // Form Submission
    const quoteFormElement = document.getElementById('quote-form');
    quoteFormElement.addEventListener('submit', (e) => {
        e.preventDefault();
        if (validateStep(currentStep)) {
            // Build real API request body
            const formData = {
                project_type: document.getElementById('project-type-input').value,
                name: document.getElementById('form-name').value,
                email: document.getElementById('form-email').value,
                phone: document.getElementById('form-phone').value || '',
                company: document.getElementById('form-company').value || '',
                description: document.getElementById('form-desc').value,
                location: document.getElementById('form-location').value,
                budget: document.getElementById('form-budget').value,
                date: document.getElementById('form-date').value || '',
                source: 'form'
            };

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';

            fetch('submit_quote.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(resData => {
                const cardBody = document.querySelector('.glass-card.form-container');
                if (cardBody) {
                    let refId = resData.refId || 'AMP-' + Math.floor(1000 + Math.random() * 9000);
                    // Localize success screens
                    const pageLang = document.documentElement.lang || 'en';
                    let successTitle = "Demande Envoyée !";
                    let successText = `Merci pour votre demande. Notre équipe d'experts de Rabat et Casablanca va analyser vos besoins et vous recontactera sous 24 heures avec un devis estimatif.<br><br><strong>Référence de suivi : ${refId}</strong>`;
                    let backHome = "Retour à l'accueil";
                    let homeUrl = "index-fr.php";

                    if (pageLang === 'en') {
                        successTitle = "Request Submitted!";
                        successText = `Thank you for your request. Our team of experts in Rabat and Casablanca will analyze your requirements and contact you within 24 hours with an estimated quote.<br><br><strong>Tracking Reference: ${refId}</strong>`;
                        backHome = "Back to Home";
                        homeUrl = "index.php";
                    } else if (pageLang === 'ar') {
                        successTitle = "تم إرسال الطلب بنجاح!";
                        successText = `شكراً لطلبكم. سيقوم فريق خبرائنا بالرباط والدار البيضاء بدراسة متطلباتكم والتواصل معكم خلال 24 ساعة مع تقدير التكلفة.<br><br><strong>رقم مرجع المتابعة: ${refId}</strong>`;
                        backHome = "العودة للرئيسية";
                        homeUrl = "index-ar.php";
                    }

                    cardBody.innerHTML = `<div class="text-center" style="padding: 40px 0;">
                        <div style="font-size: 4rem; color: var(--primary); margin-bottom: 24px;"><i class="fa-solid fa-circle-check"></i></div>
                        <h2 style="font-size: 2rem; margin-bottom: 16px;">${successTitle}</h2>
                        <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto 30px auto;">${successText}</p>
                        <a href="${homeUrl}" class="btn btn-primary">${backHome}</a>
                    </div>`;
                }
            })
            .catch(err => {
                // Fallback local mock success if php server is not running
                const cardBody = document.querySelector('.glass-card.form-container');
                if (cardBody) {
                    let refId = 'AMP-' + Math.floor(1000 + Math.random() * 9000);
                    cardBody.innerHTML = `<div class="text-center" style="padding: 40px 0;">
                        <div style="font-size: 4rem; color: var(--primary); margin-bottom: 24px;"><i class="fa-solid fa-circle-check"></i></div>
                        <h2 style="font-size: 2rem; margin-bottom: 16px;">Saved Locally (Offline)</h2>
                        <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto 30px auto;">Thank you! Your quote request has been registered offline.<br><br><strong>Offline Reference: ${refId}</strong></p>
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                    </div>`;
                }
            });
        }
    });

    function validateStep(stepIdx) {
        let valid = true;
        const activeStep = steps[stepIdx];
        
        // Find required inputs in active step
        const requireds = activeStep.querySelectorAll('[required]');
        requireds.forEach(input => {
            if (!input.value.trim()) {
                valid = false;
                input.style.borderColor = 'red';
                // Reset style on input
                input.addEventListener('input', () => {
                    input.style.borderColor = '';
                }, { once: true });
            }
        });

        // Special check for dynamic card selection in step 1
        if (stepIdx === 0) {
            const selectValue = document.getElementById('project-type-input').value;
            if (!selectValue) {
                valid = false;
                alert('Veuillez sélectionner un type de projet pour continuer.');
            }
        }

        return valid;
    }

    // Initial state
    updateFormSteps();
}

/**
 * Tab switcher for technical equipment specs
 */
function setupEquipmentTabs() {
    const tabs = document.querySelectorAll('.equipment-tabs button');
    const contents = document.querySelectorAll('.eq-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const tabTarget = tab.getAttribute('data-target');

            contents.forEach(content => {
                if (content.id === tabTarget) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
        });
    });
}

// --- GATED CONTENT LOGIC ---
document.addEventListener('DOMContentLoaded', () => {
    const gatedWrappers = document.querySelectorAll('.gated-content-wrapper');
    if (gatedWrappers.length === 0) return;

    // Check if user already unlocked
    const isUnlocked = localStorage.getItem('amp_blog_unlocked') === 'true';
    if (isUnlocked) {
        gatedWrappers.forEach(w => w.classList.remove('locked'));
        return;
    }

    // Initialize forms
    gatedWrappers.forEach(wrapper => {
        const typeBtns = wrapper.querySelectorAll('.type-btn');
        const sections = wrapper.querySelectorAll('.form-section');
        const form = wrapper.querySelector('.gate-form');

        if (typeBtns.length > 0 && sections.length > 0) {
            typeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    typeBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    
                    const targetType = btn.getAttribute('data-type');
                    sections.forEach(sec => {
                        if (sec.getAttribute('data-section') === targetType) {
                            sec.classList.add('active');
                            // Enable inputs in this section
                            sec.querySelectorAll('input, select').forEach(el => el.disabled = false);
                        } else {
                            sec.classList.remove('active');
                            // Disable inputs in hidden sections so they don't block required validation
                            sec.querySelectorAll('input, select').forEach(el => el.disabled = true);
                        }
                    });
                });
            });
            // Trigger initial click on Individual
            typeBtns[0].click();
        }

        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const submitBtn = form.querySelector('.gate-submit');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Submitting...';
                submitBtn.disabled = true;

                // Collect form data based on active section
                const activeSection = form.querySelector('.form-section.active');
                const type = activeSection.getAttribute('data-section');
                const inputs = activeSection.querySelectorAll('input, select, textarea');
                
                let formData = { type: type };
                inputs.forEach(input => {
                    if (input.placeholder) {
                        // Use placeholder as key for simplicity since fields don't have name attributes yet
                        const key = input.placeholder.replace(/ \*/g, '').replace(/[^a-zA-Z0-9]/g, '');
                        formData[key] = input.value;
                    }
                });

                try {
                    const response = await fetch('submit_reader.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();
                    
                    if (result.status === 'success') {
                        localStorage.setItem('amp_blog_unlocked', 'true');
                        wrapper.classList.remove('locked');
                    } else {
                        alert(result.message || 'An error occurred. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Network error. Please try again later.');
                } finally {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
    });
});
