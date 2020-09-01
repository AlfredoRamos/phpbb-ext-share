(function() {
	'use strict';

	// Sort container
	const container = document.body.querySelector('.share-preview > .share-list');
	let timer = null;

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

	/**
	 * TODO: Update field value
	 */
	const updateNetworksOrder = function() {
		displayWarning();

		timer = setTimeout(function() {
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

			let networkList = [];

			networks.forEach(function(item) {
				if (!item || !item.hasAttribute('data-network')) {
					return;
				}

				networkList.push(item.getAttribute('data-network'));
			});

			if (networkList.length <= 0) {
				return;
			}

			field.value = networkList.join(',');

			clearTimeout(timer);
		}, 200);
	};

	// Sort
	const sortable = new Sortable.create(container, {
		handle: '.share-item',
		animation: 150,
		ghostClass: 'share-item-ghost',
		onEnd: updateNetworksOrder
	});

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
		updateNetworksOrder();
		displayWarning();
	});
})();
