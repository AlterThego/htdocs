const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");
const navLinks = document.querySelectorAll(".sidebar a");

function closeSideMenu() {
    sideMenu.style.display = 'none';
}

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', closeSideMenu);

themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('span').classList.toggle('active');
});

navLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();

        // Close the side menu after a link is clicked
        closeSideMenu();

        // Log the destination page (you may want to use proper navigation methods here)
        const nextPage = link.getAttribute('href');
        console.log(`Navigating to ${nextPage}`);
        // Uncomment the following line to enable actual navigation
         window.location.href = nextPage;
    });
});
