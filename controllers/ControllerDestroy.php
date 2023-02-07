<?php
include "../global_includes/constants.php";
session_start();
session_destroy();
header("Location:".URL_BASE ."admin/login.php");