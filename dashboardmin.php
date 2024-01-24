<?php
include("admin_dashb_header.php")
?>

<div class="container-fluid">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md">
                <h3>Dashboard Admin Smart AC</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
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
                <p>On</p>
            </div>
            <div class="col-md mb-3">
                <i class="fa-regular fa-snowflake fa-2xl"></i>
                <h5>Suhu</h5>
                <p>19<sup>o</sup> C</p>
            </div>
            <div class="col-md">
                <i class="fa-solid fa-fan fa-2xl" style="color: #000000;"></i>
                <h5>Kecepatan Kipas</h5>
                <p>|||||</p>
            </div>
        </div>
        <div class="row mt-3 text-center">
            <div class="col-md">
                <h5>System Uptime : </h5>
                <p>01 : 29 : 30</p>
            </div>
            <div class="col-md">
            <i class="fa-solid fa-wind fa-xl" style="color: #000000;"></i>
                <h5>Swing</h5>
                <p>On</p>
            </div>
            <div class="col-md">
                <i class="fa-solid fa-plane-up fa-xl" style="color: #000000;"></i>
                <h5>Mode</h5>
                <p>Automatic</p>
            </div>
            <div class="col-md">
            <i class="fa-solid fa-temperature-quarter fa-2xl" style="color: #000000;"></i>
                <h5>Temperatur Ruangan</h5>
                <p>27.20 <sup>o</sup>C</p>
            </div>
            <p style="color: red;">Note. Dummy data.</p>
        </div>
    </div>
</div>

<?php
include("dashb_footer.php")
?>