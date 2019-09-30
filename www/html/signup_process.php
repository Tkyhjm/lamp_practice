<?php

// [[ ユーザー登録のPOST送信時の処理実行ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

// ログイン状態であれば、商品一覧ページへリダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}

// 値がPOSTされていれば、変数に値を代入
$name = get_post('name');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');

// db設定
$db = get_db_connect();

// ユーザー登録処理(insert)。1.バリデーションエラーがでる2.DBの例外エラーが発生で
// エラーメッセージをセッションにセットしてリダイレクト
try{
  $result = regist_user($db, $name, $password, $password_confirmation);
  if( $result=== false){
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  redirect_to(SIGNUP_URL);
}

// ユーザー登録処理が完了したら、メッセージをセッションにセット
set_message('ユーザー登録が完了しました。');
// 名前とパスワードを照合して、user_idをセッションにセット
login_as($db, $name, $password);
// 商品一覧ページへリダイレクト
redirect_to(HOME_URL);