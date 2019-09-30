<?php

// [[ 管理ページで商品在庫数更新のPOSTが送信された際の処理ページ ]]


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

// item_idとstockがPOSTで送信されていれば代入
$item_id = get_post('item_id');
$stock = get_post('stock');

// 在庫のアップデートが実行されたら、メッセージをセッションにセットして管理ページにリダイレクトする
if(update_item_stock($db, $item_id, $stock)){
  set_message('在庫数を変更しました。');
} else {
  set_error('在庫数の変更に失敗しました。');
}

redirect_to(ADMIN_URL);