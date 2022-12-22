<?php

require_once 'Connection.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] === ''){
    header('Location: login.php');
}

require 'doctype.template.php';
require 'Header.template.php';

?>
<main class="ml-[18%]">
        <aside class="w-2/12 h-full bg-slate-900 text-white fixed left-0 overflow-y-scroll ">
        <ul class="block">
            <li class="li_genre" id="28">Action</li>
            <li class="li_genre" id="12">Adventure</li>
            <li class="li_genre" id="16">Animation</li>
            <li class="li_genre" id="35">Comedy</li>
            <li class="li_genre" id="80">Crime</li>
            <li class="li_genre" id="99">Documentary</li>
            <li class="li_genre" id="18">Drama</li>
            <li class="li_genre" id="10751">Family</li>
            <li class="li_genre" id="14">Fantasy</li>
            <li class="li_genre" id="36">History</li>
            <li class="li_genre" id="27">Horror</li>
            <li class="li_genre" id="10402">Music</li>
            <li class="li_genre" id="9648">Mystery</li>
            <li class="li_genre" id="10749">Romance</li>
            <li class="li_genre" id="878">Science Fiction</li>
            <li class="li_genre" id="10770">TV Movie</li>
            <li class="li_genre" id="53">Thriller</li>
            <li class="li_genre" id="10752">War</li>
            <li class="li_genre" id="37">Western</li>
        </ul>
    </aside>


        <section class="mov_area flex flex-wrap gap-[25px]">
        </section>
</main>
        <ul class="flex gap-4 justify-center text-white" >
            <li class="li_page-" id="1" > << </li>
            <li class="li_page+" id="2" > >> </li>
        </ul>





<?php
require 'footer.template.php';
?>
<script>

    // GESTION API

    // https://api.themoviedb.org/3/discover/movie?api_key=512f0783bae246658f714cd1abc41513&with_genres=28

    //movi pop

    let listMovPop = fetch('https://api.themoviedb.org/3/movie/popular?api_key=512f0783bae246658f714cd1abc41513&language=en-US&page=1')
    console.log("bonjour")
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
</script>
