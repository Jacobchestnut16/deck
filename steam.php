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
                url: 'BackEnd/get_steam_games.php',
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
<h1>Steam Games</h1>
<div id="games"></div>
<table id="gameTable">
    <tr>
        <td><a href="index.html">Return</a></td>
    </tr>
</table>

<style>
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
