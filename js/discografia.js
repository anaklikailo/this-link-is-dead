const container = document.getElementById('albumBoxContainer'); // Contenedor principal uqe referencia al de discografia.html

albumData.forEach(album => { // Para cada álbum en albumData, crea un div con la imagen de fondo y un enlace a album.html
    const div = document.createElement('div');
    div.className = 'album-box';
    div.style.backgroundImage = `url(${album.img})`;
    div.innerHTML = `
    <a href="album.html?idx=${album.idx}"></a> 
    `; // Enlace a album.html con el ID del álbum como parámetro
    container.appendChild(div);
});