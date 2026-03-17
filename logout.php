<?php
session_start();
session_destroy();
header( header:"Location: form_login.php");
exit;
