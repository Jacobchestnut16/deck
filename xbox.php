<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xbox Games</title>
    <style>
        .game {
            display: inline-block;
            width: 150px;
            margin: 10px;
            text-align: center;
        }
        .game img {
            width: 100px;
            height: 100px;
        }
        .game button {
            margin-top: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function launchGame(exePath) {
            $.ajax({
                url: 'BackEnd/launch_game.php',
                type: 'POST',
                data: { exe_path: exePath },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error launching game:', error);
                }
            });
        }


        $(document).ready(function() {
            $.ajax({
                url: 'BackEnd/get_games.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var gameTable = $('#gameTable');
                    var gameRow = $('<tr></tr>');
                    data.forEach(function(game, index) {
                        if (index % 4 === 0 && index !== 0) {
                            gameTable.append(gameRow);
                            gameRow = $('<tr></tr>');
                        }

                        var gameCell = $('<td></td>');
                        var gameDiv = $('<div></div>');
                        var gameLink = $('<a></a>').attr('href', '#').attr('onclick', 'launchGame("' + game.exe_path + '"); return false;');
                        var gameLogo = $('<img>').attr('src', game.logo_path);
                        var gameName = $('<p></p>').text(game.name);

                        gameLink.append(gameLogo);
                        gameLink.append(gameName);
                        gameDiv.append(gameLink);
                        gameCell.append(gameDiv);
                        gameRow.append(gameCell);
                    });
                    gameTable.append(gameRow); // Append the last row if it wasn't appended yet
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching games:', error);
                }
            });
        });
    </script>
</head>
<body>
<h1>Xbox Games</h1>
<div id="games"></div>
<table id="gameTable">
    <tr>
        <td><a href="index.html">Return</a></td>
    </tr>
</table>


<div class="sleep">
    <a href="BackEnd/sleep.php">
        <img src="imgs/sleep.png" alt="">
        <p>Sleep</p>
    </a>
</div>
<div class="admin">
    <a href="#">
        <img src="imgs/administrators-11.png" alt="">
        <p>Settings</p>
    </a>
</div>
<input type="range" id="volumeSlider" min="0" max="100" value="50.5" step="1" class="volume">
<div class="widget">
    <table>
        <tr>
            <td>
                <div class="DateTime">
                    <table>
                        <tr>
                            <td><div class="data" id="time">MMMM DD, yyyy</div></td>
                            <td><div class="data" id="date">hh:mm aa</div></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>
<script>
    function setTimeDate() {
        const date = new Date();

        const dateOptions = { month: 'long', day: '2-digit', year: 'numeric' };
        const formattedDate = date.toLocaleDateString('en-US', dateOptions);

        const timeOptions = { hour: '2-digit', minute: '2-digit', hour12: true };
        const formattedTime = date.toLocaleTimeString('en-US', timeOptions);

        document.getElementById('time').innerText = `${formattedTime}`;
        document.getElementById('date').innerText = `${formattedDate}`;
    }
    setTimeDate()
    setInterval(setTimeDate, 1500)
</script>
<div id="blackout" class="blackout"></div>
<script>
    let timeout;

    function showBlackout() {
        document.getElementById('blackout').classList.add('active');
    }

    function hideBlackout() {
        document.getElementById('blackout').classList.remove('active');
    }

    function resetTimer() {
        clearTimeout(timeout);
        hideBlackout();
        timeout = setTimeout(showBlackout, 3600000); // 1 hour = 3600000 milliseconds
    }

    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onkeypress = resetTimer;
    window.ontouchstart = resetTimer; // For touch devices
</script>
<style>
    .widget * {
        color: whitesmoke;
    }
    .widget{
        position: absolute;
        bottom: 10px;
        left: 10px;
        width: 300px;
        /*border: green 1px solid;*/
        max-height: 15%;
    }
    .widget table{
        position: relative;
        top: 0;
        right: 0;
        width: 100%;
    }
    .widget table tr {
        width: 100%;
    }
    .volume {
        width: 400px;  /* Adjust width to your preference */
        height: 25px;  /* Adjust height to your preference */
        position: absolute;
        right: 145px;
        top: 25px;
        transform-origin: top right;
        transform: rotate(270deg);
        border-radius: 15px;  /* Adjust border radius as needed */
    }
    .sleep{
        background: slategray;
        width: 65px;
        height: 65px;
        margin: 15px;
        position: absolute;
        right: 10px;
        top: 50px;
    }
    .sleep a img{
        width: 40px;
        position: relative;
        margin-left: 10px;
    }
    .sleep a p{
        color: black;
        margin: auto 0;
        text-align: center;
    }
    .lock{
        background: slategray;
        width: 65px;
        height: 65px;
        margin: 15px;
        position: absolute;
        right: 10px;
        top: 120px;
    }
    .lock a img{
        width: 41px;
        position: relative;
        margin-left: 12px;
    }
    .lock a p{
        color: black;
        margin: auto 0;
        text-align: center;
        padding-bottom: 10px;
    }
    .admin{
        background: slategray;
        width: 65px;
        height: 65px;
        margin: 15px;
        position: absolute;
        right: 10px;
        top: 190px;
    }
    .admin a img{
        width: 41px;
        position: relative;
        margin-left: 12px;
    }
    .admin a p{
        color: black;
        margin: auto 0;
        text-align: center;
        padding-bottom: 10px;
    }

    *{
        overflow: hidden;

    }
    a{
        text-decoration: none;
        color: slategray;
        font-family: Rubik;
        font-size: medium;
    }
    body{
        width: 100%;
        background: url("imgs/Untitled_Artwork.png");
        background-repeat: no-repeat;
        background-color: black;
    }
    tr{
        width: 100%;
    }
    tr td{
        width: 100px;
        background-color: rgba(0,0,0,15%);
    }
    tr td div{
        width: 100%;
    }
    tr td div a img{
        width: 70px;
        position: relative;
        margin: 15px;
    }
    tr td div a p{
        margin: auto 0;
        text-align: center;
    }

    </style>
</body>
</html>
