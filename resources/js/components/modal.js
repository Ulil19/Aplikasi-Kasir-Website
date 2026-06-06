export function initModal() {
    const modalTriggers = document.querySelectorAll("[data-modal-target]");
    const modalCloses = document.querySelectorAll(".modal-close");

    // Buka Modal
    modalTriggers.forEach((trigger) => {
        trigger.addEventListener("click", (e) => {
            e.preventDefault();
            const modalId = trigger.getAttribute("data-modal-target");
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove("hidden");
            }
        });
    });

    // Tutup Modal
    modalCloses.forEach((close) => {
        close.addEventListener("click", (e) => {
            e.preventDefault();
            // Mencari element modal terdekat dengan class .modal
            const modal = close.closest(".modal");
            if (modal) {
                modal.classList.add("hidden");
            }
        });
    });
}
