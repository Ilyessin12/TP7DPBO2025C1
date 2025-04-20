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
    
    // Clear search input when 'Clear' button is clicked
    const clearButtons = document.querySelectorAll('.btn-secondary[href*="?"]');
    clearButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const searchForm = this.closest('form');
            if (searchForm) {
                const inputFields = searchForm.querySelectorAll('input[type="text"], input[type="search"], select');
                inputFields.forEach(field => {
                    field.value = '';
                });
            }
        });
    });
});
