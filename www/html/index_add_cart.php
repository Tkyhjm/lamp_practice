<?php

// [[ 商品一覧画面の商品追加のPOSTが送信された際の実行ページ ]]


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

// item_idがPOSTで送信されていれば、変数に代入
$item_id = get_post('item_id');

// 商品追加処理実行。実行結果によって、メッセージをセッションにセットする
if(add_cart($db,$user['user_id'], $item_id)){
  set_message('カートに商品を追加しました。');
} else {
  set_error('カートの更新に失敗しました。');
}

// 商品一覧ページへリダイレクよ
redirect_to(HOME_URL);