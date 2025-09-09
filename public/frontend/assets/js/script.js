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


    // Hero code typing animation (C++/PHP snippet)
    window.addEventListener('DOMContentLoaded', () => {
        const codeEl = document.getElementById('codeTyping');
        const caretEl = document.getElementById('typingCaret');
        if (!codeEl || !caretEl) return;

        const snippets = [
            // C++: clean, professional STL usage that resonates with problem solving and backend work
            `#include <iostream>\n#include <vector>\n#include <numeric>\n#include <algorithm>\n\nstruct Task { int id; bool done; };\n\nint main(){\n  std::vector<Task> tasks = {{1,false},{2,true},{3,true},{4,false}};\n  auto completed = std::count_if(tasks.begin(), tasks.end(), [](const Task& t){ return t.done; });\n  auto progress = (completed * 100.0) / tasks.size();\n  std::cout << "Progress: " << progress << "%" << std::endl;\n  return 0;\n}`,
            // PHP: simple data shaping akin to API responses
            `<?php\n$projects = [\n  ['title' => 'E-Commerce', 'stack' => ['Laravel','Vue']],\n  ['title' => 'PM App', 'stack' => ['Laravel','Inertia']],\n];\necho json_encode($projects, JSON_PRETTY_PRINT);`
        ];

        let snippetIndex = 0;
        let charIndex = 0;
        let deleting = false;
        let pauseUntil = 0;

        const typeSpeed = () => 18 + Math.random() * 24; // smoother
        const deleteSpeed = () => 12 + Math.random() * 18;

        const tick = (time) => {
            if (time < pauseUntil) { requestAnimationFrame(tick); return; }
            const current = snippets[snippetIndex];
            if (!deleting) {
                charIndex = Math.min(charIndex + 1, current.length);
                codeEl.textContent = current.slice(0, charIndex);
                if (charIndex === current.length) {
                    deleting = true;
                    pauseUntil = time + 1200;
                }
                setTimeout(() => requestAnimationFrame(tick), typeSpeed());
            } else {
                charIndex = Math.max(charIndex - 3, 0);
                codeEl.textContent = current.slice(0, charIndex);
                if (charIndex === 0) {
                    deleting = false;
                    snippetIndex = (snippetIndex + 1) % snippets.length;
                    pauseUntil = time + 600;
                }
                setTimeout(() => requestAnimationFrame(tick), deleteSpeed());
            }
        };

        requestAnimationFrame(tick);
    });