import "./bootstrap";

import { initSidebar } from "./layouts/sidebar";
import { initModal } from "./pemilik/modal";
import { initAlert } from "./components/alert";
import { initPos } from "./kasir/pos";

document.addEventListener("DOMContentLoaded", () => {
    initSidebar();
    initModal();
    initAlert();
    initPos();
});
