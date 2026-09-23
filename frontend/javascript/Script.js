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
const opinionsResetKey = "mst-opiniones-reset2";

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

// PERFIL DE USUARIO
// Consulta el estado de la sesión y adapta el menú de navegación al usuario actual.
document.addEventListener("DOMContentLoaded", async () => {
	const navigation = document.querySelector(".main-nav");

	if (!navigation) {
		return;
	}

	try {
		const response = await fetch("../../backend/sesion.php", {
			credentials: "same-origin",
			headers: { Accept: "application/json" }
		});
		const session = await response.json();

		if (session.autenticado) {
			renderAuthenticatedMenu(navigation, session);
		}
	} catch (error) {
		// Si la página se abre sin servidor PHP, conservamos el menú público original.
		console.warn("No se pudo consultar la sesión del usuario.", error);
	}
});

// Crea las iniciales que se muestran dentro del avatar del botón de perfil.
const getProfileInitials = (user) => {
	const firstName = (user.nombre || "").trim().charAt(0);
	const lastName = (user.apellido || "").trim().charAt(0);
	return `${firstName}${lastName}`.toUpperCase() || "U";
};

// Sustituye los enlaces de iniciar sesión y registrarse por el botón de perfil.
const renderAuthenticatedMenu = (navigation, session) => {
	navigation.querySelectorAll("a").forEach((link) => {
		const href = link.getAttribute("href") || "";
		const text = link.textContent.toLowerCase();
		const isAuthenticationLink = href.includes("formulario.html")
			|| href.includes("registro.html")
			|| href.includes("register.html")
			|| text.includes("iniciar sesión")
			|| text.includes("registrarse");

		if (isAuthenticationLink) {
			link.remove();
		}
	});

	if (!navigation.querySelector(".profile-menu")) {
		const profileMenu = document.createElement("div");
		profileMenu.className = "profile-menu";
		profileMenu.innerHTML = `
			<button class="profile-button" type="button" aria-expanded="false" aria-controls="profile-panel">
				<span class="profile-avatar" aria-hidden="true">${getProfileInitials(session.usuario || session)}</span>
				<span class="profile-name">${escapeHtml((session.usuario || session).nombre || "Mi perfil")}</span>
			</button>
			<div class="profile-panel" id="profile-panel" hidden>
				<button class="profile-option" type="button" data-profile-action="settings">Configuración</button>
				<button class="profile-option profile-logout" type="button" data-profile-action="logout">Cerrar sesión</button>
			</div>`;
		navigation.append(profileMenu);
		bindProfileMenu(profileMenu, session);
	}
};

// Escapa texto antes de insertarlo en el HTML creado dinámicamente.
const escapeHtml = (value) => String(value)
	.replaceAll("&", "&amp;")
	.replaceAll("<", "&lt;")
	.replaceAll(">", "&gt;")
	.replaceAll('"', "&quot;")
	.replaceAll("'", "&#039;");

// Conecta el botón del avatar con el panel de opciones del perfil.
const bindProfileMenu = (profileMenu, session) => {
	const profileButton = profileMenu.querySelector(".profile-button");
	const profilePanel = profileMenu.querySelector(".profile-panel");

	profileButton.addEventListener("click", () => {
		const isOpen = profileButton.getAttribute("aria-expanded") === "true";
		profileButton.setAttribute("aria-expanded", String(!isOpen));
		profilePanel.hidden = isOpen;
	});

	profileMenu.querySelector('[data-profile-action="settings"]').addEventListener("click", () => {
		openProfileDialog(session);
		profilePanel.hidden = true;
		profileButton.setAttribute("aria-expanded", "false");
	});

	profileMenu.querySelector('[data-profile-action="logout"]').addEventListener("click", () => {
		// El backend destruye la sesión y devuelve a la página de inicio.
		window.location.href = "../../backend/logout.php";
	});
};

// Muestra un formulario reutilizable para modificar la información del usuario.
const openProfileDialog = async (session) => {
	let user = session.usuario || session;

	try {
		const response = await fetch("../../backend/perfil.php", {
			credentials: "same-origin",
			headers: { Accept: "application/json" }
		});
		const profileResponse = await response.json();
		if (profileResponse.ok) {
			user = profileResponse.usuario;
		}
	} catch (error) {
		console.warn("No se pudo cargar la configuración del perfil.", error);
	}

	const dialog = document.createElement("dialog");
	dialog.className = "profile-dialog";
	dialog.style.left = "auto";
	dialog.style.right = "24px";
	dialog.style.top = "50%";
	dialog.style.transform = "translateY(-50%)";
	dialog.style.margin = "0";
	dialog.innerHTML = `
		<form class="profile-form" method="dialog">
			<div class="profile-dialog-header">
				<div>
					<p class="profile-kicker">Mi cuenta</p>
					<h2>Configuración del perfil</h2>
				</div>
				<button class="profile-close" type="button" aria-label="Cerrar configuración">×</button>
			</div>
			<div class="profile-fields">
				<label>Nombre<input name="nombre" value="${escapeHtml(user.nombre || "")}" required></label>
				<label>Apellido<input name="apellido" value="${escapeHtml(user.apellido || "")}" required></label>
				<label>DNI<input name="dni" value="${escapeHtml(user.dni || "")}" required></label>
				<label>Teléfono<input name="telefono" value="${escapeHtml(user.telefono || "")}" required></label>
				<label class="profile-field-wide">Email<input name="email" type="email" value="${escapeHtml(user.email || "")}" required></label>
				<label class="profile-field-wide">Nueva contraseña <small>(opcional)</small><input name="password" type="password" minlength="6" autocomplete="new-password"></label>
			</div>
			<p class="profile-status" role="status"></p>
			<div class="profile-dialog-actions">
				<button class="profile-cancel" type="button">Cancelar</button>
				<button class="profile-save" type="submit">Guardar cambios</button>
			</div>
		</form>`;

	document.body.append(dialog);
	dialog.showModal();
	bindProfileDialog(dialog);
};

// Envía los cambios al backend y actualiza el menú cuando se guardan correctamente.
const bindProfileDialog = (dialog) => {
	const form = dialog.querySelector(".profile-form");
	const status = dialog.querySelector(".profile-status");

	const closeDialog = () => {
		dialog.close();
		dialog.remove();
	};

	dialog.querySelector(".profile-close").addEventListener("click", closeDialog);
	dialog.querySelector(".profile-cancel").addEventListener("click", closeDialog);

	form.addEventListener("submit", async (event) => {
		event.preventDefault();
		status.textContent = "Guardando cambios...";

		try {
			const response = await fetch("../../backend/perfil.php", {
				method: "POST",
				body: new FormData(form),
				credentials: "same-origin",
				headers: { Accept: "application/json" }
			});
			const result = await response.json();

			if (!result.ok) {
				status.textContent = result.mensaje;
				return;
			}

			status.textContent = result.mensaje;
			setTimeout(closeDialog, 700);
			window.location.reload();
		} catch (error) {
			status.textContent = "No se pudo conectar con el servidor.";
		}
	});
};

