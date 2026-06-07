export function initModal() {
    const modalTriggers = document.querySelectorAll("[data-modal-target]");
    const modalCloses = document.querySelectorAll(".modal-close");

    // handle gambar preview
    const gambarInput = document.getElementById("image-upload");
    const namaGambar = document.getElementById("file-name");

    if (gambarInput && namaGambar) {
        gambarInput.addEventListener("change", function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    alert("Ukuran file terlalu besar. Maksimal 2MB.");
                    this.value = "";
                    namaGambar.textContent = "";
                    return;
                }
                const validTypes = ["image/jpeg", "image/png", "image/gif"];
                if (!validTypes.includes(file.type)) {
                    alert(
                        "Format file tidak valid. Harap pilih gambar (jpg, png, gif)."
                    );
                    this.value = "";
                    namaGambar.textContent = "";
                    return;
                }

                namaGambar.textContent = `File terpilih: ${this.files[0].name}`;
                namaGambar.classList.add("text-blue-600", "font-medium");
            } else {
                namaGambar.textContent = "";
            }
        });
    }

    // Buka Modal
    modalTriggers.forEach((trigger) => {
        trigger.addEventListener("click", (e) => {
            e.preventDefault();
            const modalId = trigger.getAttribute("data-modal-target");
            const modal = document.getElementById(modalId);
            if (modal) {
                // Modal Kategori
                if (modalId === "kategoriModal") {
                    const mode = trigger.getAttribute("data-mode");
                    const form = document.getElementById("kategoriForm");
                    const title = document.getElementById("modalTitle");
                    const methodInput = document.getElementById("formMethod");

                    const namaInput = document.getElementById("nama");
                    const deskripsiInput = document.getElementById("deskripsi");
                    const idInput = document.getElementById("kategoriId");

                    if (form && title && methodInput) {
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
                    }
                }
                // Modal Produk
                else if (modalId === "produkModal") {
                    const mode = trigger.getAttribute("data-mode");
                    const form = document.getElementById("produkForm");
                    const title = document.getElementById("modalTitleProduk");
                    const methodInput =
                        document.getElementById("formMethodProduk");

                    const namaInput = document.getElementById("namaProduk");
                    const kategoriInput =
                        document.getElementById("kategori_id");
                    const deskripsiInput =
                        document.getElementById("deskripsiProduk");
                    const hargaInput = document.getElementById("harga");
                    const idInput = document.getElementById("produkId");
                    const namaGambar = document.getElementById("file-name");

                    if (form && title && methodInput) {
                        if (mode === "edit") {
                            title.textContent = "Edit Produk";
                            methodInput.value = "POST";
                            const id = trigger.getAttribute("data-id");
                            form.action = `/pemilik/produk/update/${id}`;
                            idInput.value = id;
                            namaInput.value = trigger.getAttribute("data-nama");
                            kategoriInput.value =
                                trigger.getAttribute("data-kategori_id");
                            deskripsiInput.value =
                                trigger.getAttribute("data-deskripsi");
                            hargaInput.value =
                                trigger.getAttribute("data-harga");

                            const gambarLama =
                                trigger.getAttribute("data-gambar");
                            if (gambarLama && namaGambar) {
                                namaGambar.textContent = `Gambar saat ini: ${gambarLama
                                    .split("/")
                                    .pop()}`;
                            }
                        } else {
                            title.textContent = "Tambah Produk";
                            methodInput.value = "POST";
                            form.action = `/pemilik/produk/simpan`;
                            form.reset();
                            idInput.value = "";

                            if (namaGambar) {
                                namaGambar.textContent = "";
                            }
                        }
                    }
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
                if (modal.id === "produkModal" && namaGambar) {
                    namaGambar.textContent = "";
                }
            }
        });
    });
}
