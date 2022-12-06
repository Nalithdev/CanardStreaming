function openNav() {
    document.querySelector("#mySidenav").classList.add("side-active");
    document.querySelector(".menu-overlay").classList.add("menu-overlay-active");
}

document.querySelector('.menu-overlay').addEventListener('click', function(){
    closeNav()
})

function closeNav() {
    document.querySelector("#mySidenav").classList.remove("side-active");
    document.querySelector(".menu-overlay").classList.remove("menu-overlay-active");
}

// https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=28

//movi pop
let listMovPop = fetch('https://api.themoviedb.org/3/movie/popular?api_key=512f0783bae246658f714cd1abc41513&language=en-US&page=1')
listMovPop.then(function (response) {
    return response.json();
}).then(function (data) {
    console.log(data);
    for (let i = 0; i < data.results.length; i++) {
        let div = document.createElement('div')
        div.innerHTML = `<h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p>`
        document.querySelector('.mov_area').appendChild(div)
    }
});


// au click récupérer l'id du li et le console.log
const lig = document.querySelectorAll('.li_genre');
lig.forEach((item) => {
    item.addEventListener('click', () => {
        console.log(item.id);
        let listMovGenre = fetch('https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=' + item.id)
        console.log(listMovGenre)
        listMovGenre.then(function (response) {
            return response.json();
        }).then(function (data) {
            console.log(data);
            document.querySelector('.mov_area').innerHTML = '';
            for (let i = 0; i < data.results.length; i++) {
                let div = document.createElement('div')
                div.innerHTML = `<h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p>`
                document.querySelector('.mov_area').appendChild(div)
            }
        });
    })
})