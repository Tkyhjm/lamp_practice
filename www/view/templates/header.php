
<!-- ログイン画面とユーザー登録画面のヘッダー部分の表示 -->


<header>
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="<?php print(HOME_URL);?>">Market</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#headerNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="headerNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <!-- 新規登録リンク -->
          <a class="nav-link" href="<?php print(SIGNUP_URL);?>">サインアップ</a>
        </li>
        <li class="nav-item">
          <!-- ログインページリンク -->
          <a class="nav-link" href="<?php print(LOGIN_URL);?>">ログイン</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
