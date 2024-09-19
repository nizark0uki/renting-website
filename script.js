document.addEventListener("DOMContentLoaded", function() {

    // hamburger menu
    const hamburger = document.querySelector('.hamburger');
    const menu = document.querySelector('header ul');

    hamburger.addEventListener('click', function () {
        menu.classList.toggle('show');
        hamburger.classList.toggle('show');
    });

    document.getElementById('explore').addEventListener('click', function() {
        window.location.href = './annonces/annonces.html';
    });

    document.getElementById('add').addEventListener('click', function() {
        window.location.href = './add listing form/add.html';
    });
});
