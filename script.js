document.addEventListener("DOMContentLoaded", function() {
    //Toastify
    const showToast = (message, backgroundColor) => {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "top", 
            position: "right", 
            backgroundColor: backgroundColor,
            stopOnFocus: true, 
            onClick: function(){} 
        }).showToast();
    }

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
    

    fetchListings();

    function fetchListings() {
        fetch('fetch_listings.php')
            .then(response => response.text())
            .then(data => {
                const lastListingDiv = document.getElementById('lastListing');
                lastListingDiv.innerHTML = data; // Insert the fetched listings
            })
            .catch(error => {
                console.error('Error fetching listings:', error);
            });
    }
    
    // delete buttons
    let selectedListingId = null;
    const modal = document.getElementById("emailModal");
    const closeModal = document.querySelector(".close");
    const confirmDeleteBtn = document.getElementById("confirmDelete");

    // Open modal and set listingId
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            selectedListingId = e.target.getAttribute('data-id');
            modal.style.display = "block";
        }
    });

    // Close modal
    closeModal.addEventListener('click', function() {
        modal.style.display = "none";
        document.getElementById("emailInput").value = '';
    });

    // Close the modal if user clicks outside
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            document.getElementById("emailInput").value = '';
        }
    };

    // Confirm deletion with email
    confirmDeleteBtn.addEventListener('click', function() {
        const email = document.getElementById("emailInput").value;
        if (!isValidEmail(email)) {
            showToast("Veuillez entrer une adresse email valide.", "red");
            return;  
        }
        // Send delete request if the email is valid
        deleteListing(selectedListingId, email);
        
    
    });

    function deleteListing(listingId, email) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_listing.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const response = xhr.responseText;
                if (response === "Listing deleted successfully") {
                    showToast("Annonce supprimée avec succès.", "green");
                    document.getElementById("emailInput").value = '';
                    modal.style.display = "none";
                    fetchListings();
                } else {
                    showToast("Adresse email incorrecte.", "red");
                }
            }
        };
        xhr.send('id=' + listingId + '&email=' + encodeURIComponent(email));
    }

    function isValidEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }
});
