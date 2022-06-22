const video = document.querySelector('#aoi-video')
const controlsBtn = document.querySelectorAll('.aoi-meet-controls-button')

function videoStart() {
    navigator.mediaDevices
      .getUserMedia({
        video: true,
        audio: false,
      })
      .then((stream) => {
        if (video)
            video.srcObject = stream;
      })
      .catch((error) => console.log(error))
}

window.onload = (() => videoStart());

controlsBtn.forEach(btn => (
  btn.addEventListener('click', ({ target }) => {
    const btn = target.nodeName == ('SPAN' || 'I') ? (
      target.parentNode
    ) : (
      target
    )

    if (btn.classList.contains('video')) {
      console.log('video')
    } else if (btn.classList.contains('microphone')) {
      console.log('microphone')
    } else {
      console.log('unknown')
    }
  })
))