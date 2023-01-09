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


function upheight(id){
    document.getElementById(id).classList.toggle("xl:h-auto");


}
// The area bellow is for all the script getting data from the api and displaying the film on the web site
var p = 1; //setting page number to 1
var ActuGenre = 28 ; //setting genre action
var CurentFetch = 0; //setting curent fetch to none
var CurentFilter = 0; //setting curent filter to none
var IsAdulte = false; //setting adult filter to false
let orderby = document.querySelector('#orderby');
// orderby.addEventListener('change', () => {
// console.log(orderby.value);
// });

//verifier si l'input type checkbox est coché
let pegi = document.querySelector('#pegi');
window.addEventListener('click', () => {
    if (pegi.checked) {
        IsAdulte = '&include_adult=false'
        console.log(IsAdulte);
    } else {
        IsAdulte = '&include_adult=true'
        console.log(IsAdulte);
    }
});

//script display by default on the page (show pop movie)
let listMovFilter = 'https:/'+'/api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=' + ActuGenre + IsAdulte
CurentFetch = listMovFilter
listMovFilter = fetch('https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=' + ActuGenre + IsAdulte)
listMovFilter.then(function (response) {
    return response.json();
    }).then(function (data) {
    //console.log(data);
    document.querySelector('.mov_area').innerHTML = '';
    document.querySelector('.li_page_n').innerHTML = p ;
    console.log('cas 3')
    for (let i = 0; i < data.results.length; i++) {
        let div = document.createElement('div')
        div.innerHTML = `<a href="movie.php?ids=${data.results[i].id}"><div><h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p></div></a>`
        document.querySelector('.mov_area').appendChild(div)
    }
});
// var p = 1;
// var ActuGenre = 0 ;

//Axolote AKA the search bar with axios
let SearchInput = document.querySelector('#search');
SearchInput.addEventListener('keyup', () => {
    console.log(SearchInput.value);
    console.log("bonjour")
    if (SearchInput.value.length == 0) {
        //axios.get('https://api.themoviedb.org/3/movie/popular?api_key=512f0783bae246658f714cd1abc41513&language=en-US&page=1')
        axios.get('https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=28'+ IsAdulte)
        .then(response => {
        console.log(response.data);
        p = 1
        ActuGenre = 28
        document.querySelector('.mov_area').innerHTML = '';
        document.querySelector('.li_page_n').innerHTML = p ;
        for (let i = 0; i < response.data.results.length; i++) {
            let div = document.createElement('div')
            div.innerHTML = `<h2>${response.data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${response.data.results[i].poster_path}"><p>${response.data.results[i].overview}</p>`
            document.querySelector('.mov_area').appendChild(div)
        }
        });
    } else {
        axios.get('https://api.themoviedb.org/3/search/movie?api_key=512f0783bae246658f714cd1abc41513&language=en-US&query=' + SearchInput.value + '&page=1' + IsAdulte)
        .then(response => {
            //console.log(response.data);
            p = 1
            document.querySelector('.mov_area').innerHTML = '';
            document.querySelector('.li_page_n').innerHTML = p ;
            for (let i = 0; i < response.data.results.length; i++) {
                let div = document.createElement('div')
                div.innerHTML = `<a href="movie.php?ids=${data.results[i].id}"><div><h2>${response.data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${response.data.results[i].poster_path}"><p>${response.data.results[i].overview}</p></div></a>`
                document.querySelector('.mov_area').appendChild(div)
            }
        })
        .catch(error => {
            console.log(error + 'not axolote');
        });
    }
});

// script de la side bar pour afficher les genres
const lig = document.querySelectorAll('.li_genre');
lig.forEach((item) => {
    item.addEventListener('click', () => {
        console.log(item.id);
        ActuGenre = item.id;
        p = 1
        let listMovGenre = fetch('https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=' + item.id + IsAdulte)
        console.log(listMovGenre)
        listMovGenre.then(function (response) {
            return response.json();
        }).then(function (data) {
            console.log(data);
            document.querySelector('.mov_area').innerHTML = '';
            console.log('Actugenre item id (script 2) : ' + ActuGenre)
            for (let i = 0; i < data.results.length; i++) {
                let div = document.createElement('div')
                div.innerHTML = `<a href="movie.php?ids=${data.results[i].id}"><div><h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p></div></a>`
                document.querySelector('.mov_area').appendChild(div)
            }
        });
    })
})




document.querySelector('.li_page_n').innerHTML = p ;
// script to change page ( wanna die send help)
const lip = document.querySelectorAll('.li_page');
lip.forEach((item) => {
    item.addEventListener('click', () => {
        console.log(item.id);
        console.log('Actugenre item id (script page) : ' + ActuGenre)
        console.log(' before if page n°' + p)
        if (item.id === '1'){
            p += 1
        } else if ( item.id === '2' && p !== 1) {
            p = p - 1
        } else {
            p = 1
        }
        console.log(' after if page n°' + p)

        if (ActuGenre != 0){
            let listMovPage = fetch('https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=' + ActuGenre + '&page=' + p + IsAdulte)
            console.log(listMovPage)
            listMovPage.then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(data);
                document.querySelector('.mov_area').innerHTML = '';
                document.querySelector('.li_page_n').innerHTML = p ;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                for (let i = 0; i < data.results.length; i++) {
                    let div = document.createElement('div')
                    div.innerHTML = `<a href="movie.php?ids=${data.results[i].id}"><div><h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p></div></a>`
                    document.querySelector('.mov_area').appendChild(div)
                }
            });
        } else {
            let listMovPage = fetch('https://api.themoviedb.org/3/movie/popular?api_key=512f0783bae246658f714cd1abc41513&language=en-US&page=' + p + + IsAdulte)
            console.log(listMovPage)
            listMovPage.then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(data);
                document.querySelector('.mov_area').innerHTML = '';
                document.querySelector('.li_page_n').innerHTML = p ;
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                for (let i = 0; i < data.results.length; i++) {
                    let div = document.createElement('div')
                    div.innerHTML = `<a href="movie.php?ids=${data.results[i].id}"><div><h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p></div></a>`
                    document.querySelector('.mov_area').appendChild(div)
                }
            });
        }
    })
})

