<?php

// [[ 管理ページで商品追加のPOSTが送信された際の処理ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

// ユーザーログインされてなければ、ログイン画面へリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
// db設定代入
$db = get_db_connect();

// ユーザー情報取得
$user = get_login_user($db);

// 管理ユーザーでなければログインページへリダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

// それぞれの値がPOSTされていれば、変数に代入する
$name = get_post('name');
$price = get_post('price');
$status = get_post('status');
$stock = get_post('stock');

$image = get_file('image');

// 商品追加処理実行。true or falseの結果によって、メッセージをセッションにセット
if(regist_item($db, $name, $price, $stock, $status, $image)){
  set_message('商品を登録しました。');
}else {
  set_error('商品の登録に失敗しました。');
}

// 管理ページへ戻る
redirect_to(ADMIN_URL);