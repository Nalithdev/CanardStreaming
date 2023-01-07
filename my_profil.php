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
    <!-- <div class=" user h-full flex flex-col text-center bg-slate-800">
        <img class="w-2/5 m-auto mb-1 mt-0 " src="img/user_icon.webp">
        <?php
        // echo '<h1>' . $_SESSION['user']['pseudo'] . ' ' . '</h1>';
        // echo '<h3>' . $_SESSION['user']['email'] . ' ' . '</h3>';
        // echo '<h3>' . $_SESSION['user']['id'] . ' ' . '</h3>';
        ?>
    </div> -->
    <div class="block w-[70%] ml-[30%]">
    <?php
        echo '<h1>' . $_SESSION['user']['pseudo'] . ' ' . '</h1>';
        echo '<h3>' . $_SESSION['user']['email'] . ' ' . '</h3>';
        echo '<h3>' . $_SESSION['user']['id'] . ' ' . '</h3>';
        ?>
        <div class="h-1/2 flex flex-wrap">
            <h2>Mes Albums</h2>
            <?php
            $connection = new connection();
            $Myalbums = $connection->getmyalbum();
            echo '<ul>';
            foreach($Myalbums as $Myalbum){
                echo '<br>';
                echo '<h3>' . $Myalbum['album_name'] . '</h3>';
                echo '<br>';
            }
            echo '</ul>';
            ?>
        </div>
        <div class="h-1/2 flex flex-wrap">
            <h2>Album liker</h2>
            <section class="mov_area flex flex-wrap gap-[25px]">
            </section>

        </div>
        <div>
            <button class="btform bg-slate-600"->Crée un album</button>
        </div>

    </div>
</div>
<section class="pop-up hidden">
    <div id="overlay"></div>
    <form method="POST" class="bg-white z-50 absolute top-96 left-96 w-52 h-48">
        <label for="album_name">Nom: </label>
        <input type="text" name="album_name" id="album_name" placeholder="nom album">

        <label for="private">Type</label><br>
        <input type="radio" id="public" name="private" value="0">Public
        <input type="radio" id="prive" name="private" value="1">Priver
        <br>

        
        <button class=" bg-neutral-300" type="submit">Crée</button>
    </form>
</section>

<?php 
    if ($_POST){
    $connection = new Connection();
    $connection->creataalbum($_POST['album_name'], $_POST['private']);
    }
?>

<script>
    let CreeAlbum = document.querySelector('.btform')
    CreeAlbum.addEventListener('click', function () {
        document.querySelector('.pop-up').classList.remove('hidden')
    })      


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