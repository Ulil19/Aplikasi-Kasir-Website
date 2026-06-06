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
                // kategori: create, edit, delete
                const mode = trigger.getAttribute("data-mode");
                const form = document.getElementById("kategoriForm");
                const title = document.getElementById("modalTitle");
                const methodInput = document.getElementById("formMethod");

                const namaInput = document.getElementById("nama");
                const deskripsiInput = document.getElementById("deskripsi");
                const idInput = document.getElementById("kategoriId");
                if (mode === "edit") {
                    title.textContent = "Edit Kategori";
                    methodInput.value = "POST";

                    const id = trigger.getAttribute("data-id");
                    form.action = `/pemilik/kategori/update/${id}`;

                    idInput.value = id;
                    namaInput.value = trigger.getAttribute("data-nama");
                    deskripsiInput.value =
                        trigger.getAttribute("data-deskripsi");
                } else {
                    title.textContent = "Tambah Kategori";
                    methodInput.value = "POST";
                    form.action = `/pemilik/kategori/simpan`;

                    form.reset();
                    idInput.value = "";
                }

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
