(function () {
	var toggle = document.querySelector('.dkg-menu-toggle');
	var nav = document.querySelector('.dkg-primary-nav');

	if (!toggle || !nav) {
		return;
	}

	toggle.addEventListener('click', function () {
		var isOpen = toggle.getAttribute('aria-expanded') === 'true';
		toggle.setAttribute('aria-expanded', String(!isOpen));
		document.body.classList.toggle('dkg-menu-open', !isOpen);
	});
})();
