const container = document.getElementById('albumBoxContainer'); 

albumData.forEach(album => { 
    const div = document.createElement('div');
    div.className = 'album-box';
    div.style.backgroundImage = `url(${album.img})`;
    div.innerHTML = `
    <a href="album.html?idx=${album.idx}"></a> <!-- Enlace a album.html con el ID del álbum como parámetro -->
    `;
    container.appendChild(div);
});