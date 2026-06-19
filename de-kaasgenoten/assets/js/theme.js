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
