<?php 
// 関数ファイルとDBファイルの読み込み
require_once 'functions.php';
require_once 'db.php';

// ordersテーブルに購入履歴を追加する
function insert_order($db, $user_id, $total_price){
    $sql = "
      INSERT INTO
        orders(
          user_id,
          total_price
        )
      VALUES(?, ?)
    ";

    $params = [$user_id, $total_price];
  
    // クエリ実行結果を返す
    return execute_query($db, $sql, $params);
}

// order_detailsテーブルに購入明細履歴を追加する
function insert_order_details($db, $price, $amount, $item_id, $order_id){
    $sql = "
      INSERT INTO
        order_details(
          price,
          amount,
          item_id,
          order_id
        )
      VALUES(?, ?, ?, ?)
    ";

    $params = [$price, $amount, $item_id, $order_id];
  
    // クエリ実行結果を返す
    return execute_query($db, $sql, $params);
}

// ログインユーザーorderテーブル一覧表示
function get_orders($db){
  $sql = "
  SELECT
    order_id,
    purchase_datetime,
    total_price,
    user_id
  FROM
    orders
  ORDER BY
    purchase_datetime DESC
";

// クエリ実行結果を返す
return fetch_all_query($db, $sql);
}

// ログインユーザーorderテーブル一覧表示
function get_user_orders($db, $user_id){
    $sql = "
    SELECT
      order_id,
      purchase_datetime,
      total_price,
      user_id
    FROM
      orders
    WHERE
      user_id = ?
    ORDER BY
      purchase_datetime DESC
  ";

  $params[] = $user_id;

  // クエリ実行結果を返す
  return fetch_all_query($db, $sql, $params);
}

// ログインユーザーorder1件表示
function get_order($db, $order_id){
    $sql = "
    SELECT
      order_id,
      purchase_datetime,
      total_price,
      user_id
    FROM
      orders
    WHERE
      order_id = ?
  ";

  $params[] = $order_id;

  // クエリ実行結果を返す
  return fetch_query($db, $sql, $params);

}

// オーダー明細情報取得
function get_order_details($db, $order_id){
    $sql = "
      SELECT
        items.name,
        order_details.price,
        order_details.amount
      FROM
        order_details
      JOIN
        items
      ON
        order_details.item_id = items.item_id
      WHERE
        order_details.order_id = ?
    ";

$params[] = $order_id;

    // クエリ実行結果を返す
    return fetch_all_query($db, $sql, $params);
  }