document.addEventListener("DOMContentLoaded", function() {
    displayCurrentDate() ,displayCurrentDates();
});

function displayCurrentDate() {
    const dateElement = document.getElementById("Month");
    const today = new Date();
    const options = { month: 'long' };
    dateElement.textContent = today.toLocaleDateString(undefined, options);
}
function displayCurrentDates() {
    const dateElement = document.getElementById("Year");
    const today = new Date();
    const options = { year: 'numeric' };
    dateElement.textContent = today.toLocaleDateString(undefined, options);
}