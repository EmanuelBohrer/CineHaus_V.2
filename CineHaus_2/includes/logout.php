<?php

session_start();
session_unset();
session_destroy();
header("Location:/CineHaus/login/index.php");