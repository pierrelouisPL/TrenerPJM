<html>
<head>
    <title> TrenerPJM </title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='http://fonts.googleapis.com/css?family=Basic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
</head>

<body>

<?php

$listpath = $_REQUEST['directorypath'];


$lines = file($listpath);

$words = array();
$iterator = 0;

foreach ($lines as $line) {
    $firstAddressLetterIndex =  strpos($line, "http://");
    $words[$iterator][0] = substr($line, 0, $firstAddressLetterIndex);
    $words[$iterator][1] = substr($line, $firstAddressLetterIndex);
    $iterator++;

}

?>

<!-- /////////////////////////////////////////// HTML /////////////////////////////////////////////////////////// -->


<div id="topMenu">
    <div id="topLogo">
        <p class="topLogoText">TrenerPJM</p>
    </div>

    <div id="backToMenu">
        <a class="backToMenuLink" href="index.php">
            <img src="back-icon.png" class="backToMenuIcon">
        </a>
    </div>

    <div id="toInfoPage">
        <a class="infoPageLink" href="info.php">
            <img src="info-icon.png" class="infoPageIcon">
        </a>
    </div>
</div>


<div id="mainBox">

    <div class="box" id="topBox">

        <iframe id="displayedMeaning" src="" class="videoBox"></iframe>

    </div>

    <div class="box" id="bottomBox">

        <!-- word you're interested in -->
        <div class="word" id="displayedWordBox">
            <p id="displayedWord"></p>
        </div>



        <div class="buttons" id="buttonBox">
            <!-- THIS IS THE BUTTON U CLICK TO CHECK THE MEANING -->
            <button class="button" id="checkMeaningButton"> Sprawdź </button>
            <!-- next word buttons -->
            <button class="button" id="iKnowButton"> Znam </button>
            <button class="button" id="dunnoButton"> Nie znam </button>
        </div>


    </div>



</div>

<!--
<div id="footer">
    <p id="signature">Piotr Śmieja, 2018</p>
    <p id="aboutFilms1">
    </p>
    <p id="aboutFilms2">
        <b>Nagrania</b>:
        Joanna Łacheta, Małgorzata Czajkowska-Kisil,
        Jadwiga Linde-Usiekniewicz, Paweł Rutkowski (red.), 2016, <i>Korpusowy słownik polskiego języka migowego</i>,
        Warszawa: Wydział Polonistyki Uniwersytetu Warszawskiego, ISBN: 978-83-64111-49-5 (publikacja online).
    </p>
</div>

-->

<!-- ///////////////////////////////////////// JAVASCRIPT //////////////////////////////////////////////////////// -->

<script> //js script used to display words
    //script uses a php array $words
    var words = <?php echo json_encode($words); ?>;
    var maxValue = words.length - 1;
    var presentWordIndex /*= Math.floor((Math.random() * maxValue))*/;
    var pastWordIndex;

    document.getElementById("iKnowButton").addEventListener("click", iKnow);
    document.getElementById("dunnoButton").addEventListener("click", dunno);

    document.addEventListener("DOMContentLoaded", initiate);

    document.getElementById("checkMeaningButton").addEventListener("click", displayMeaning)

    function dunno() {
        clearVideoSrc();
        updateWordIndexWithoutDeleting();
    }

    function iKnow () {
        clearVideoSrc(); //so that no video is displayed as a meaning

        if (words.length > 1)
            updateWordIndex();
        else {
            //TODO popup window
            document.getElementById('displayedWord').innerHTML = "KONIEC SŁÓW!!!";
        }
    }

    function initiate() {
        updateWordIndexWithoutDeleting();
    }

    function displayMeaning() {
        document.getElementById('displayedMeaning').src = words[presentWordIndex][1];
    }

    function updateWordIndexWithoutDeleting() {
        assignRandomWordIndex();
        document.getElementById('displayedWord').innerHTML = words[presentWordIndex][0];
    }

    function updateWordIndex() {
        pastWordIndex = presentWordIndex;
        words.splice(pastWordIndex,1);
        assignRandomWordIndex();
        document.getElementById('displayedWord').innerHTML = words[presentWordIndex][0];
    }

    function assignRandomWordIndex() {
        maxValue = words.length - 1;
        presentWordIndex = Math.floor((Math.random() * maxValue));
    }

    function clearVideoSrc() {
        document.getElementById('displayedMeaning').src = "blankPage.html";
    }
    /*
    function showVideo() {
        window.open(words[presentWordIndex][1]);
    }
    */

</script>




</body>
</html>