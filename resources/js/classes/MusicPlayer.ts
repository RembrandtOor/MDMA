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

	constructor(sourceElement: HTMLAudioElement) {
		this.sourceElement = sourceElement;
		this.sourceElement.volume = 1.0;
		this.playerData = {
			playPauseBtn: document.querySelector('#play-pause'),
			songName: document.querySelector('#song-title'),
			songArtist: document.querySelector('#song-album'),
			songIcon: document.querySelector('#song-icon'),
		};
	}

	play(song: Song = null) {
		if (this.currentPlaying == null) {
			document.querySelector<HTMLElement>('#music-player').style.display =
				'flex';
		}
		if (song != null) {
			if (song == this.currentPlaying) {
				return this.pause();
			}
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
}
