// // import player
// const { player } = require("./custom");
const { audioPlayer, videoPlayer } = require("./custom");

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
                playSelectedMedia(
                    audioPlayer,
                    "audio",
                    getMediaAttributesValue(this)
                );
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
            type: v.getAttribute("data-type"),
            poster: v.getAttribute("data-poster"),
            description: v.getAttribute("data-description"),
            published: v.getAttribute("data-published")
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
                    playSelectedMedia(
                        audioPlayer,
                        "audio",
                        getMediaAttributesValue(thisChild)
                    );
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

    function playSelectedMedia(playerType, mediaType, { src, title, type }) {
        playerType.source = {
            type: mediaType,
            title: title,
            sources: [
                {
                    src,
                    type
                }
            ]
        };

        // play audio
        if (mediaType == "audio") {
            playerType.play();
        }
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

    // Logic for video player, will be separated later
    const videoElement = document.querySelectorAll(".video");
    const vPlayer = document.getElementById("video-player");
    const modal = document.getElementById("categoryModal");
    const modalTitle = document.querySelector(".modal-title");
    if (videoElement && videoElement.length > 0) {
        Array.from(videoElement).forEach(function(v) {
            // event listener for clicks
            v.addEventListener("click", function(e) {
                const mediaData = getMediaAttributesValue(this);
                if (vPlayer) {
                    // populate videoplayer
                    playSelectedMedia(videoPlayer, "video", mediaData);
                }

                if (modalTitle) {
                    modalTitle.innerHTML = mediaData.title;
                }

                // populate elements
                const vme = getVideoModalElements();
                populateVideoModalElements(vme, mediaData);
            });
        });
    }

    if (modal && vPlayer) {
        $(modal).on("hide.bs.modal", function(e) {
            // close video player on modal hide
            videoPlayer.pause();
        });
    }

    function getVideoModalElements() {
        // get elements
        let videoTitle = document.getElementById("video-title"),
            videoDescription = document.getElementById("video-description"),
            videoPoster = document.getElementById("video-poster"),
            videoSize = document.getElementById("video-size"),
            videoPublished = document.getElementById("video-published");

        return {
            videoTitle,
            videoDescription,
            videoPoster,
            videoSize,
            videoPublished
        };
    }

    function populateVideoModalElements(elements, data) {
        const { title, description, poster, size, published } = data;
        const {
            videoTitle,
            videoDescription,
            videoPoster,
            videoSize,
            videoPublished
        } = elements;

        // image area, populate src and alt
        if (videoPoster) {
            videoPoster.src = poster;
            videoPoster.alt = `${title}-Poster`;
        }

        // set icon
        const icon = setPublishedDateIcon(splitDate(published, " ")[1]);

        // fill values
        videoTitle.innerHTML = title;
        videoDescription.innerHTML = description;
        videoSize.innerHTML = `<i class="far fa-hdd"></i> ${size}`;
        videoPublished.innerHTML = `${icon} ${published}`;
    }

    // set icon for modal video date and video size description
    function setPublishedDateIcon(published) {
        let icon;
        switch (true) {
            case /hours?/.test(published):
            case /minutes?/.test(published):
            case /seconds?/.test(published):
                icon = `<i class="far fa-clock"></i>`;
                break;
            default:
                icon = `<i class="far fa-calendar-alt"></i>`;
                break;
        }

        return icon;
    }

    // may be applied in other situations thus being kept separate from setPublished
    const splitDate = (i, by) =>
        typeof i == "string" && i.length > 0
            ? i.split(by)
            : i.length > 0
            ? i.toString().split(by)
            : null;
});
