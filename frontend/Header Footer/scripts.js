// Smooth dropdown animation for the categories
document.querySelectorAll('.categories-menu ul li').forEach(item => {
    item.addEventListener('mouseover', () => {
        const submenu = item.querySelector('.submenu');
        if (submenu) {
            submenu.style.display = 'block';
            submenu.style.opacity = 0;
            submenu.style.transition = 'opacity 0.3s ease';
            setTimeout(() => submenu.style.opacity = 1, 100);
        }
    });
    item.addEventListener('mouseout', () => {
        const submenu = item.querySelector('.submenu');
        if (submenu) {
            submenu.style.opacity = 0;
            submenu.style.transition = 'opacity 0.3s ease';
            setTimeout(() => submenu.style.display = 'none', 300);
        }
    });
});

// Smooth scroll animation for footer links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
