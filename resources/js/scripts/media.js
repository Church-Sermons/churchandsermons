// // import player
// const { player } = require("./custom");
const { audioPlayer } = require("./custom");

document.addEventListener("DOMContentLoaded", function() {
    // manage audio media file
    // get files
    const el = document.querySelectorAll(".meta-container");

    if (el) {
        Array.from(el).forEach(function(v) {
            // on click prevent default
            v.addEventListener("click", function(e) {
                e.preventDefault();

                // CSS styling
                // Remove active class and place in now playing area
                // get data
                // pass to function to play audio
                playSelectedAudio(getMediaAttributesValue(this));
                // update audio display interface
                updateAudioDisplayInterface(getMediaAttributesValue(this));
            });
        });
    }

    function getMediaAttributesValue(v) {
        return {
            src: v.getAttribute("data-src"),
            title: v.getAttribute("data-title"),
            size: v.getAttribute("data-size"),
            artist: v.getAttribute("data-artist"),
            type: v.getAttribute("data-type")
        };
    }

    // music card click
    const musicCard = document.querySelectorAll(".music-card");
    if (musicCard) {
        Array.from(musicCard).forEach(function(card) {
            card.addEventListener("click", function(e) {
                // e.stopPropagation();
                // get data from child
                const thisChild = this.querySelector(".meta-container");
                if (thisChild) {
                    // get data from this child and play
                    playSelectedAudio(getMediaAttributesValue(thisChild));
                    // update audio display interface
                    updateAudioDisplayInterface(
                        getMediaAttributesValue(thisChild)
                    );
                }

                // CSS styling
                // remove active class and add to playing area
                if (!this.classList.contains("active")) {
                    // remove class from all other elements
                    removeclassActive(musicCard);
                    // add class here
                    addClassActive(this);
                }
            });
        });
    }

    function playSelectedAudio({ src, title, type }) {
        audioPlayer.source = {
            type: "audio",
            title: title,
            sources: [
                {
                    src,
                    type
                }
            ]
        };

        // play audio
        audioPlayer.play();
    }

    function updateAudioDisplayInterface({ title, artist, size }) {
        document.getElementById("title").innerHTML = title;
        document.getElementById("artist").innerHTML = artist;
        document.getElementById("size").innerHTML = size;
    }

    // remove active class from all other elements
    function removeclassActive(el) {
        Array.from(el).forEach(a => a.classList.remove("active"));
    }

    // add active class to now playing
    function addClassActive(el) {
        el.classList.add("active");
    }
});
