<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt_key'] = "QWasdazxcERTcvbfghIOPIObnmyhfcvrfdxzcaweqweruiyCDBjiouyrewghjfvdfvjklnrtopiu";

$config['jwt_algorithm'] = "HS256";

$config['token_header']  = "authorization";  // receive roken in authorization

$config['token_expire_time'] = 300; // time in seconds 