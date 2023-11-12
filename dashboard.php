<?php
include("dashb_header.php")
?>

<div class="container-fluid">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md">
                <h3>Welcome to Smart AC system</h3>
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
                <h5>Power :</h5>
                <p>On</p>
            </div>
            <div class="col-md mb-3">
                <i class="fa-regular fa-snowflake fa-2xl"></i>
                <h5>Temperature :</h5>
                <p>19<sup>o</sup> C</p>
            </div>
            <div class="col-md">
                <i class="fa-solid fa-fan fa-2xl" style="color: #000000;"></i>
                <h5>Fan Speed :</h5>
                <p>IIIIIIIII</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md">
                <h5>System Uptime : </h5>
                <p>01 : 29 : 30</p>
            </div>
            <p style="color: red;">Note. Dummy data</p>
        </div>
    </div>
</div>

<?php
include("dashb_footer.php")
?>