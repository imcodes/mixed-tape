import { Controller } from '@hotwired/stimulus';
import axios from 'axios';
/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static values = {
        isPlaying: Boolean,
        infoUrl: String
    }
    static targets = ['playPauseIcon']


    initialize(){
        this.isPlaying = false;
        this.audio = new Audio()
    }

    togglePlayPause(event){
        event.preventDefault()
        
        
        this.isPlayingValue ? this.pause() : this.play()

    }

    play() {
        //Only fetch the song data if the audio src is not yet set
        if(!this.audio.src){
            axios.get(this.infoUrlValue)
            .then(response => {
                console.log(response)
                this.audio.src = response.data.url
            })
        }
        // Change the play icon if song ended
        this.audio.addEventListener('ended',()=>{
            this.isPlayingValue = false
            this.changeIcon()
        })
        this.audio.play()
        this.isPlayingValue = true
        this.changeIcon()
        console.log('playing')
    }

    pause() {
        this.audio.pause()
        this.isPlayingValue = false
        this.changeIcon()
        console.log('paused')
    }

    stop(event){
        event.preventDefault()
    }

    changeIcon(){
        if(this.isPlayingValue){
            this.playPauseIconTarget.classList.remove('fa-play')
            this.playPauseIconTarget.classList.add('fa-pause')
        }else{
            this.playPauseIconTarget.classList.remove('fa-pause')
            this.playPauseIconTarget.classList.add('fa-play')
        }
    }

}
