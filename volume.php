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

            function fetchInitialVolume() {
                $.ajax({
                    url: 'BackEnd/get_volume.php',  // Replace with your PHP script path
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Received data:', data);
                        // Update slider value based on fetched volume
                        var ret = data.volume*100
                        console.log(ret + "this is my fetch");
                        document.getElementById('volumeSlider').value = ret;  // Assuming volume is normalized (0.0 to 1.0)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching initial volume:', error);
                    }
                });
            }

            // Call fetchInitialVolume when the document is ready
            fetchInitialVolume();

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

<input type="range" id="volumeSlider" min="0" max="100" value="50.5" step="1" >
</body>
</html>
