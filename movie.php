<?php

require_once 'Connection.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] === ''){
    header('Location: login.php');
}

require 'doctype.template.php';
require 'Header.template.php';

echo "<script> var film = " .$_GET['ids'] . " 
console.log(film) </script>"
?>
<main class="pt-20">
<div class="h-1/2 p-12">

    <section class="film_area text-white flex flex-row-reverse pb-8">


        <div class="flex flex-col justify-around items-center  w-11/12">
            <?php
            echo'
            
            <p class="bg-slate-700 p-2 pl-4 pr-4 rounded-full">Ajouter à un album </p>';
            $query = new Connection();
            $result = $query -> SfD($_GET['ids'] , $_SESSION['id']);
            if($result){
                echo'
                <form method="POST" action="">
                <input type="hidden" value="' .$_GET['ids'].'" name="id">
                <input type="submit" value="supprimé de la liste de souhait" name="Ddream" class="bg-slate-700 p-2 pl-4 pr-4 rounded-full" >
            </form>';
            }
            else{
                echo'<form method="POST" action="">
                <input type="hidden" value= "' .$_GET['ids'].'" name="id">
                <input type="submit" value="Mettre dans la liste de souhait" name="dream" class="bg-slate-700 p-2 pl-4 pr-4 rounded-full" >
            </form>';
            };
            $query = new Connection();
            $result = $query -> SfS($_GET['ids'] , $_SESSION['id']);
            if($result){
                echo'<form method="POST" action="">
                <input type="hidden" value="' .$_GET['ids'].' " name="id">
                <input type="submit" value="film pas vu" name="Dseen" class="bg-slate-700 p-2 pl-4 pr-4 rounded-full">
            </form>';

            }
            else{
                echo'<form method="POST" action="">
                <input type="hidden" value="' .$_GET['ids'].'" name="id">
                <input type="submit" value="film vue" name="seen" class="bg-slate-700 p-2 pl-4 pr-4 rounded-full">
            </form>';
            }

            ?></div>
    </section>
    <section class="film_areas flex flex-wrap gap-[25px] text-white"> </section>


</div>
</main>
<script>
    let listMovPop = fetch('https://api.themoviedb.org/3/movie/'+ film +'?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
    console.log("listMovPop")
    listMovPop.then(function (response) {
        return response.json();
    }).then(function (data) {
        console.log(data);
        let div = document.createElement('div')
        div.innerHTML = `<div class=" flex w-full flex-col items-center"><h2>${data.original_title}</h2><img class="w-[250px] h-[350px]" src="https://image.tmdb.org/t/p/original${data.poster_path}"><p>${data.overview}</p></div>
        `
        document.querySelector('.film_area').appendChild(div)


    });
    let listact = fetch('https://api.themoviedb.org/3/movie/'+ film +'/credits?api_key=512f0783bae246658f714cd1abc41513&language=en-US')
    console.log("bonjour")
    listact.then(function (response) {
        return response.json();
    }).then(function (data) {
        console.log(data);
        for (let i = 0; i < 6; i++) {
            let div = document.createElement('div')
            div.innerHTML = `<h2>${data.cast[i].name}</h2><img class="w-[200px] h-[300px]" src="https://image.tmdb.org/t/p/original${data.cast[i].profile_path}">`
            document.querySelector('.film_areas').appendChild(div)
        }
    });

</script>

<?php
if ($_POST){
    if(isset($_POST['seen'])){
        $id = $_POST['id'];
        $connection = new Connection();
        $connection -> Newview($id , $_SESSION['id']);
        header("Refresh:0");

    }

    if(isset($_POST['dream'])){
        $id = $_POST['id'];
        $connection = new Connection();
        $connection -> Newdream($id , $_SESSION['id']);
        header("Refresh:0");

    }

    if(isset($_POST['Dseen'])){
        $id = $_POST['id'];
        $connection = new Connection();
        $connection -> Dview($id , $_SESSION['id']);
        header("Refresh:0");

    }

    if(isset($_POST['Ddream'])){
        $id = $_POST['id'];
        $connection = new Connection();
        $connection -> dreamD($id , $_SESSION['id']);
        header("Refresh:0");

    }
}
?>

