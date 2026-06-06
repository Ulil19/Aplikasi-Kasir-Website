import "./bootstrap";

import { initSidebar } from "./layouts/sidebar";
import { initModal } from "./components/modal";
import { initAlert } from "./components/alert";

document.addEventListener("DOMContentLoaded", () => {
    initSidebar();
    initModal();
    initAlert();
});
