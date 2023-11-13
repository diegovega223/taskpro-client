document.addEventListener('DOMContentLoaded', () => {
    const logo = document.getElementById('logo');

    logo.addEventListener('click', () => {
        logo.style.opacity = 0;
    });

    setTimeout(() => {
        logo.style.opacity = 0;
        
        setTimeout(() => {
            window.location.href = '/login';
        }, 2000);
    }, 1000);
});
