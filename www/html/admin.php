<?php

// [[ 管理ページ表示時のページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

// ログイン状態でなければ、ログインページへリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

// db設定を変数に代入
$db = get_db_connect();

// ユーザー情報を変数に代入
$user = get_login_user($db);

// 管理ユーザーでなければ、ログイン画面へリダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

// 全商品データを配列として格納
$items = get_all_items($db);

// viewファイルの読み込み
include_once '../view/admin_view.php';
