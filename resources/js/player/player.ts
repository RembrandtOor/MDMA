import MusicPlayer from '../classes/MusicPlayer';

interface Song {
	src: string;
	name: string;
	artist: string;
	icon_url: string;
}

const soundElement = document.querySelector<HTMLAudioElement>('#audio-element');
const player = new MusicPlayer(soundElement);

const playPauseBtn = document.querySelector<HTMLButtonElement>('#play-pause');

playPauseBtn?.addEventListener('click', () => {
	if (player.playing) {
		playPauseBtn.innerHTML = '<img src="/img/icons/play.png" />';
		player.pause();
	} else {
		playPauseBtn.innerHTML = '<img src="/img/icons/pause.png" />';
		player.play();
	}
});

const playSongButtons =
	document.querySelectorAll<HTMLButtonElement>('.play-song');

if (playSongButtons) {
	playSongButtons.forEach((playSongBtn) => {
		playSongBtn.addEventListener('click', () => {
			if (playSongBtn.classList.contains('active')) {
				player.pause();
				playSongBtn.innerHTML = '<img src="/img/icons/play.png"/>';
			} else {
				const song: Song = JSON.parse(playSongBtn.dataset.song);
				player.play(song);

				const active =
					document.querySelector<HTMLButtonElement>(
						'.play-song.active'
					);
				if (active) {
					active.classList.remove('active');
					active.innerHTML = '<img src="/img/icons/play.png"/>';
				}

				playSongBtn.classList.add('active');
				playSongBtn.innerHTML = '<img src="/img/icons/pause.png"/>';
			}
		});
	});
}
