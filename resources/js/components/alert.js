import Swal from "sweetalert2";

export function initAlert() {
    window.Swal = Swal;

    const flashElement = document.getElementById("flash-data");

    if (flashElement) {
        const status = flashElement.dataset.status;
        const message = flashElement.dataset.message;

        Swal.fire({
            icon: status,
            title: status === "success" ? "Berhasil!" : "Gagal!",
            text: message,
            showConfirmButton: status === "error", 
            timer: status === "success" ? 1500 : undefined,
            confirmButtonColor: "#EF4444",
            customClass: {
                popup: "rounded-xl",
            },
        });
    }

    setupDeleteConfirmation();
}

function setupDeleteConfirmation() {
    document.querySelectorAll(".form-delete").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF4444",
                cancelButtonColor: "#6B7280",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                customClass: { popup: "rounded-xl" },
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
}
