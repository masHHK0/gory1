// public/js/main.js

// ============ TABS ============
function initTabs() {
    const tabsBtns = document.querySelectorAll('.tabs__btn');
    const tabsContents = document.querySelectorAll('.tabs__content');
    
    tabsBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;
            
            tabsBtns.forEach(b => b.classList.remove('active'));
            tabsContents.forEach(c => c.classList.remove('active'));
            
            btn.classList.add('active');
            const tabContent = document.getElementById(target);
            if (tabContent) {
                tabContent.classList.add('active');
            }
        });
    });
}

// ============ FAQ ACCORDION ============
function initFaq() {
    const faqItems = document.querySelectorAll('.faq__item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq__question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            faqItems.forEach(i => i.classList.remove('active'));
            
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
}

// ============ CAMERA SIMULATION ============
function initCameras() {
    const cameraVideos = document.querySelectorAll('.camera-card__video');
    
    cameraVideos.forEach(camera => {
        setInterval(() => {
            const timestamp = new Date().getTime();
            const streamUrl = camera.dataset.stream;
            if (streamUrl) {
                camera.src = streamUrl + '?t=' + timestamp;
            }
        }, 30000);
    });
}

// ============ GALLERY LIGHTBOX ============
function initGallery() {
    const galleryItems = document.querySelectorAll('.gallery__item');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const imageSrc = item.querySelector('img').src;
            const title = item.querySelector('.gallery__overlay')?.textContent || '';
            
            const lightbox = document.createElement('div');
            lightbox.className = 'modal active';
            lightbox.innerHTML = `
                <div class="modal__content" style="max-width: 900px; padding: 20px;">
                    <span class="modal__close">&times;</span>
                    <img src="${imageSrc}" style="width: 100%; border-radius: 10px; margin-bottom: 15px;">
                    ${title ? `<p style="text-align: center; font-size: 18px;">${title}</p>` : ''}
                    <button class="btn btn--primary" style="display: block; margin: 15px auto 0;" onclick="this.closest('.modal').remove()">Закрыть</button>
                </div>
            `;
            document.body.appendChild(lightbox);
            
            const closeBtn = lightbox.querySelector('.modal__close');
            closeBtn.addEventListener('click', () => lightbox.remove());
            
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) lightbox.remove();
            });
            
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') lightbox.remove();
            });
        });
    });
}

// ============ MOBILE MENU ============
function initMobileMenu() {
    const menuToggle = document.querySelector('.header__menu-toggle');
    const menu = document.querySelector('.header__menu');
    
    if (menuToggle && menu) {
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active');
            const icon = menuToggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });
    }
}

// ============ SMOOTH SCROLL ============
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(targetId);
            if (target) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ============ SEARCH ============
function initSearch() {
    const searchInput = document.querySelector('.header__search-input');
    const searchBtn = document.querySelector('.header__search-btn');
    
    const performSearch = () => {
        const query = searchInput.value.trim();
        if (query.length >= 2) {
            window.location.href = `/search?q=${encodeURIComponent(query)}`;
        }
    };
    
    if (searchBtn) {
        searchBtn.addEventListener('click', performSearch);
    }
    
    if (searchInput) {
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }
}

// ============ BOOKING FORM ============
function initBookingForm() {
    // Формы бронирования отправляются обычным способом
    // AJAX не используется для надежности
    const bookingForms = document.querySelectorAll('.booking-form');
    
    bookingForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            // Простая проверка перед отправкой
            const startDate = form.querySelector('input[name="start_date"]');
            const endDate = form.querySelector('input[name="end_date"]');
            
            if (endDate && startDate && endDate.value && startDate.value) {
                if (endDate.value <= startDate.value) {
                    e.preventDefault();
                    showNotification('Дата окончания должна быть позже даты начала', 'error');
                    return false;
                }
            }
        });
    });
}

// ============ DATE VALIDATION ============
function initDateValidation() {
    const startDateInputs = document.querySelectorAll('input[name="start_date"]');
    const endDateInputs = document.querySelectorAll('input[name="end_date"]');
    
    startDateInputs.forEach(input => {
        input.addEventListener('change', () => {
            const relatedEndDate = input.closest('form').querySelector('input[name="end_date"]');
            if (relatedEndDate) {
                relatedEndDate.min = input.value;
                if (relatedEndDate.value && relatedEndDate.value < input.value) {
                    relatedEndDate.value = input.value;
                }
            }
        });
    });
}

// ============ NOTIFICATION SYSTEM ============
function showNotification(message, type = 'success') {
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(n => n.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;
    notification.innerHTML = `
        <span>${message}</span>
        <button style="background: none; border: none; color: white; margin-left: 15px; cursor: pointer; font-size: 18px;" onclick="this.parentElement.remove()">&times;</button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// ============ LAZY LOADING ============
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        images.forEach(img => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }
}

// ============ CONFIRM DIALOG ============
function confirmAction(message) {
    return new Promise((resolve) => {
        const modal = document.createElement('div');
        modal.className = 'modal active';
        modal.innerHTML = `
            <div class="modal__content">
                <h3 style="margin-bottom: 15px;">Подтверждение</h3>
                <p style="margin-bottom: 20px;">${message}</p>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button class="btn btn--small" id="confirm-cancel">Отмена</button>
                    <button class="btn btn--danger btn--small" id="confirm-ok">Подтвердить</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        
        modal.querySelector('#confirm-cancel').addEventListener('click', () => {
            modal.remove();
            resolve(false);
        });
        
        modal.querySelector('#confirm-ok').addEventListener('click', () => {
            modal.remove();
            resolve(true);
        });
    });
}

// ============ INITIALIZATION ============
document.addEventListener('DOMContentLoaded', () => {
    initTabs();
    initFaq();
    initCameras();
    initGallery();
    initMobileMenu();
    initSmoothScroll();
    initSearch();
    initBookingForm();
    initDateValidation();
    initLazyLoading();
});



// ============ GLOBAL FUNCTIONS ============
window.showNotification = showNotification;
window.confirmAction = confirmAction;

