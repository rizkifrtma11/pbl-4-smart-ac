<?php

class User {
    private $username;
    private $dashboardTitle;
    private $powerStatus;
    private $temperature;
    private $fanSpeed;
    private $systemUptime;
    private $swingStatus;
    private $mode;
    private $roomTemperature;

    public function __construct($username, $dashboardTitle, $powerStatus, $temperature, $fanSpeed, $systemUptime, $swingStatus, $mode, $roomTemperature) {
        $this->username = $username;
        $this->dashboardTitle = $dashboardTitle;
        $this->powerStatus = $powerStatus;
        $this->temperature = $temperature;
        $this->fanSpeed = $fanSpeed;
        $this->systemUptime = $systemUptime;
        $this->swingStatus = $swingStatus;
        $this->mode = $mode;
        $this->roomTemperature = $roomTemperature;
    }

    public function displayDashboard() {
        include("dashb_header.php");
        
        echo '<div class="container-fluid">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md">
                            <h3>' . $this->dashboardTitle . '</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                                </ol>
                            </nav>
                            <hr>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md pt-3 mb-3">
                            <h1><div id="DisplayClock" class="clock" onload="showTime()"></div></h1>
                        </div>
                        <div class="col-md mb-3">
                            <i class="fa-solid fa-power-off fa-xl"></i>
                            <h5>Power</h5>
                            <p>' . $this->powerStatus . '</p>
                        </div>
                        <div class="col-md mb-3">
                            <i class="fa-regular fa-snowflake fa-2xl"></i>
                            <h5>Temperature</h5>
                            <p>' . $this->temperature . '<sup>o</sup> C</p>
                        </div>
                        <div class="col-md">
                            <i class="fa-solid fa-fan fa-2xl" style="color: #000000;"></i>
                            <h5>Fan Speed</h5>
                            <p>' . $this->fanSpeed . '</p>
                        </div>
                    </div>
                    <div class="row mt-3 text-center">
                        <div class="col-md">
                            <h5>System Uptime : </h5>
                            <p>' . $this->systemUptime . '</p>
                        </div>
                        <div class="col-md">
                            <i class="fa-solid fa-wind fa-xl" style="color: #000000;"></i>
                            <h5>Swing</h5>
                            <p>' . $this->swingStatus . '</p>
                        </div>
                        <div class="col-md">
                            <i class="fa-solid fa-plane-up fa-xl" style="color: #000000;"></i>
                            <h5>Mode</h5>
                            <p>' . $this->mode . '</p>
                        </div>
                        <div class="col-md">
                            <i class="fa-solid fa-temperature-quarter fa-2xl" style="color: #000000;"></i>
                            <h5>Room Temperature</h5>
                            <p>' . $this->roomTemperature . '<sup>o</sup>C</p>
                        </div>
                        <p style="color: red;">Note. Dummy data.</p>
                    </div>
                </div>
            </div>';

        include("dashb_footer.php");
    }

    public function displayUserInfo() {
        echo "<p>Username: " . $this->username . "</p>";
    }
}

// Membuat objek User
$user = new User(
    "john_doe",
    "Selamat Datang di Dashboard SMART AC",
    "On",
    "19",
    "|||||",
    "01 : 29 : 30",
    "On",
    "Automatic",
    "31.23"
);

// Menampilkan informasi pengguna dan dashboard
$user->displayUserInfo();
$user->displayDashboard();
?>
