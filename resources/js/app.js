import "./bootstrap";

import { initSidebar } from "./layouts/sidebar";
import { initAlert } from "./components/alert";
import { initModal } from "./pemilik/modal";
import { initPos } from "./kasir/pos";
import { initLaporan } from "./pemilik/laporan";

document.addEventListener("DOMContentLoaded", () => {
    initSidebar();
    initAlert();
    initModal();
    initPos();
    initLaporan();
});
