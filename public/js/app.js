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

const playPauseBtn = document.querySelector('#play-pause');

var audio = {
	playing: false,
};

var soundElement = document.querySelector('#audio-element');

var src = document.createElement('source');
src.src = '/data/songs/821b11ea-487e-47e3-ad51-b08d1239e106.mp3';
soundElement.appendChild(src);

soundElement.load();
soundElement.volume = 0.0;
soundElement.play();

playPauseBtn?.addEventListener('click', () => {
	if (audio.playing) {
		audio.playing = false;
		playPauseBtn.innerHTML = '<img src="img/icons/play.png" />';
		soundElement.volume = 0.0;
	} else {
		audio.playing = true;
		playPauseBtn.innerHTML = '<img src="img/icons/pause.png" />';
		soundElement.currentTime = 0.01;
		soundElement.volume = 1.0;
	}
});
