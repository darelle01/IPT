let staff = document.getElementById("staff");
function openStaffPopup() {
    closeAdminPopup();
    staff.classList.add("StaffOpen-popup");
}

function closeStaffPopup() {
    staff.classList.remove("StaffOpen-popup");
}