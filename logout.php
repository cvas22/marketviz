<?php
//setting a cookie's expiration to a time in the past removes the cookie
setcookie('name',"",strtotime('-1 day'));
setcookie('email',"",strtotime('-1 day'));
setcookie('time',"",strtotime('-1 day'));
setcookie('hash',"",strtotime('-1 day'));
setcookie('id',"",strtotime('-1 day'));
header('location:index.html');
?>