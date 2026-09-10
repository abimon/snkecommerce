const revealTargets = '.hero-copy, .hero-art, .product-card, .feature-band, .page-hero, .checkout-card, .summary-card';

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('js-ready');

    const nav = document.querySelector('.site-nav');
    const updateNavState = () => nav?.classList.toggle('is-scrolled', window.scrollY > 12);
    updateNavState();
    window.addEventListener('scroll', updateNavState, { passive: true });

    const revealItems = document.querySelectorAll(revealTargets);
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, currentObserver) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    currentObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealItems.forEach((item, index) => {
            item.classList.add('reveal-on-scroll');
            item.style.setProperty('--reveal-delay', `${Math.min(index * 45, 240)}ms`);
            observer.observe(item);
        });
    }

    document.querySelectorAll('.site-nav .nav-link').forEach((link) => {
        if (link.href === window.location.href) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
        }
    });

    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', () => {
            const submitButton = form.querySelector('button[type="submit"]');
            if (!submitButton) return;

            submitButton.disabled = true;
            submitButton.classList.add('is-loading');
            submitButton.textContent = form.action.includes('/cart/') ? 'Adding...' : 'Working...';
        });
    });

    document.querySelectorAll('input[name="quantity"]').forEach((input) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'quantity-control';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        ['-', '+'].forEach((label, index) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'quantity-button';
            button.setAttribute('aria-label', `${index === 0 ? 'Decrease' : 'Increase'} quantity`);
            button.textContent = label;
            button.addEventListener('click', () => {
                const nextValue = Number(input.value || 0) + (index === 0 ? -1 : 1);
                input.value = Math.max(Number(input.min || 0), Math.min(Number(input.max || Infinity), nextValue));
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
            index === 0 ? wrapper.prepend(button) : wrapper.append(button);
        });
    });
});
