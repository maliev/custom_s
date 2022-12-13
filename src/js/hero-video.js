document.addEventListener("DOMContentLoaded", (event) => {
    const videoHeader = document.querySelector('.hero-video')
    if (videoHeader !== null) {
        const videoWrapper = document.querySelector('.hero-video__wrap'),
            videoMP4 = videoWrapper.dataset.mp4,
            videoTag = document.querySelector('.hero-video__video')
        videoTag.innerHTML = videoTag.innerHTML + '<source type="video/mp4" src="' + videoMP4 + '">';
    }
})
