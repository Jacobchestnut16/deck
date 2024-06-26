<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Volume Control</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to set volume
            function setVolume(volume) {
                $.ajax({
                    url: 'BackEnd/set_volume.php',
                    type: 'POST',
                    data: { volume: volume },
                    success: function(response) {
                        console.log('Volume set:', response);
                        // Update UI or display success message
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to set volume:', error);
                        // Handle error, display error message
                    }
                });
            }

            // Function to get current volume
            function getVolume() {
                $.ajax({
                    url: 'BackEnd/get_volume.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Current volume:', data.volume);
                        // Update UI with current volume (optional)
                        $('#currentVolume').text('Current Volume: ' + data.volume);
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to get volume:', error);
                        // Handle error, display error message
                    }
                });
            }

            // Initial load: Get current volume
            getVolume();

            // Event handler for volume slider change
            $('#volumeSlider').on('input', function() {
                var volume = $(this).val() / 100; // Convert to decimal
                setVolume(volume);
            });
        });
    </script>
</head>
<body>
<h1>Volume Control</h1>
<div id="currentVolume"></div>
<input type="range" id="volumeSlider" min="0" max="100" value="50" step="1">
</body>
</html>
