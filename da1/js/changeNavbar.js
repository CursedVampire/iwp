window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    const y = navbar.getBoundingClientRect().y;
    if (y === 0) {
        navbar.classList.add('at-the-top');
        navbar.classList.remove('near-the-top');
    } else if (y < 50) {
        navbar.classList.add('near-the-top');
        navbar.classList.remove('at-the-top');
    } else {
        navbar.classList.remove('at-the-top');
        navbar.classList.remove('near-the-top');
    }
});
