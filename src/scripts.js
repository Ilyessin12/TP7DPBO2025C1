function confirmDelete() {
    return confirm('Are you sure you want to delete this item? This action cannot be undone.');
}

// Add active class to current nav link based on URL
document.addEventListener("DOMContentLoaded", function() {
    const currentPath = window.location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page'); // for accessibility
        } else {
            link.classList.remove('active');
            link.removeAttribute('aria-current');
        }
    });
});
