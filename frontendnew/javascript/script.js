// MENU  DE HAMBURGUESA
document.addEventListener("DOMContentLoaded", () => {
	const header = document.querySelector(".site-header");
	const menuToggle = document.querySelector(".menu-toggle");
	const navigationLinks = document.querySelectorAll(".main-nav a");

	if (!header) {
		return;
	}

	const updateScrolledState = () => {
		header.classList.toggle("is-scrolled", window.scrollY > 16);
	};

	updateScrolledState();
	window.addEventListener("scroll", updateScrolledState, { passive: true });

	if (!menuToggle) {
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

// Seccion de opiniones
const opinionsStorageKey = "mst-opiniones";
const opinionsResetKey = "mst-opiniones-reset-v2";

const readOpinions = () => {
	try {
		const savedOpinions = JSON.parse(localStorage.getItem(opinionsStorageKey));
		return Array.isArray(savedOpinions) ? savedOpinions : [];
	} catch {
		return [];
	}
};

const saveOpinions = (opinions) => {
	try {
		localStorage.setItem(opinionsStorageKey, JSON.stringify(opinions));
		return true;
	} catch {
		return false;
	}
};

const getRegisteredName = () => {
	try {
		return localStorage.getItem("mst-usuario-nombre") || "Comunidad educativa";
	} catch {
		return "Comunidad educativa";
	}
};

const visibleOpinionsLimit = 6;

const renderOpinions = (opinions, opinionsList) => {
	opinionsList.replaceChildren();

	if (opinions.length === 0) {
		const emptyMessage = document.createElement("p");
		emptyMessage.className = "opinions-empty";
		emptyMessage.textContent = "Todavía no hay comentarios.";
		opinionsList.append(emptyMessage);
		return;
	}

	opinions.forEach((opinion, index) => {
		const card = document.createElement("article");
		card.className = "opinion-card";
		card.hidden = index >= visibleOpinionsLimit;

		const quote = document.createElement("p");
		quote.className = "opinion-message";
		quote.textContent = `“${opinion.message}”`;

		const author = document.createElement("p");
		author.className = "opinion-author";
		author.textContent = opinion.name;

		card.append(quote, author);
		opinionsList.append(card);
	});

	if (opinions.length > visibleOpinionsLimit) {
		const toggleButton = document.createElement("button");
		toggleButton.className = "opinions-toggle";
		toggleButton.type = "button";
		toggleButton.setAttribute("aria-expanded", "false");
		toggleButton.setAttribute("aria-label", "Mostrar más comentarios");
		toggleButton.textContent = "↓";

		toggleButton.addEventListener("click", () => {
			const isExpanded = toggleButton.getAttribute("aria-expanded") === "true";
			opinionsList.querySelectorAll(".opinion-card").forEach((card, index) => {
				if (index >= visibleOpinionsLimit) {
					card.hidden = isExpanded;
				}
			});
			toggleButton.setAttribute("aria-expanded", String(!isExpanded));
			toggleButton.setAttribute("aria-label", isExpanded ? "Mostrar más comentarios" : "Ocultar comentarios");
			toggleButton.textContent = isExpanded ? "↓" : "↑";
		});

		opinionsList.append(toggleButton);
	}
};

document.addEventListener("DOMContentLoaded", () => {
	const opinionForm = document.querySelector("#opinion-form");
	const opinionsList = document.querySelector("#opinions-list");
	const opinionStatus = document.querySelector("#opinion-status");
	const opinionMessage = document.querySelector("#opinion-message");

	if (!opinionForm || !opinionsList || !opinionStatus || !opinionMessage) {
		return;
	}

	const resizeOpinionMessage = () => {
		opinionMessage.style.height = "auto";
		opinionMessage.style.height = `${opinionMessage.scrollHeight}px`;
	};

	opinionMessage.addEventListener("input", resizeOpinionMessage);
	resizeOpinionMessage();

	if (!localStorage.getItem(opinionsResetKey)) {
		localStorage.removeItem(opinionsStorageKey);
		localStorage.setItem(opinionsResetKey, "true");
	}

	let opinions = readOpinions();
	renderOpinions(opinions, opinionsList);

	opinionForm.addEventListener("submit", (event) => {
		event.preventDefault();

		const formData = new FormData(opinionForm);
		const message = formData.get("message").trim();

		if (!message) {
			opinionStatus.textContent = "Escribí tu opinión antes de publicarla.";
			return;
		}

		const newOpinion = { name: getRegisteredName(), message };
		opinions = [newOpinion, ...opinions];

		if (!saveOpinions(opinions)) {
			opinionStatus.textContent = "No se pudo guardar la opinión en este navegador.";
			return;
		}

		renderOpinions(opinions, opinionsList);
		opinionForm.reset();
		resizeOpinionMessage();
		opinionStatus.textContent = "Tu opinión fue publicada.";
	});
});

