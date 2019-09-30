<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴画面</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1 class="text-center">購入履歴画面</h1>

  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <?php if (count($orders) > 0) { ?>
    <table class="table table-bordered">
    <thead class="thead-light">
        <tr>
        <th>注文番号</th>
        <th>購入日時</th>
        <th>合計金額</th>
        <th>購入明細</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($orders as $order){ ?>
        <tr>
        <td><?php print($order['order_id']); ?></td>
        <td><?php print($order['purchase_datetime']); ?></td>
        <td><?php print($order['total_price']); ?>円</td>
        <td>
        <form method="post" action="order_detail.php">
            <input type="hidden" name="order_id" value="<?php print($order['order_id']); ?>">
            <input type="submit" class="btn btn-success" value="購入明細表示">
        </form>
        </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <?php } else { ?>
      <p class="text-center">購入の履歴はありません</p>
    <?php } ?>
  </div>
</body>
</html>