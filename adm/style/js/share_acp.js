(function() {
	'use strict';

	// Sort container
	const container = document.body.querySelector('.share-list');

	// There is nothing to do
	if (!container) {
		return;
	}

	// Sort event
	const handleSort = function(e) {
		let warning = document.body.querySelector('.warningbox');

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
		onSort: handleSort
	});
})();
