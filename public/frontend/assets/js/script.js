// Navigation hamburger toggle (accessible)
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');
const navLinks = document.querySelectorAll('#nav-menu a');
const themeToggle = document.getElementById('theme-toggle');

const toggleMenu = (open) => {
    const isOpen = typeof open === 'boolean' ? open : !navMenu.classList.contains('active');
    navMenu.classList.toggle('active', isOpen);
    hamburger.setAttribute('aria-expanded', String(isOpen));
};

hamburger?.addEventListener('click', () => toggleMenu());

// Close menu on link click (mobile UX)
navLinks.forEach(link => link.addEventListener('click', () => toggleMenu(false)));

// Close menu on Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') toggleMenu(false);
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    const target = e.target;
    const clickedInsideMenu = navMenu?.contains(target) || hamburger?.contains(target);
    if (!clickedInsideMenu) toggleMenu(false);
});

// Theme Toggle with persistence (Light mode default)
const applyTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    const icon = themeToggle?.querySelector('i');
    if (icon) {
        icon.classList.remove('fa-sun', 'fa-moon');
        icon.classList.add(theme === 'light' ? 'fa-moon' : 'fa-sun');
    }
};

const preferredTheme = localStorage.getItem('theme') || 'light';
applyTheme(preferredTheme);

themeToggle?.addEventListener('click', () => {
    const current = document.documentElement.getAttribute('data-theme') || 'light';
    applyTheme(current === 'light' ? 'dark' : 'light');
});

// Hero parallax
const parallaxLayers = document.querySelectorAll('.parallax-layer');
const parallaxMove = (x, y) => {
    parallaxLayers.forEach((layer, i) => {
        const depth = (i + 1) * 8;
        layer.style.transform = `translate(${x * depth}px, ${y * depth}px)`;
    });
};

window.addEventListener('mousemove', (e) => {
    const x = (e.clientX / window.innerWidth) - 0.5;
    const y = (e.clientY / window.innerHeight) - 0.5;
    parallaxMove(x, y);
});

// Smooth reveal section animation
const sections = document.querySelectorAll('section');
const showSection = () => {
    sections.forEach(section => {
        const top = section.getBoundingClientRect().top;
        if (top < window.innerHeight - 100) {
            section.classList.add('visible');
        }
    });
};

window.addEventListener('scroll', showSection);
window.addEventListener('load', showSection);

// Typed Code Illustration in Hero
document.addEventListener("DOMContentLoaded", () => {
    const codeElement = document.getElementById("typed-code");
    if (!codeElement) return;

    const codeSnippet = `class Creavibe {
    constructor() {
        this.focus = "SaaS & Business Software";
        this.stack = ["Laravel", "Golang", "React", "Vue"];
    }

    build(product) {
        return \`Scaling \${product} with clean architecture\`;
    }
}`;

    let i = 0;
    function typeCode() {
        if (i < codeSnippet.length) {
            codeElement.textContent += codeSnippet.charAt(i);
            i++;
            setTimeout(typeCode, 35);
        }
    }

    typeCode();
});

// Custom Inline Form Validation & Submission
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    // Attach live input error clearing
    const fields = contactForm.querySelectorAll('input, textarea');
    fields.forEach(field => {
        ['input', 'blur'].forEach(evt => {
            field.addEventListener(evt, () => {
                if (field.value.trim() !== '') {
                    field.classList.remove('is-invalid');
                    const err = field.closest('.form-group')?.querySelector('.invalid-feedback-custom');
                    if (err) err.remove();
                }
            });
        });
    });

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        clearErrors(contactForm);

        let isValid = true;
        const name = contactForm.querySelector('[name="name"]');
        const email = contactForm.querySelector('[name="email"]');
        const subject = contactForm.querySelector('[name="subject"]');
        const message = contactForm.querySelector('[name="message"]');

        if (name && name.value.trim() === '') {
            showFieldError(name, 'Please enter your name.');
            isValid = false;
        }

        if (email) {
            const emailVal = email.value.trim();
            if (emailVal === '') {
                showFieldError(email, 'Please enter your email address.');
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
                showFieldError(email, 'Please enter a valid email address.');
                isValid = false;
            }
        }

        if (subject && subject.value.trim() === '') {
            showFieldError(subject, 'Please enter a subject.');
            isValid = false;
        }

        if (message && message.value.trim() === '') {
            showFieldError(message, 'Please enter your message.');
            isValid = false;
        }

        if (!isValid) {
            const firstInvalid = contactForm.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();
            return;
        }

        const formData = new FormData(contactForm);
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton ? submitButton.textContent : 'Send Message';

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'Sending...';
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        fetch(contactForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showFlash(data.success || 'Thank you! Your message has been sent successfully.', 'success');
                contactForm.reset();
                contactForm.querySelectorAll('.is-valid, .is-invalid').forEach(el => el.classList.remove('is-valid', 'is-invalid'));
            } else if (data.errors) {
                let allErrors = [];
                for (const f in data.errors) {
                    allErrors.push(...data.errors[f]);
                }
                showFlash(allErrors.join('<br>') || 'Validation failed. Please check your inputs.', 'error');
            } else if (data.error) {
                showFlash(data.error, 'error');
            } else {
                showFlash('Message sent successfully!', 'success');
                contactForm.reset();
            }
        })
        .catch(error => {
            console.error('Submission Error:', error);
            showFlash('An unexpected error occurred. Please try again.', 'error');
        })
        .finally(() => {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    });
});

function showFieldError(input, message) {
    input.classList.add('is-invalid');
    const group = input.closest('.form-group');
    if (!group) return;

    let existing = group.querySelector('.invalid-feedback-custom');
    if (!existing) {
        existing = document.createElement('div');
        existing.className = 'invalid-feedback-custom';
        group.appendChild(existing);
    }
    existing.innerText = message;
}

function clearErrors(form) {
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.invalid-feedback-custom').forEach(el => el.remove());
}

function showFlash(message, type) {
    const existing = document.querySelector('.flash-alert');
    if (existing) existing.remove();

    const icon = type === 'success'
        ? '<i class="fas fa-check-circle" aria-hidden="true"></i>'
        : '<i class="fas fa-exclamation-circle" aria-hidden="true"></i>';

    const alert = document.createElement('div');
    alert.className = `flash-alert ${type}`;
    alert.innerHTML = `${icon} <span>${message}</span>`;

    document.body.appendChild(alert);

    setTimeout(() => {
        alert.style.transition = "opacity 0.4s ease, transform 0.4s ease";
        alert.style.opacity = "0";
        alert.style.transform = "translateY(20px)";
        setTimeout(() => alert.remove(), 400);
    }, 4000);
}

// SaaS screenshot lightbox
document.addEventListener('DOMContentLoaded', () => {
    const lightbox = document.getElementById('saasLightbox');
    if (!lightbox) return;

    const image = lightbox.querySelector('img');
    const closeButton = lightbox.querySelector('button');

    document.querySelectorAll('[data-lightbox-src]').forEach(button => {
        button.addEventListener('click', () => {
            image.src = button.dataset.lightboxSrc;
            lightbox.classList.add('active');
            lightbox.setAttribute('aria-hidden', 'false');
        });
    });

    const close = () => {
        lightbox.classList.remove('active');
        lightbox.setAttribute('aria-hidden', 'true');
        image.src = '';
    };

    closeButton?.addEventListener('click', close);
    lightbox.addEventListener('click', event => {
        if (event.target === lightbox) close();
    });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') close();
    });
});
