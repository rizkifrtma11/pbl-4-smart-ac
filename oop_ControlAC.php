<?php

class ControlAC {
    private $currentTemperature;
    private $isSwingOn;
    private $isPowerOn;

    public function __construct() {
        $this->currentTemperature = 19; // Default temperature value
        $this->isSwingOn = true; // Default swing state
        $this->isPowerOn = false; // Default power state
    }

    public function increaseTemperature() {
        $this->currentTemperature = min(27, $this->currentTemperature + 1);
    }

    public function decreaseTemperature() {
        $this->currentTemperature = max(16, $this->currentTemperature - 1);
    }

    public function toggleSwing() {
        $this->isSwingOn = !$this->isSwingOn;
    }

    public function togglePower() {
        $this->isPowerOn = !$this->isPowerOn;
    }

    public function getCurrentTemperature() {
        return $this->currentTemperature;
    }

    public function isSwingOn() {
        return $this->isSwingOn;
    }

    public function isPowerOn() {
        return $this->isPowerOn;
    }
}

// Membuat objek ControlAC
$acController = new ControlAC();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Page Title</title>
    <!-- Add Bootstrap v5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Add your custom CSS if needed -->
    <link rel="stylesheet" href="your-custom-styles.css">
    <style>
        /* Custom CSS for button styling
        .btn-lg {
            padding: 1.5rem 3rem; /* Adjust the padding as needed *
            font-size: 1.5rem; /* Adjust the font size as needed *
        } */
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="container p-3">
        <!-- Your existing HTML code goes here -->
        <div class="row">
            <div class="col-md border border-5 border-dark p-2">
                <div id="DisplayClock" class="clock" onload="showTime()"></div>
                <center><h4 id="temperatureDisplay"><?= $acController->getCurrentTemperature() ?> <sup>o</sup>C</h4></center>
                <div>Fan Speed&nbsp;&nbsp;&nbsp;IIIII <span id="swingStatus" class="float-end"><?= $acController->isSwingOn() ? 'Swing On' : 'Swing Off' ?></span></div>
            </div>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-md">
                <p>Power</p>
                <button id="powerButton" class="btn btn-primary btn-lg <?= $acController->isPowerOn() ? 'on' : '' ?>"><i class="fa-solid fa-power-off fa-xl"></i></button>
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md">
                <p>Mode Auto</p>
                <button class="btn btn-secondary"><i class="fa-solid fa-robot" style="color: #000000;"></i></button>
            </div>
            <div class="col-md">
                <p>Mode Manual</p>
                <button class="btn btn-secondary"><i class="fa-solid fa-user" style="color: #000000;"></i></button>
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md">
                <p>Temperature</p>
                <button id="increaseTempButton" class="btn btn-success"><i class="fa-solid fa-plus" style="color: #000000;"></i></button>
            </div>
            <div class="col-md">
                <p>Temperature</p>
                <button id="decreaseTempButton" class="btn btn-danger"><i class="fa-solid fa-minus" style="color: #000000;"></i></button>
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-md">
                <p>Swing</p>
                <button id="swingButton" class="btn btn-info"><i class="fa-solid fa-wind" style="color: #000000;"></i></button>
            </div>
            <div class="col-md">
                <p>Fan Speed</p>
                <button class="btn btn-warning"><i class="fa-solid fa-fan" style="color: #000000;"></i></button>
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
        const swingButton = document.getElementById('swingButton');
        const swingStatus = document.getElementById('swingStatus');

        increaseTempButton.addEventListener('click', function() {
            // Increase temperature by 1 within the range [16, 27]
            <?= $acController->increaseTemperature() ?>;
            updateTemperatureDisplay();
        });

        decreaseTempButton.addEventListener('click', function() {
            // Decrease temperature by 1 within the range [16, 27]
            <?= $acController->decreaseTemperature() ?>;
            updateTemperatureDisplay();
        });

        swingButton.addEventListener('click', function() {
            // Toggle the swing state and update the text accordingly
            <?= $acController->toggleSwing() ?>;
            updateSwingDisplay();
        });

        powerButton.addEventListener('click', function() {
            // Toggle the power state and change button color accordingly
            <?= $acController->togglePower() ?>;
            powerButton.classList.toggle('on');
            powerButton.classList.toggle('btn-success');
            powerButton.classList.toggle('btn-danger');
        });

        function updateTemperatureDisplay() {
            // Update the temperature display in the center
            temperatureDisplay.innerHTML = <?= $acController->getCurrentTemperature() ?> + ' <sup>o</sup>C';
        }

        function updateSwingDisplay() {
            // Update the swing display in the center
            const swingText = <?= $acController->isSwingOn() ? "'Swing On'" : "'Swing Off'" ?>;
            swingStatus.innerText = swingText;
        }
    });
</script>

<?php
include("dashb_footer.php")
?>

<!-- Add Bootstrap v5.3 JavaScript and Popper.js (dependency) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eZCrmgjN1gSoy3m3UomF72dKg5Pz9t54LrZ+Z+q9s9bVrd+N/6Y2Gw+KGvmF2Zx" crossorigin="anonymous"></script>

</body>
</html>
