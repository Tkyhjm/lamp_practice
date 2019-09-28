<?php

// [[ ログアウトの実行処理ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

session_start();

// セッションを全て空にする
$_SESSION = array();

// クッキー削除処理
$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000,
  $params["path"], 
  $params["domain"],
  $params["secure"], 
  $params["httponly"]
);
session_destroy();

// ログイン画面へリダレクト
redirect_to(LOGIN_URL);

