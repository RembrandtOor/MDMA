interface Song {
	src: string;
	name: string;
	artist: string;
	icon_url: string;
}

interface playerData {
	playPauseBtn: HTMLButtonElement;
	songName: HTMLElement;
	songArtist: HTMLElement;
	songIcon: HTMLImageElement;
}

export default class MusicPlayer {
	playerData: playerData;
	sourceElement: HTMLAudioElement;
	playing: boolean = false;
	currentPlaying: Song;
	queue: Song[] = [];

	constructor(sourceElement: HTMLAudioElement) {
		if (!sourceElement) {
			return;
		}
		this.sourceElement = sourceElement;
		this.sourceElement.volume = 1.0;
		this.playerData = {
			playPauseBtn: document.querySelector('#play-pause'),
			songName: document.querySelector('#song-title'),
			songArtist: document.querySelector('#song-album'),
			songIcon: document.querySelector('#song-icon'),
		};

		this.sourceElement.addEventListener('onended', () => {
			this.play(this.queue[0]);
		});
	}

	play(song: Song = null) {
		if (song != null) {
			if (song == this.currentPlaying) {
				return this.pause();
			}
			document.querySelector<HTMLElement>('#music-player').style.display =
				'flex';
			this.currentPlaying = song;
			this.sourceElement.innerHTML = '';
			const src = document.createElement('source');
			src.src = song.src;
			this.sourceElement.appendChild(src);
			this.sourceElement.currentTime = 0.0;
			this.sourceElement.load();
			this.playerData.songName.innerHTML = song.name;
			this.playerData.songArtist.innerHTML = song.artist;
			this.playerData.songIcon.src = song.icon_url;
		} else {
			if (this.playing) {
				return this.pause();
			} else if (this.currentPlaying == null) {
				return false;
			}
		}

		this.playing = true;
		this.playerData.playPauseBtn.innerHTML =
			'<img src="/img/icons/pause.png"/>';
		this.sourceElement.play();
	}

	pause() {
		this.playing = false;
		this.playerData.playPauseBtn.innerHTML =
			'<img src="/img/icons/play.png"/>';
		this.sourceElement.pause();
	}

	addToQueue(songs) {
		this.queue.push(songs);
	}

	clearQueue() {
		this.queue = [];
	}
}
