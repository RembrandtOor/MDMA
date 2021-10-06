const registerForm = document.querySelector('#register-form');
const loginForm = document.querySelector('#login-form');

loginForm?.addEventListener('submit', async (e) => {
	e.preventDefault();

	const res = await fetch('/login', {
		method: 'POST',
		body: new FormData(loginForm),
	});
});
