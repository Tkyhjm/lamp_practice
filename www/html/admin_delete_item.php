<?php

// [[ 管理ページで商品削除のPOSTが送信された際の処理ページ ]]


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

// item_idがPOSTされていれば、変数に代入
$item_id = get_post('item_id');

// 商品データ削除処理。true or falseでメッセージをセッションにセットする
if(destroy_item($db, $item_id) === true){
  set_message('商品を削除しました。');
} else {
  set_error('商品削除に失敗しました。');
}


// 管理ページへリダイレクト
redirect_to(ADMIN_URL);