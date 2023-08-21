<?php

/* System Generated Codes */


/* Password Reset Tokens */
$length = 30;
$tk = substr(str_shuffle("qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $length);

/* System Generated Password Engine */
$length = 8;
$rc = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $length);

/* System Generated IDs & Primar Keys & They Are Hashed */
$length = date('y');
$sys_gen_id = bin2hex(random_bytes($length));
$sys_gen_alt_id = bin2hex(random_bytes($length));


/* System Generated Checksums */
$length = 12;
$checksum = bin2hex(random_bytes($length));

/* System Generated Codes */
$alpha = 5;
$beta = 5;
$a = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM"), 1, $alpha);
$b = substr(str_shuffle("1234567890"), 1, $beta);

/* System Generatd Payment Sandbox Codes */
$alpha = 10;
$paycode = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $alpha);
