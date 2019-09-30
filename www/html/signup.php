<?php

// [[ ユーザー登録ページの表示ページ ]]


// 定数ファイル＆関数ファイルの読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

session_start();

// ログイン状態であれば、商品一覧ページへリダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}

// viewファイルの読み込み
include_once '../view/signup_view.php';



