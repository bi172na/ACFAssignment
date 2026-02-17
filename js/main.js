document.addEventListener("DOMContentLoaded", function () {

    const tabs = document.querySelectorAll(".tab-btn");
    const panel = document.getElementById("property-panel");
    const loadMoreBtn = document.getElementById("load-more");

    let currentPage = 1;
    let currentTerm = document.querySelector(".tab-btn.active")?.dataset.term;

    // ===== FUNCTION TO LOAD PROPERTIES =====
    function loadProperties(term, page = 1, append = false) {

        fetch(ajax_object.ajax_url, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                action: "load_properties",
                term: term,
                page: page
            })
        })
        .then(response => response.text())
        .then(data => {

            if (!append) {
                panel.innerHTML = data;
            } else {
                panel.innerHTML += data;
            }

            // Auto hide load more if no more posts returned
            if (data.trim() === "") {
                loadMoreBtn.style.display = "none";
            } else {
                loadMoreBtn.style.display = "inline-block";
            }

        });
    }

    // ===== INITIAL LOAD =====
    if (currentTerm) {
        loadProperties(currentTerm);
    }

    // ===== TAB CLICK =====
    tabs.forEach(tab => {

        tab.addEventListener("click", function () {

            tabs.forEach(t => {
                t.classList.remove("active");
                t.setAttribute("aria-selected", "false");
            });

            this.classList.add("active");
            this.setAttribute("aria-selected", "true");

            currentTerm = this.dataset.term;
            currentPage = 1;

            loadMoreBtn.dataset.page = 1;
            loadMoreBtn.style.display = "inline-block";

            loadProperties(currentTerm, 1, false);
        });

    });

    // ===== LOAD MORE CLICK =====
    loadMoreBtn.addEventListener("click", function () {

        currentPage++;
        loadProperties(currentTerm, currentPage, true);

    });

});
