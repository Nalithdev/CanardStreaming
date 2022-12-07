<?php

require_once 'Connection.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] === ''){
    header('Location: login.php');
}

require 'doctype.template.php';
require 'Header.template.php';


?>

    <aside>
        <ul>
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
    <main>

        <section class="mov_area">

        </section>

        <ul>
            <li class="li_page" id="2" > << </li>
            <li class="li_page_n"></li>
            <li class="li_page" id="1" > >> </li>
        </ul>

    </main>


<?php
require 'footer.template.php';

