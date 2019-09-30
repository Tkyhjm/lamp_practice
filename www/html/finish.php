<?php

// [[ 購入結果画面の表示ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

// ログイン状態でなければ、ログインページへリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

// db設定を変数に代入
$db = get_db_connect();

// ユーザー情報を変数に代入
$user = get_login_user($db);

// ログインユーザーのcartsテーブル内の情報を取得
$carts = get_user_carts($db, $user['user_id']);

// 在庫数の変更とcartsテーブル内の商品情報を削除。falseの場合はエラーメッセージを
// セッションにセットしてカート画面にリダイレクト
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 

// 合計価格
$total_price = sum_carts($carts);

// viewファイルの読み込み
include_once '../view/finish_view.php';