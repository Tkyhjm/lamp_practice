<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>

  <div class="container">
  <div class="float-right">
      <form method="get" action="index.php">
        <select name="sort">
          <option value="created" <?php if ($sort === 'created') {print 'selected';} ?>>新着順</option>
          <option value="low_price" <?php if ($sort === 'low_price') {print 'selected';} ?>>価格の安い順</option>
          <option value="high_price" <?php if ($sort === 'high_price') {print 'selected';} ?>>価格の高い順</option>
        </select>
        <input type="submit" value="並べ替え">
      </form>
    </div>
    <h1 class="title">商品一覧</h1>
    <!-- セッションにセットされたメッセージとエラーメッセージを出力(無い時は空) -->
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
        <!-- 商品一覧表示 -->
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print($item['name']); ?>
            </div>
            <figure class="card-body">
              <img class="card-img item-image" src="<?php print(IMAGE_PATH . $item['image']); ?>">
              <figcaption>
                <?php print(number_format($item['price'])); ?>円
                <?php if($item['stock'] > 0){ ?>
                  <!-- 商品をカートに入れるform -->
                  <form action="index_add_cart.php" method="post">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>">
                  </form>
                  <!-- 在庫数が0の場合 -->
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
  
</body>
</html>