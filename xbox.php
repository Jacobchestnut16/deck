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
                url: 'launch_game.php',
                type: 'POST',
                data: { exe_path: exePath },
                success: function(response) {
                    alert(response);
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
                    var gamesDiv = $('#games');
                    gamesDiv.empty();
                    data.forEach(function(game) {
                        var gameDiv = $('<div class="game"></div>');
                        var gameLogo = $('<img>').attr('src', game.logo_path);
                        var gameName = $('<div></div>').text(game.name);
                        var launchButton = $('<button>Launch</button>').on('click', function() {
                            launchGame(game.exe_path);
                        });
                        gameDiv.append(gameLogo, gameName, launchButton);
                        gamesDiv.append(gameDiv);
                    });
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
</body>
</html>
