const accordions = document.querySelectorAll(".has-submenu");

Array.from(accordions).forEach(function(accordion) {
    if (accordion.classList.contains("has-background-primary")) {
        const submenu = accordion.nextElementSibling;
        submenu.style.maxHeight = `${submenu.scrollHeight}px`;
        submenu.style.marginTop = `0.75em`;
        submenu.style.marginBottom = `0.75em`;
    }
    accordion.addEventListener("click", function(e) {
        e.preventDefault();
        this.classList.toggle("has-background-primary");

        const submenu = this.nextElementSibling;

        if (submenu.style.maxHeight) {
            // menu is open, close it
            submenu.style.maxHeight = null;
            submenu.style.margin = null;
        } else {
            // menu is closed, open it
            submenu.style.maxHeight = `${submenu.scrollHeight}px`;
            submenu.style.marginTop = `0.75em`;
            submenu.style.marginBottom = `0.75em`;
        }
    });
});
