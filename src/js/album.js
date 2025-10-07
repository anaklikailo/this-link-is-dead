const params = new URLSearchParams(location.search); // Obtiene parámetros de la URL desde el ?
const idx = parseInt(params.get('idx')); // Convierte el parámetro 'idx' después del ? a un número entero
const album = albumData.find(a => a.idx === idx); // Busca el álbum en albumData que coincide con el idx obtenido de la URL

if (album) { // Si se encuentra el álbum, procede a crear y mostrar la información
    const container = document.createElement('div');
    container.className = 'album-item';

    let songsAndNotes = '';
    for (let i = 0; i < album.songs.length; i++) {
        const song = album.songs[i];
        if (song.note) { // Verifica si la canción tiene una nota adicional
            songsAndNotes += `<li>${song.name}<div class="song-info">Nota:<br>${song.note}</div></li>`;
        } else {
            songsAndNotes += `<li>${song}</li>`;
        }
    }

    container.innerHTML = `
        <div class="album-pic-info">
            <img src="${album.img}"> 
            <h2>${album.title}</h2>
            <p>(${album.year})</p>
        </div>
        <div class="album-songs">
            <h3>Canciones:</h3>
            <ol>
                ${songsAndNotes}
            </ol>
        </div>
    `;
    document.body.appendChild(container);
}
