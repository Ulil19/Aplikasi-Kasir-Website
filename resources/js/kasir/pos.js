let keranjang = JSON.parse(localStorage.getItem("keranjang")) || [];
// Fungsi untuk menghitung kembalian secara otomatis saat kasir mengetik jumlah uang yang dibayarkan
document
    .getElementById("amount-paid")
    .addEventListener("input", hitungKembalian);

export function initPos() {
    // Fungsi untuk menambahkan produk ke keranjang
    const tambahKeKeranjang = document.querySelectorAll('[id^="add-to-cart-"]');

    updateKeranjang();

    tambahKeKeranjang.forEach((button) => {
        button.addEventListener("click", () => {
            const produk = {
                id: button.getAttribute("data-id"),
                nama: button.getAttribute("data-nama"),
                harga: parseInt(button.getAttribute("data-harga")),
                kategori: button.getAttribute("data-kategori"),
                gambar: button.getAttribute("data-gambar"),
                qty: 1,
            };
            const index = keranjang.findIndex((item) => item.id === produk.id);
            if (index !== -1) {
                keranjang[index].qty += 1;
            } else {
                keranjang.push(produk);
            }
            // console.log(keranjang);
            localStorage.setItem("keranjang", JSON.stringify(keranjang));
            updateKeranjang();
        });
    });
    filterProduk();

    // Tombol Proses Pembayaran
    const checkoutBtn = document.getElementById("checkout-btn");
    if (checkoutBtn) {
        checkoutBtn.addEventListener("click", prosesPembayaran);
    } else {
        console.warn(
            "Tombol checkout tidak ditemukan. Pastikan elemen dengan id 'checkout-btn' ada di halaman."
        );
    }
}

function filterProduk() {
    const searchInput = document.getElementById("search-input");
    const kategoriPills = document.querySelectorAll(".category-pill");
    const produkCards = document.querySelectorAll(".produk-card");

    if (!searchInput || kategoriPills.length === 0) return;

    let kategoriAktif = "all";
    let kataKunciPencarian = "";

    function cariProduk(card) {
        const namaProduk = card.getAttribute("data-nama");
        const kategoriProduk = card.getAttribute("data-kategori");

        const cocokKategori =
            kategoriAktif === "all" || kategoriProduk === kategoriAktif;
        const cocokPencarian = namaProduk
            .toLowerCase()
            .includes(kataKunciPencarian.toLowerCase());

        if (cocokKategori && cocokPencarian) {
            card.classList.remove("hidden");
        } else {
            card.classList.add("hidden");
        }
    }

    if (searchInput) {
        searchInput.addEventListener("input", (e) => {
            kataKunciPencarian = e.target.value.toLowerCase().trim();
            produkCards.forEach(cariProduk);
        });
    }

    kategoriPills.forEach((pill) => {
        pill.addEventListener("click", () => {
            kategoriAktif = pill.getAttribute("data-kategori");
            kategoriPills.forEach((p) =>
                p.classList.toggle("bg-pos-primary", p === pill)
            );
            kategoriPills.forEach((p) =>
                p.classList.toggle("text-white", p === pill)
            );
            kategoriPills.forEach((p) =>
                p.classList.toggle("text-pos-dark", p !== pill)
            );
            produkCards.forEach(cariProduk);
        });
    });
}

function updateKeranjang() {
    localStorage.setItem("keranjang", JSON.stringify(keranjang));

    const cartItemsContainer = document.getElementById("cart-items");
    const cartEmptyState = document.getElementById("cart-empty");
    const cartCount = document.getElementById("cart-count");
    const cartCountBottom = document.getElementById("cart-count-bottom");
    const cartTotal = document.getElementById("cart-total");

    if (keranjang.length === 0) {
        if (cartEmptyState) cartEmptyState.classList.remove("hidden");
        if (cartItemsContainer) {
            const items = cartItemsContainer.querySelectorAll(
                ".flex.items-center.gap-3"
            );
            items.forEach((el) => el.remove());
        }
        if (cartCount) cartCount.textContent = "0 Item";
        if (cartCountBottom) cartCountBottom.textContent = "0";
        if (cartTotal) cartTotal.textContent = "Rp 0";
        return;
    }

    if (cartEmptyState) cartEmptyState.classList.add("hidden");

    const oldItems = cartItemsContainer.querySelectorAll(
        ".flex.items-center.gap-3"
    );
    oldItems.forEach((el) => el.remove());

    let totalHargaAll = 0;
    let totalQtyAll = 0;

    // Lakukan perulangan untuk menyusun elemen HTML item belanja baru
    keranjang.forEach((item) => {
        const subtotal = item.harga * item.qty;
        totalHargaAll += subtotal;
        totalQtyAll += item.qty;

        const itemHtml = `
            <div class="flex items-center gap-3 border-b border-gray-50 pb-2">
                <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center shrink-0">
                    <img src="${item.gambar}" alt="${
            item.nama
        }" class="object-cover w-full h-full" />
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium text-pos-dark truncate">${
                        item.nama
                    }</h3>
                    <p class="text-xs text-gray-500">Rp ${item.harga.toLocaleString(
                        "id-ID"
                    )}</p>
                </div>
                <p class="text-[11px] text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded">${
                    item.kategori
                }</p>
                <div class="flex items-center gap-1.5 shrink-0">
                    <button data-id="${
                        item.id
                    }" class="btn-qty-minus w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-sm text-gray-600 hover:bg-gray-200 transition-colors">-</button>
                    <span class="text-sm font-semibold w-4 text-center">${
                        item.qty
                    }</span>
                    <button data-id="${
                        item.id
                    }" class="btn-qty-plus w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-sm text-gray-600 hover:bg-gray-200 transition-colors">+</button>
                </div>
            </div>
        `;
        cartItemsContainer.insertAdjacentHTML("beforeend", itemHtml);
    });

    if (cartCount) cartCount.textContent = `${totalQtyAll} Item`;
    if (cartCountBottom) cartCountBottom.textContent = totalQtyAll;
    if (cartTotal)
        cartTotal.textContent = `Rp ${totalHargaAll.toLocaleString("id-ID")}`;
    initTombolAksiKeranjang();
    hitungKembalian();
}

function initTombolAksiKeranjang() {
    // Tombol Tambah Qty
    document.querySelectorAll(".btn-qty-plus").forEach((button) => {
        button.addEventListener("click", () => {
            const id = button.getAttribute("data-id");
            const index = keranjang.findIndex((item) => item.id === id);
            if (index !== -1) {
                keranjang[index].qty += 1;
                updateKeranjang();
            }
        });
    });

    // Tombol Kurang Qty
    document.querySelectorAll(".btn-qty-minus").forEach((button) => {
        button.addEventListener("click", () => {
            const id = button.getAttribute("data-id");
            const index = keranjang.findIndex((item) => item.id === id);
            if (index !== -1) {
                keranjang[index].qty -= 1;
                // Jika qty menjadi 0, hapus item dari keranjang
                if (keranjang[index].qty <= 0) {
                    keranjang.splice(index, 1);
                }
                updateKeranjang();
            }
        });
    });
}

// itung kembalian otomatis
function hitungKembalian() {
    const totalTagihan = keranjang.reduce(
        (sum, item) => sum + item.harga * item.qty,
        0
    );

    // 2. Ambil nilai uang yang diketik kasir
    const uangBayarInput = document.getElementById("amount-paid");
    const uangBayar = parseInt(uangBayarInput.value) || 0;

    const kembalianText = document.getElementById("cart-change");

    // 3. Logika kalkulasi kembalian
    if (uangBayar >= totalTagihan && totalTagihan > 0) {
        const kembalian = uangBayar - totalTagihan;
        // Tampilkan kembalian dengan format mata uang Rupiah (contoh: Rp 15.000)
        kembalianText.innerText = `Rp ${kembalian.toLocaleString("id-ID")}`;
        kembalianText.classList.remove("text-red-500");
        kembalianText.classList.add("text-pos-success"); // warna hijau jika cukup/lebih
    } else if (uangBayar < totalTagihan && uangBayar > 0) {
        //  merah jika uang yang diketik masih kurang
        const kurangnya = totalTagihan - uangBayar;
        kembalianText.innerText = `- Rp ${kurangnya.toLocaleString(
            "id-ID"
        )} (Kurang)`;
        kembalianText.classList.remove("text-pos-success");
        kembalianText.classList.add("text-red-500");
    } else {
        // Jika belum ada uang yang dimasukkan atau keranjang kosong
        kembalianText.innerText = "Rp 0";
        kembalianText.classList.remove("text-red-500");
        kembalianText.classList.add("text-pos-success");
    }
}

function clearKeranjang() {
    keranjang = [];
    localStorage.removeItem("keranjang");
    updateKeranjang();
}

function prosesPembayaran() {
    // console.log(keranjang);
    if (keranjang.length === 0) {
        Swal.fire({
            icon: "info",
            title: "Keranjang kosong",
            text: "Silakan tambahkan produk ke keranjang sebelum melakukan pembayaran.",
        });
        return;
    }

    const namaKustomer =
        document.getElementById("customer-name").value.trim() || "Umum";
    const uangBayar =
        parseInt(document.getElementById("amount-paid").value) || 0;
    const totalTagihan = keranjang.reduce(
        (sum, item) => sum + item.harga * item.qty,
        0
    );

    // Validasi final sebelum kirim ke Laravel
    if (uangBayar < totalTagihan) {
        Swal.fire({
            icon: "warning",
            title: "Uang Pembayaran Kurang",
            text: "Mohon periksa kembali nominal uang yang dibayarkan konsumen.",
        });
        return;
    }

    const tokenInput = document.querySelector(
        '#pembayaran-form input[name="_token"]'
    );
    const csrfToken = tokenInput ? tokenInput.value : null;

    fetch("/kasir/proses-pembayaran", {
        method: "POST",
        headers: {
            "content-type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            keranjang,
            kustomer: namaKustomer,
            bayar: uangBayar,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Pembayaran Berhasil",
                    text: "Transaksi berhasil diproses.",
                    showCancelButton: true,
                    confirmButtonText: "Cetak Struk",
                    cancelButtonText: "Tutup",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(
                            `/kasir/cetak-struk/${data.transaksi_id}`,
                            "_blank"
                        );
                    }
                });
                clearKeranjang();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Pembayaran Gagal",
                    text: data.message,
                });
            }
        });
}
