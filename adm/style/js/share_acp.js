(function() {
	'use strict';

	// Sort container
	const container = document.body.querySelector('.share-preview > .share-list');

	// There is nothing to do
	if (!container) {
		return;
	}

	// Sort event
	const displayWarning = function(e) {
		const warning = document.body.querySelector('.warningbox');

		if (!warning || warning.hasAttribute('data-triggered')) {
			return;
		}

		warning.classList.remove('hidden');
		warning.setAttribute('data-triggered', 'true');
	};

	// Sort
	const sortable = new Sortable.create(container, {
		handle: '.share-item',
		animation: 150,
		ghostClass: 'share-item-ghost',
		onSort: displayWarning
	});

	/**
	 * TODO: Update field value
	 */
	const updateNetworksOrder = function() {
		const networks = Array.prototype.slice.call(container.children).filter(function(network) {
			return !network.classList.contains('share-item-disabled');
		});

		if (networks.length <= 0) {
			return;
		}

		const field = container.parentNode.querySelector('[name="share_social_networks_order"]');

		if (!field) {
			return;
		}
	};

	// TODO: Call updateNetworksOrder()
	document.body.addEventListener('change', function(e) {
		const checkbox = e.target.closest('[name="share_social_networks[]"]');

		if (!checkbox) {
			return;
		}

		const link = container.querySelector('.share-link-' + checkbox.value);

		if (!link) {
			return;
		}

		link.classList.toggle('share-item-disabled', !checkbox.checked);
		displayWarning();
	});
})();
