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

hamburger.addEventListener('click', () => toggleMenu());

// Close menu on link click (mobile UX)
navLinks.forEach(link => link.addEventListener('click', () => toggleMenu(false)));

// Close menu on Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') toggleMenu(false);
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    const target = e.target;
    const clickedInsideMenu = navMenu.contains(target) || hamburger.contains(target);
    if (!clickedInsideMenu) toggleMenu(false);
});

// Theme Toggle with persistence
const applyTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    const icon = themeToggle?.querySelector('i');
    if (icon) {
        icon.classList.remove('fa-sun', 'fa-moon');
        icon.classList.add(theme === 'light' ? 'fa-sun' : 'fa-moon');
    }
};

const preferredTheme = localStorage.getItem('theme') || (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
applyTheme(preferredTheme);

themeToggle?.addEventListener('click', () => {
    const current = document.documentElement.getAttribute('data-theme') || 'dark';
    applyTheme(current === 'dark' ? 'light' : 'dark');
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

// Reset parallax on touch devices to avoid interference
window.addEventListener('touchstart', () => parallaxMove(0, 0), { passive: true });

// Header scroll effect
const header = document.getElementById('header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Section fade-in on scroll
const sections = document.querySelectorAll('section');
const showSection = () => {
    sections.forEach(section => {
        const rect = section.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            section.classList.add('visible');
        }
    });
};
window.addEventListener('scroll', showSection);
window.addEventListener('load', showSection);


document.addEventListener("DOMContentLoaded", () => {
    const codeElement = document.getElementById("typed-code");
    const codeSnippet = `
class Developer {
    constructor() {
        this.name = "Shaharyar";
        this.role = "Full-Stack";
    }

    buildProject(project) {
        return \` Building \${project}\`;
    }
}

const print = null;
const me = new Developer();
print = me.buildProject("Awesome Web App");
console.log(print);`;

    let i = 0;
    function typeCode() {
        if (i < codeSnippet.length) {
            codeElement.textContent += codeSnippet.charAt(i);
            i++;
            setTimeout(typeCode, 40); // typing speed (ms per char)
        }
    }

    typeCode();
});


// Hanlde ajax contact form submission
const contactForm = document.getElementById('contactForm');

document.addEventListener('DOMContentLoaded', () => {
    if (!contactForm) return;

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        clearErrors();

        // Validate form fields
        let isValid = true;
        const name = contactForm.querySelector('#name');
        const email = contactForm.querySelector('#email');
        const subject = contactForm.querySelector('#subject');
        const message = contactForm.querySelector('#message');

        if (name.value.trim() === '') {
            showFieldError(name, 'Please enter your name.');
            isValid = false;
        }

        if (email.value.trim() === '') {
            showFieldError(email, 'Please enter your email.');
            isValid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email.value.trim())) {
            showFieldError(email, 'Please enter a valid email address.');
            isValid = false;
        }

        if (subject.value.trim() === '') {
            showFieldError(subject, 'Please enter a subject.');
            isValid = false;
        }

        if (message.value.trim() === '') {
            showFieldError(message, 'Please enter your message.');
            isValid = false;
        }

        if (!isValid) return; // Stop if form has errors

        // Prepare form submission
        const formData = new FormData(contactForm);
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.textContent;

        submitButton.disabled = true;
        submitButton.textContent = 'Sending...';

        fetch(contactForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showFlash(data.success || 'Message sent successfully!', 'success');
                    contactForm.reset();
                } else {
                    showFlash(data.error || 'There was an error sending your message.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showFlash('There was an error sending your message.', 'error');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            });
    });
});

// Show error under field
function showFieldError(input, message) {
    input.classList.add('is-invalid');

    const error = document.createElement('small');
    error.className = 'error-message';
    error.innerText = message;

    input.closest('.form-group').appendChild(error);
}

// Clear all previous errors
function clearErrors() {
    contactForm.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    contactForm.querySelectorAll('.error-message').forEach(el => el.remove());
}

// Flash message (your existing function)
function showFlash(message, type) {
    const icon = type === 'success'
        ? '<i class="fas fa-check-circle"></i>'
        : '<i class="fas fa-times-circle"></i>';

    const alert = document.createElement('div');
    alert.className = `flash-alert ${type}`;
    alert.innerHTML = `${icon} ${message}`;

    document.body.appendChild(alert);

    setTimeout(() => {
        alert.style.transition = "opacity 0.4s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 400);
    }, 3000);
}

