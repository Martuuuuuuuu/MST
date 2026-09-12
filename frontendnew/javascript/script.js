//carrito de reserva










// MENU  DE HAMBURGUESA
document.addEventListener("DOMContentLoaded", () => {
	const header = document.querySelector(".site-header");
	const menuToggle = document.querySelector(".menu-toggle");
	const navigationLinks = document.querySelectorAll(".main-nav a");

	if (!header || !menuToggle) {
		return;
	}

	const closeMenu = () => {
		header.classList.remove("menu-open");
		menuToggle.setAttribute("aria-expanded", "false");
		menuToggle.setAttribute("aria-label", "Abrir menú");
	};

	menuToggle.addEventListener("click", () => {
		const isOpen = header.classList.toggle("menu-open");
		menuToggle.setAttribute("aria-expanded", String(isOpen));
		menuToggle.setAttribute("aria-label", isOpen ? "Cerrar menú" : "Abrir menú");
	});

	navigationLinks.forEach((link) => link.addEventListener("click", closeMenu));

	document.addEventListener("keydown", (event) => {
		if (event.key === "Escape") {
			closeMenu();
		}
	});
});
