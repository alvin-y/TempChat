<?php

//resetChat.php
session_start();

session_destroy();
header("Location: namePage.php");

?>