<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
// require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'order.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$order_id = get_post('order_id');

$order = get_order($db, $order_id);

// 管理ユーザーorログインユーザー以外がアクセスした場合、リダイレクト
if(is_admin($user) === false){
    if ($order['user_id'] !== $user['user_id']) {
        set_error('ログインユーザー以外は閲覧できません');
        redirect_to(ORDER_URL);
    }
}


$details = get_order_details($db, $order_id);

include_once '../view/order_detail_view.php';