document.addEventListener('DOMContentLoaded', function() {
    // hamburger menu
    const hamburger = document.querySelector('.hamburger');
    const menu = document.querySelector('header ul');
    
    hamburger.addEventListener('click', function () {
        menu.classList.toggle('show');
        hamburger.classList.toggle('show');
    });
    
    
    
    

    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const subject = document.getElementById('subject').value;
        const governorate = document.getElementById('options').value;

        if (name.trim() === '') {
            alert('Veuillez entrer votre nom et prénom.');
            isValid = false;
        } else if (!isAlpha(name)) {
            alert('Veuillez entrer un nom valide contenant uniquement des lettres et des espaces.');
            isValid = false;
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            alert('Adresse email invalide.');
            isValid = false;
        }

        const phonePattern = /^[0-9]+$/;
        if (phone.trim() === '') {
            alert('Le numéro de téléphone ne peut pas être vide.');
            isValid = false;
        } else if (!phonePattern.test(phone)) {
            alert('Le numéro de téléphone ne peut contenir que des chiffres.');
            isValid = false;
        } else if (phone.length != 8 ) {
            alert('Le numéro de téléphone doit contenir entre 8 et 15 chiffres.');
            isValid = false;
        }

        if (subject.trim() === '') {
            alert('Veuillez entrer un objet.');
            isValid = false;
        }

        if (governorate === '') {
            alert('Veuillez sélectionner un gouvernorat.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function isAlpha(str) {
        const alphaPattern = /^[a-zA-Z\s]+$/;
        return alphaPattern.test(str);
    }
});