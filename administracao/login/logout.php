<?php
session_start();

unset($_SESSION['validacao']);
unset($_POST['usuario']);
unset($_POST['senha']);

header("Location: /");