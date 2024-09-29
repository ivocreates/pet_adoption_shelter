// script.js

document.addEventListener('DOMContentLoaded', function () {
    // Example: Alert message on form submission
    const adoptForm = document.getElementById('adoptForm');
    if (adoptForm) {
        adoptForm.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Your adoption application has been submitted!');
            // Additional logic for form submission can be added here
        });
    }
});
function goBack() {
    window.history.back();
}