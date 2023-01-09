<?php

require_once 'Connection.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] === '') {
    header('Location: login.php');
}

require 'doctype.template.php';
require 'Header.template.php';


?>

    <div class="h-full block text-white w-full xl:flex">
    <div class="w-full h-auto xl:w-1/4 xl:h-screen xl:fixed flex flex-col text-center p-[1.5rem] bg-slate-800 pt-20">
        <iconify-icon icon="iconoir:profile-circled" class="justify-center flex text-[150px]"></iconify-icon>
        <?php
        echo '<h1>' . $_SESSION['user']['pseudo'] . ' ' . '</h1>';
        echo '<h3>' . $_SESSION['user']['email'] . ' ' . '</h3>';
        echo '<h3>' . $_SESSION['user']['id'] . ' ' . '</h3>';
        ?>
    </div> -->
    <div class="block w-[70%] ml-[30%]">
    </div>
        <div class="block pt-20 xl:ml-[25%]">

        <div class="pb-[20px] items-center flex flex-col w-full ">
            <h2>Dernier Visionnage</h2>
            <section class=" block xl:flex gap-5 items-center  see_area  m-auto xl:m-0 ">

            </section>
            <a href="album.php?names=see">Voir Plus</a>
        </div>


        <div class="pb-[20px] items-center flex flex-col w-full ">
            <h2>Film à voir</h2>

            <section class=" block xl:flex gap-[25px] items-center m-auto  xl:-m-0 dream_area  flex-wrap">


            </section>
            <a href="album.php?names=dream">Voir Plus</a>

        </div>

        <div class="pb-4  overscroll-y-hidden items-center flex flex-col" >
            <h2>Mes Albums</h2>
            <?php

            $connection = new connection();
            $Myalbums = $connection->getmyalbum();
            echo '<ul>';
            echo '<script> var a = 0; var Myalbumcontent = 0;</script>';
            foreach($Myalbums as $Myalbum){
                echo '<br>';
                echo '<h3 class=" ' . $Myalbum['album_name'] . ' ">' . $Myalbum['album_name'] . '</h3>';
                $connection = new connection();
                $Myalbumcontents = $connection->getalbumcontent($Myalbum['album_name']);
                
                foreach($Myalbumcontents as $Myalbumcontent){
                    echo '<br>';
                    echo '<h3>' . $Myalbumcontent['album_content'] . '</h3>';
                    $a = $Myalbumcontent['album_content'];
                    echo '<script> console.log("' . $a . '") 
                    a = ' . $a . '
                    </script>';
                    ?><script> 
                    console.log(a);
                    Myalbumcontent = fetch('https://api.themoviedb.org/3/movie/' + a + '?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
                    Myalbumcontent.then(function (response) {
                        return response.json();
                        }).then(function (data) {
                        console.log(data);
                        // document.querySelector('.mov_area').innerHTML = '';
                        // document.querySelector('.li_page_n').innerHTML = p ;
                        // console.log('cas 3')
                        // for (let i = 0; i < data.results.length; i++) {
                        //     let div = document.createElement('div')
                        //     div.innerHTML = `<h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p>`
                        //     document.querySelector('.mov_area').appendChild(div)
                        // }
                    });
                    </script>
                    <?php
                    echo '<br>'
                    
                    ?>
                    <!-- <script>
                        a = "' . $a . '";
                    console.log(a);
                    console.log(typeof a);
                    
                    console.log(String(a).chartAt(0));
                    b= a.split(',');
                    console.log(b);
                    console.log(typeof b);
                        c = b.charAt(0);
                    console.log(c);
                    if (b.charAt(0) = ",") {
                        c = b.slice(1);
                        console.log(c);
                    };
                        if ("' . $a . '".startsWith(',') ) {
                        a = "' . $a . '".slice(1);
                        console.log(a);
                        console.log("prout");
                    } else {
                        console.log("prout2");
                    };
                        if ("' . $a . '".startsWith(',') ) {
                        a = "' . $a . '".slice(1);
                        b= a.split(',');
                        c= a.map(x => x.trim());
                        console.log(c);
                        d= a.map(x => parseInt(x.trim()));
                        console.log(d);
                        console.log("prout");
                    } else {
                        b= "' . $a . '".split(',');
                        c= a.map(x => x.trim());
                        console.log(c);
                        d= a.map(x => parseInt(x.trim()));
                        console.log(d);
                    };
                        const str = $a ;

                        // Utiliser la méthode split() pour séparer la chaîne en un tableau en utilisant la virgule comme séparateur
                        const arr = str.split(',');

                        // Utiliser la méthode map() pour appliquer une fonction à chaque élément du tableau et renvoyer un nouveau tableau
                        const numArr = arr.map(x => x.trim());

                        console.log(numArr); // ['85124', '156984', '556']
                    </script> -->
                    
                    <?php
                }
                echo '<br>';
            }
            echo '</ul>';
            ?>
        </div>
        <!-- <section class="album-pop-up hidden">
            <div id="overlay"></div> -->
        <!-- <section class="album-pop-up">
            <?php
            // $connection = new connection();
            // $Myalbumcontents = $connection->getalbumcontent($Myalbum['album_name']);
            // foreach($Myalbumcontents as $Myalbumcontent){
            //     echo '<br>';
            //     echo '<h3>' . $Myalbumcontent['album_content'] . '</h3>';
            //     echo '<br>';
            // }
            ?>
        </section> -->
        <div class="pb-4">
            <h2>Album liker</h2>
            <!-- <section class="flex flex-wrap gap-[25px]  wrap"> -->
            <section class=" xl:h-[260px] block xl:flex gap-5 wrap align-center  album_area  m-auto xl:m-0 " id="1">

            </section>
            <button onclick="upheight(1)">Voir plus D'album</button>
        </div>
        <div class="pb-4 overscroll-y-hidden items-center flex flex-col" >
            <h2>Album liker</h2>
            <section class=" xl:h-[260px] block xl:flex gap-5 wrap align-center  like_area  m-auto xl:m-0 " id="2">
            </section>
            <button onclick="upheight(1)">Voir plus D'album</button>

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
    let overlay = document.querySelector('#overlay')
    overlay.addEventListener('click', function () {
        document.querySelector('.pop-up').classList.add('hidden')
    })

    // let listMovPop = fetch('https://api.themoviedb.org/3/movie/movie_id=1?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
    // console.log("listMovPop")
    // listMovPop.then(function (response) {
    //     return response.json();
    // }).then(function (data) {
    //     console.log(data);
    //     for (let i = 0; i < data.results.length; i++) {
    //             let div = document.createElement('div')
    //             div.innerHTML = `<h2>${data.results[i].title}</h2><img src="https://image.tmdb.org/t/p/original${data.results[i].poster_path}"><p>${data.results[i].overview}</p>`
    //             document.querySelector('.mov_area').appendChild(div)
    //         }

    // });
</script>
<!-- const str = ',85124, 156984, 556';

// Utiliser la méthode split() pour séparer la chaîne en un tableau en utilisant la virgule comme séparateur
const arr = str.split(',');

// Utiliser la méthode map() pour appliquer une fonction à chaque élément du tableau et renvoyer un nouveau tableau
const numArr = arr.map(x => x.trim());

console.log(numArr); // ['85124', '156984', '556'] -->
    <script src="script.js"></script>

<?php

/**
 * @param mixed $movie
 * @param string $class
 * @return void
 */
function getStr(mixed $movie, string $class): void
{
    echo "<script> 
    var filmvue;
    
        filmvue = " . implode('', $movie) . ";
        
        
                        listMovPop = fetch('https://api.themoviedb.org/3/movie/'+ filmvue +'?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
    console . log('listMovPop')
    
    listMovPop . then(function (response) {
        return response . json();
    }) . then(function (data) {
        console . log(data);
        let div = document . createElement('div')
        div . innerHTML = `<div class=' w-[250px] p-6 flex flex-col items-center  m-auto xl:m-0 '><h2 class='text-[0.8rem]'>" . '${data.original_title}' . "</h2><img class='w-[100px] h-[150px]' src='https://image.tmdb.org/t/p/original" . '${data . poster_path}' . "'></div>
        `
        document . querySelector('" . $class . "') . appendChild(div)
        


    });

                </script > ";
}

function getMovieS(string $class): void
{
    $query = new Connection();
    $lastsee = $query->GMovieS($_SESSION['id']);

    foreach ($lastsee as $movie) {
        getStr($movie, $class);
    }
}

function getMovieD(string $class): void
{
    $query = new Connection();
    $lastsee = $query->GMovieD($_SESSION['id']);

    foreach ($lastsee as $movie) {
        getStr($movie, $class);
    }
}

getMovieS('.see_area');

getMovieD('.dream_area');



        function Writealbum($movie , $class , $id , $name){

            echo "<script> 
    var filmvue;
    
        filmvue = " . implode('', $movie) . ";
        
        
                        listMovPop = fetch('https://api.themoviedb.org/3/movie/'+ filmvue +'?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
    console . log('listMovPop')
    
    listMovPop . then(function (response) {
        return response . json();
    }) . then(function (data) {
        console . log(data);
        let div = document . createElement('div')
        div . innerHTML = `<a href='album.php?names=album&ids=".$id."'><div class=' w-[250px] p-6 flex flex-col items-center  m-auto xl:m-0 '><h2 class='text-[0.8rem]'>" . $name. "</h2><img class='w-[100px] h-[150px]' src='https://image.tmdb.org/t/p/original" . '${data . poster_path}' . "'></div></a>
        `
        document . querySelector('". $class ."') . appendChild(div)
        


    });

                </script > ";

}

function getAlbum(string $class): void
{
    $query = new Connection();
    $lastsee = $query->GAlbumid($_SESSION['id']);
    foreach ($lastsee as $albumid) {
        $album = $query->GAlbum($albumid['album_id']);
        foreach ($album as $Amovie) {
            $movie = $query->GMovie($Amovie['album_id']);
            foreach ($movie as $mov) {
                Writealbum($mov, $class , $Amovie['album_id'] , $Amovie['album_name']);
            }
        }
    }
}
getAlbum('.album_area');


function getAlbumL(string $class): void
{
    $query = new Connection();
    $lastsee = $query->GAlbumLid($_SESSION['id']);
    foreach ($lastsee as $albumid) {
        $album = $query->GAlbum($albumid['album_id']);
        foreach ($album as $Amovie) {
            $movie = $query->GMovie($Amovie['album_id']);
            foreach ($movie as $mov) {
                Writealbum($mov, $class , $Amovie['album_id'] , $Amovie['album_name']);
            }
        }
    }
}
getAlbumL('.like_area');







