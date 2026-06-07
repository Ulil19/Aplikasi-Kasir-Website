export function initSidebar() {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const overlay = document.getElementById("sidebar-overlay");
    const userRole = sidebar.getAttribute("data-role");

    if (!sidebar || !sidebarToggle) return;

    function checkScreenSize() {
        if (window.innerWidth < 1024) {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");

            mainContent.classList.remove("lg:ml-64", "ml-64");
            mainContent.classList.add("ml-0");
            overlay?.classList.add("hidden");
        } else {
            // Tampilan Desktop
            if (userRole === "pemilik") {
                // Pemilik: Default TERBUKA
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.add("translate-x-0");
                mainContent.classList.remove("ml-0");
                mainContent.classList.add("ml-64");
            } else {
                // Kasir/Role lain: Default TERTUTUP
                sidebar.classList.add("-translate-x-full");
                sidebar.classList.remove("translate-x-0");
                mainContent.classList.remove("ml-64", "lg:ml-64");
                mainContent.classList.add("ml-0");
            }
            overlay?.classList.add("hidden");
        }
    }

    // Eksekusi fungsi saat pertama load dan saat resize
    checkScreenSize();
    window.addEventListener("resize", checkScreenSize);

    sidebarToggle.addEventListener("click", function () {
        const isClosed = sidebar.classList.contains("-translate-x-full");

        if (isClosed) {
            // BUKA SIDEBAR
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");

            if (window.innerWidth >= 1024) {
                mainContent.classList.remove("ml-0");
                mainContent.classList.add("ml-64");
            } else {
                overlay?.classList.remove("hidden");
            }
        } else {
            // TUTUP SIDEBAR
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");

            if (window.innerWidth >= 1024) {
                // Hapus lg:ml-64 agar main-content bisa memenuhi layar (ml-0)
                mainContent.classList.remove("ml-64", "lg:ml-64");
                mainContent.classList.add("ml-0");
            } else {
                overlay?.classList.add("hidden");
            }
        }
    });

    // Tutup saat klik overlay hitam di mobile
    overlay?.addEventListener("click", function () {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");
        overlay.classList.add("hidden");
    });
}
