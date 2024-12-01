document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            const email = document.querySelector('input[type="email"]');
            const linkedin = document.querySelector('input[name="linkedin_profile"]');

            if (email && !validateEmail(email.value)) {
                e.preventDefault();
                alert('Please enter a valid email address');
            }

            if (linkedin && !validateLinkedIn(linkedin.value)) {
                e.preventDefault();
                alert('Please enter a valid LinkedIn URL');
            }
        });
    }
});

function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validateLinkedIn(url) {
    return url.includes('linkedin.com/');
}




function filterByProfession() {
    const profession = document.getElementById('profession').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('profession', profession);
    window.location.search = urlParams.toString();
}

function showFileName(type) {
    let fileInput, fileNameElement;

    if (type === 'photo') {
        fileInput = document.getElementById('file-photo-input');
        fileNameElement = document.getElementById('file-photo-name');
    } else if (type === 'video') {
        fileInput = document.getElementById('file-video-input');
        fileNameElement = document.getElementById('file-video-name');
    }

    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        console.log('Selected file:', fileName);
        fileNameElement.textContent = 'Selected file: ' + fileName;
    } else {
        fileNameElement.textContent = 'No file selected';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const upcomingTab = document.getElementById("upcoming-events");
    const yourTab = document.getElementById("your-events");
    const upcomingContainer = document.getElementById("upcoming-container");
    const yourContainer = document.getElementById("your-container");

    upcomingTab.addEventListener("click", function () {
        upcomingTab.classList.add("active-tab");
        yourTab.classList.remove("active-tab");
        upcomingContainer.style.display = "block";
        yourContainer.style.display = "none";
    });

    yourTab.addEventListener("click", function () {
        yourTab.classList.add("active-tab");
        upcomingTab.classList.remove("active-tab");
        yourContainer.style.display = "block";
        upcomingContainer.style.display = "none";
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const toggleLink = document.getElementById("toggle-mentorship");
    const mentorshipForm = document.getElementById("mentorship-form");
    const mentorshipContainer = document.getElementById("mentorship-container");

    toggleLink.addEventListener("click", function (event) {
        event.preventDefault(); // Previne navigarea
        mentorshipForm.style.display = mentorshipForm.style.display === "none" ? "block" : "none";
        mentorshipContainer.classList.toggle("expanded");
    });
});







