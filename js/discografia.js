const albumImages = [
    "../images/adrenaline.jpg",
    "../images/around-the-fur.jpg",
    "../images/white-pony.jpg",
    "../images/deftones-selftitled.jpg",
    "../images/saturday-night-wrist.jpg",
    "../images/diamond-eyes.jpg",
    "../images/koi-no-yokan.jpg",
    "../images/gore.jpg",
    "../images/ohms.jpg",
    "../images/private-music.jpg"
];

const albumBoxContainer = document.getElementById('albumBoxContainer');
albumImages.forEach((src, idx) => {
    const div = document.createElement('div');
    div.className = 'album-box';
    if (idx === 4) {
        div.innerHTML = `<a href="album.html"><img src="${src}"></a>`;
    } else {
        div.innerHTML = `<img src="${src}">`;
    }
    albumBoxContainer.appendChild(div);
});