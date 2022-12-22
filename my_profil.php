<?php

require_once 'Connection.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] === ''){
    header('Location: login.php');
}

require 'doctype.template.php';
require 'Header.template.php';


?>

<div class="profil_container text-white">
    <div class=" user h-full flex flex-col text-center bg-slate-800">
        <img class="w-2/5 m-auto mb-1 mt-0 " src="img/user_icon.webp">
        <?php
        echo '<h1>' . $_SESSION['user']['pseudo'] . ' ' . '</h1>';
        echo '<h3>' . $_SESSION['user']['email'] . ' ' . '</h3>';
        ?>
    </div>
    <div class="block w-[70%] ml-[30%]">
        <div class="h-1/2 flex flex-wrap">
            <h2>Mes Albums</h2>
        </div>
        <div class="h-1/2 flex flex-wrap">
            <h2>Album liker</h2>
            <section class="mov_area flex flex-wrap gap-[25px]">
            </section>

        </div>

    </div>
</div>

<script>
    let listMovPop = fetch('https://api.themoviedb.org/3/movie/movie_id=1?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
    console.log("listMovPop")
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
</script>