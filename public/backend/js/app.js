function showAlert(message, type) {
	var messageContainer = document.createElement('div');
	messageContainer.className = `alert alert-${type} alert-dismissible fade show`;
	messageContainer.role = 'alert';
	messageContainer.innerHTML = `
		${message}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	`;
	document.querySelector('.container').prepend(messageContainer);
	setTimeout(function () {
		if (document.contains(messageContainer)) {
			messageContainer.remove();
		}
	}, 5000);
}

document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.querySelector('.navbar-toggler');
    const sidebar = document.querySelector('#sidebarMenu');

    sidebarToggle.addEventListener('click', function () {
        sidebar.classList.toggle('show');
    });
});
