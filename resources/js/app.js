const Swal = require('sweetalert2');

const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
	// didOpen: (toast) => {
	// 	toast.addEventListener('mouseenter', Swal.stopTimer);
	// 	toast.addEventListener('mouseleave', Swal.resumeTimer);
	// },
});

const registerForm = document.querySelector('#register-form');

registerForm?.addEventListener('submit', async (e) => {
	e.preventDefault();

	const res = await fetch('/register', {
		method: 'POST',
		body: new FormData(registerForm),
	});
	if (res.ok) {
		const json = await res.json();
		if (json.success && json.success == true) {
			Toast.fire({
				icon: 'success',
				title: json.message,
			});
			setTimeout(() => {
				location.reload();
			}, 2000);
		} else {
			Toast.fire({
				icon: 'error',
				title: json.error,
			});
		}
	} else {
		Toast.fire({
			icon: 'error',
			title: 'Something went wrong!',
		});
	}
});

const loginForm = document.querySelector('#login-form');

loginForm?.addEventListener('submit', async (e) => {
	e.preventDefault();

	const res = await fetch('/login', {
		method: 'POST',
		body: new FormData(loginForm),
	});
	if (res.ok) {
		const json = await res.json();
		if (json.success && json.success == true) {
			Toast.fire({
				icon: 'success',
				title: json.message,
			});
			setTimeout(() => {
				location.reload();
			}, 2000);
		} else {
			Toast.fire({
				icon: 'error',
				title: json.error,
			});
		}
	} else {
		Toast.fire({
			icon: 'error',
			title: 'Something went wrong!',
		});
	}
});

const createPlaylistBtn = document.querySelector('#create-playlist');

createPlaylistBtn?.addEventListener('click', async (e) => {
	e.preventDefault();

	const res = await fetch('/api/playlist/create', {
		method: 'POST',
		// body: JSON.stringify({

		// }),
		// headers: {
		// 	'Content-Type': 'application/json'
		// }
	});
	if (res.ok) {
		const json = await res.json();
		if (json.success && json.success == true) {
			Toast.fire({
				icon: 'success',
				title: json.message,
			});
			setTimeout(() => {
				window.location.href = json.playlist_url;
			}, 2000);
		} else {
			Toast.fire({
				icon: 'error',
				title: json.error,
			});
		}
	} else {
		Toast.fire({
			icon: 'error',
			title: 'Something went wrong!',
		});
	}
});

require('./player/player.ts');

const togglePlayer = document.querySelector('#open-player');
let playerOpen = false;

togglePlayer?.addEventListener('click', () => {
	playerOpen = !playerOpen;
	document
		.querySelector('#music-player')
		.classList.toggle('open', playerOpen);
});
