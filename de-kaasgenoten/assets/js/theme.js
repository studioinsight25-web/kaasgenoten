(function () {
	var toggle = document.querySelector('.dkg-menu-toggle');
	var nav = document.querySelector('.dkg-primary-nav');
	var menu = document.querySelector('.dkg-menu');
	var mobileQuery = window.matchMedia('(max-width: 900px)');

	if (!toggle || !nav) {
		return;
	}

	function closeSubmenuItem(item) {
		item.classList.remove('is-submenu-open');

		var button = Array.prototype.find.call(item.children, function (child) {
			return child.classList && child.classList.contains('dkg-submenu-toggle');
		});

		if (button) {
			button.setAttribute('aria-expanded', 'false');
		}
	}

	function closeSubmenus(container) {
		container.querySelectorAll('.is-submenu-open').forEach(closeSubmenuItem);
	}

	function closeSiblingSubmenus(item) {
		var parent = item.parentElement;

		if (!parent) {
			return;
		}

		Array.prototype.forEach.call(parent.children, function (sibling) {
			if (sibling !== item && sibling.classList.contains('menu-item-has-children')) {
				closeSubmenuItem(sibling);
			}
		});
	}

	if (menu) {
		menu.querySelectorAll('.menu-item-has-children').forEach(function (item, index) {
			var link = Array.prototype.find.call(item.children, function (child) {
				return child.tagName && child.tagName.toLowerCase() === 'a';
			});
			var submenu = Array.prototype.find.call(item.children, function (child) {
				return child.classList && child.classList.contains('sub-menu');
			});

			if (!link || !submenu) {
				return;
			}

			if (!submenu.id) {
				submenu.id = 'dkg-submenu-' + index;
			}

			var submenuToggle = document.createElement('button');
			var toggleText = document.createElement('span');
			submenuToggle.className = 'dkg-submenu-toggle';
			submenuToggle.type = 'button';
			submenuToggle.setAttribute('aria-expanded', 'false');
			submenuToggle.setAttribute('aria-controls', submenu.id);
			toggleText.className = 'screen-reader-text';
			toggleText.textContent = link.textContent.trim();
			submenuToggle.appendChild(toggleText);

			item.insertBefore(submenuToggle, submenu);

			submenuToggle.addEventListener('click', function (event) {
				if (!mobileQuery.matches) {
					return;
				}

				event.preventDefault();
				event.stopPropagation();

				var willOpen = !item.classList.contains('is-submenu-open');

				if (willOpen) {
					closeSiblingSubmenus(item);
				}

				item.classList.toggle('is-submenu-open', willOpen);
				submenuToggle.setAttribute('aria-expanded', String(willOpen));
			});
		});
	}

	toggle.addEventListener('click', function () {
		var isOpen = toggle.getAttribute('aria-expanded') === 'true';
		toggle.setAttribute('aria-expanded', String(!isOpen));
		document.body.classList.toggle('dkg-menu-open', !isOpen);

		if (isOpen && menu) {
			closeSubmenus(menu);
		}
	});
})();

(function () {
	var banner = document.getElementById('dkg-cookie-banner');

	if (!banner) {
		return;
	}

	var STORAGE_KEY = 'dkgCookieConsent';
	var stored = null;

	try {
		stored = window.localStorage.getItem(STORAGE_KEY);
	} catch (e) {
		stored = null;
	}

	if (!stored) {
		banner.classList.add('is-visible');
	}

	banner.addEventListener('click', function (event) {
		var button = event.target.closest('[data-dkg-cookie]');

		if (!button) {
			return;
		}

		try {
			window.localStorage.setItem(STORAGE_KEY, button.getAttribute('data-dkg-cookie'));
		} catch (e) {}

		banner.classList.remove('is-visible');
	});
})();

(function () {
	var openButtons = document.querySelectorAll('[data-dkg-mini-cart-open]');
	var miniCart = document.getElementById('dkg-mini-cart');

	if (!miniCart || !openButtons.length) {
		return;
	}

	function openMiniCart() {
		miniCart.removeAttribute('hidden');
		document.body.classList.add('dkg-mini-cart-open');
	}

	function closeMiniCart() {
		miniCart.setAttribute('hidden', '');
		document.body.classList.remove('dkg-mini-cart-open');
	}

	openButtons.forEach(function (button) {
		button.addEventListener('click', function (event) {
			event.preventDefault();
			openMiniCart();
		});
	});

	miniCart.addEventListener('click', function (event) {
		if (event.target.closest('[data-dkg-mini-cart-close]')) {
			closeMiniCart();
		}
	});

	document.addEventListener('keydown', function (event) {
		if ('Escape' === event.key && document.body.classList.contains('dkg-mini-cart-open')) {
			closeMiniCart();
		}
	});
})();

(function () {
	var stickyBar = document.getElementById('dkg-sticky-atc');
	var summary = document.getElementById('product-add-to-cart');

	if (!stickyBar || !summary) {
		return;
	}

	function updateStickyBar() {
		var rect = summary.getBoundingClientRect();
		var shouldShow = rect.bottom < 0;

		if (shouldShow) {
			stickyBar.removeAttribute('hidden');
		} else {
			stickyBar.setAttribute('hidden', '');
		}
	}

	window.addEventListener('scroll', updateStickyBar, { passive: true });
	window.addEventListener('resize', updateStickyBar);
	updateStickyBar();
})();

(function () {
	var list = document.querySelector('.dkg-faq-list');

	if (!list) {
		return;
	}

	var items = list.querySelectorAll('.dkg-faq-item');

	items.forEach(function (item) {
		var button = item.querySelector('.dkg-faq-question');
		var panel = item.querySelector('.dkg-faq-answer');

		if (!button || !panel) {
			return;
		}

		function setOpen(open) {
			item.classList.toggle('is-open', open);
			button.setAttribute('aria-expanded', String(open));
			panel.hidden = !open;
		}

		button.addEventListener('click', function () {
			var willOpen = !item.classList.contains('is-open');

			items.forEach(function (other) {
				if (other === item) {
					return;
				}

				var otherButton = other.querySelector('.dkg-faq-question');
				var otherPanel = other.querySelector('.dkg-faq-answer');

				if (!otherButton || !otherPanel) {
					return;
				}

				other.classList.remove('is-open');
				otherButton.setAttribute('aria-expanded', 'false');
				otherPanel.hidden = true;
			});

			setOpen(willOpen);
		});
	});
})();
