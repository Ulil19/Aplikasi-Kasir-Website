import "./bootstrap";

import { initSidebar } from "./layouts/sidebar";
import { initModal } from "./components/modal";

document.addEventListener("DOMContentLoaded", () => {
    initSidebar();
    initModal();
});
