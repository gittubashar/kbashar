const ready = (callback) => document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', callback)
    : callback();

ready(() => {
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    document.querySelectorAll('[data-mobile-toggle]').forEach((button) => {
        button.addEventListener('click', () => mobileMenu?.classList.toggle('hidden'));
    });

    const sidebar = document.querySelector('[data-admin-sidebar]');
    document.querySelectorAll('[data-sidebar-toggle]').forEach((button) => {
        button.addEventListener('click', () => sidebar?.classList.toggle('is-open'));
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => entry.isIntersecting && entry.target.classList.add('is-visible'));
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach((element) => observer.observe(element));

    const role = document.querySelector('[data-rotating-role]');
    if (role) {
        const roles = JSON.parse(role.dataset.roles || '[]');
        let index = 0;
        window.setInterval(() => {
            role.classList.add('opacity-0', 'translate-y-1');
            window.setTimeout(() => {
                index = (index + 1) % roles.length;
                role.textContent = roles[index];
                role.classList.remove('opacity-0', 'translate-y-1');
            }, 220);
        }, 2600);
    }

    document.querySelectorAll('[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm(form.dataset.confirm)) event.preventDefault();
        });
    });
});
