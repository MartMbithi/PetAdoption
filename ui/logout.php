<?php
/* Kill All Active Sessions */
session_start();
unset($_SESSION['login_id']);
unset($_SESSION['login_rank']);
session_destroy();
header("Location: ../");
exit;
