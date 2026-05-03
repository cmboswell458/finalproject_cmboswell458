document.addEventListener("DOMContentLoaded", function () {

    // ===== HOME BUTTON (NO DELAY FIX) =====
    const homeBtn = document.getElementById("homeBtn");

    if (homeBtn) {
        homeBtn.addEventListener("click", function (e) {
            e.preventDefault();

            // instant navigation (no lag)
            window.location.href = "index.php";
        });
    }

    // ===== NO RESULTS POPUP =====
    const popup = document.getElementById("noResultsPopup");

    if (popup) {
        // auto show popup if it exists on page
        popup.classList.add("active");

        // auto hide after 3 seconds
        setTimeout(() => {
            popup.classList.remove("active");
        }, 3000);
    }

});