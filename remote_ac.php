<?php
include("dashb_header.php")
?>

<div class="container-fluid">
    <div class="container p-3">
        <div class="row">
            <div class="col-md border border-5 border-dark p-2">
                <div id="DisplayClock" class="clock" onload="showTime()"></div>
                <center><h4 id="temperatureDisplay">19 <sup>o</sup>C</h4></center>
                <div>Swing On <span class="float-end">Fan Speed |||||</span></div>
            </div>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-md">
                <p>Power</p>
                <button id="powerButton"><i class="fa-solid fa-power-off fa-xl"></i></button>
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md">
                <p>Mode Auto</p>
                <button><i class="fa-solid fa-robot" style="color: #000000;"></i></button>
            </div>
            <div class="col-md">
                <p>Mode Manual</p>
                <button><i class="fa-solid fa-user" style="color: #000000;"></i></button>
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md">
                <p>Temperature</p>
                <button id="increaseTempButton"><i class="fa-solid fa-plus" style="color: #000000;"></i></button>
            </div>
            <div class="col-md">
                <p>Temperature</p>
                <button id="decreaseTempButton"><i class="fa-solid fa-minus" style="color: #000000;"></i></button>
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md">
                <p>Swing</p>
                <button><i class="fa-solid fa-wind" style="color: #000000;"></i></button>
            </div>
            <div class="col-md">
                <p>Fan Speed</p>
                <button><i class="fa-solid fa-fan" style="color: #000000;"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const increaseTempButton = document.getElementById('increaseTempButton');
        const decreaseTempButton = document.getElementById('decreaseTempButton');
        const temperatureDisplay = document.getElementById('temperatureDisplay');
        const powerButton = document.getElementById('powerButton');

        let currentTemperature = 19; // Default temperature value

        increaseTempButton.addEventListener('click', function() {
            // Increase temperature by 1
            currentTemperature += 1;
            updateTemperatureDisplay();
        });

        decreaseTempButton.addEventListener('click', function() {
            // Decrease temperature by 1, minimum temperature is 0 (or any other minimum value)
            currentTemperature = Math.max(0, currentTemperature - 1);
            updateTemperatureDisplay();
        });

        function updateTemperatureDisplay() {
            // Update the temperature display in the center
            temperatureDisplay.innerHTML = currentTemperature + ' <sup>o</sup>C';
        }   
    });
        powerButton.addEventListener('click', function() {
            // Toggle the power state and change button color accordingly
            if (powerButton.classList.contains('on')) {
                // Power is currently on, turn it off
                powerButton.classList.remove('on');
                powerButton.style.color = '#FF0000'; // red
            } else {
                // Power is currently off, turn it on
                powerButton.classList.add('on');
                powerButton.style.color = '#00FF00'; // green
            }
        });
</script>

<?php
include("dashb_footer.php")
?>
