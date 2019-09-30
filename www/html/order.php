<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'order.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

// 管理ユーザーであれば、全件履歴表示
if(is_admin($user)){
  $orders = get_orders($db);
} else {
  // 管理ユーザーでなければ、ログインユーザーの履歴のみ表示
  $orders = get_user_orders($db, $user['user_id']);
}


include_once '../view/order_view.php';