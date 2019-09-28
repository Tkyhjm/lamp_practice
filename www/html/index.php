<?php

// [[ 商品一覧画面表示ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/item.php';

session_start();

// ログイン状態でなければ、ログイン画面にリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

// db設定を変数に代入
$db = get_db_connect();

// ユーザー情報を変数に代入
$user = get_login_user($db);

// 公開されている商品の一覧を、配列変数に代入
$items = get_open_items($db);

// viewファイルの読み込み
include_once '../view/index_view.php';