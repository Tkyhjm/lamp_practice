<?php

// [[ ログインのPOST送信時の処理実行ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

// ログイン状態であれば、商品一覧ページへリダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}

// 値がPOSTで送信されていれば、変数に代入
$name = get_post('name');
$password = get_post('password');

// db設定
$db = get_db_connect();

// nameとパスワードを照合＆user_idをセッションにセット。
// 照合が一致しなければ、エラーメッセージをセッションにセットして、ログイン画面にリダイレクト
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}

// メッセージをセッションにセット
set_message('ログインしました。');
// ログインユーザーが管理者であれば、管理ページへリダイレクト
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
// 商品一覧ページへリダイレクト
redirect_to(HOME_URL);