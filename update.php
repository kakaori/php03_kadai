<?php
// エラーを出力する
ini_set( 'display_errors', 1 );


//1.　POSTデータ取得
$name        = $_POST['name'];
$credo       = $_POST['credo'];
$community   = $_POST['community'];
$improvement = $_POST['improvement'];
$thanks      = $_POST['thanks'];
$message     = $_POST['message'];
$cosmos      = $_POST['cosmos'];
//id分を追加
$id = $_POST["id"];


//2.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE gs_table SET name=:name, q1=:credo, q2=:community, q3=:improvement, q4=:thanks, q5=:message, q6=:cosmos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':credo',       $credo,       PDO::PARAM_STR);
$stmt->bindValue(':community',   $community,   PDO::PARAM_STR);
$stmt->bindValue(':improvement', $improvement, PDO::PARAM_STR);
$stmt->bindValue(':thanks',      $thanks,      PDO::PARAM_STR);
$stmt->bindValue(':message',     $message,     PDO::PARAM_STR);
$stmt->bindValue(':cosmos',      $cosmos,      PDO::PARAM_STR);
$stmt->bindValue(':id',          $id,          PDO::PARAM_STR);
$status = $stmt->execute();//SQL実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);//function化
} else {
    // redirect("index.php");//function化
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/output.css">
    <title>LAB17 GEEK日記｜更新完了</title>

</head>
<body class="text-gray-600">

<div class="bg-white mx-auto max-w-screen-md pb-6 sm:pb-8 lg:pb-12">
  <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
    <header class="flex items-center justify-between py-4 md:py-8">
      <!-- logo - start -->
      <a href="./" class="items-center gap-2.5 text-2xl font-bold md:text-3xl" aria-label="logo">
        <img class="w-48" src="https://gsacademy.jp/assets/images/header/logo.svg">
      </a>
      <!-- logo - end -->

      <!-- nav - start -->
      <nav class="gap-12">
        <a href="./read.php" class="py-2 px-5 bg-sky-500 text-white font-semibold rounded-full shadow-md hover:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-400 focus:ring-opacity-75">みんなの日記</a>
      </nav>
      <!-- nav - end -->

    </header>

  </div>
</div>

<div class="bg-white">
  <div class="mx-auto max-w-screen-md px-4 md:px-8">
    <p class="mb-4 text-center text-xl text-sky-500 font-bold md:mb-6 lg:text-xl">LAB17 GEEK日記</p>
    <h2 class="mb-4 text-center text-2xl font-bold md:mb-8 lg:text-3xl xl:mb-12">更新が完了しました</h2>

    <div class="divide-y">
      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">ニックネーム</span>
        </div>
        <p class="text-gray-600"><?php echo $name?></p>
      </div>
      <!-- review - end -->

      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">CREDOに則り、自らのチカラでセカイを変えようとする全ての挑戦を讃えましたか？</span>
        </div>

        <p class="text-gray-600"><?php echo $credo?></p>
      </div>
      <!-- review - end -->

      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">コミュニティの活性化に自ら貢献しましたか？</span>
        </div>

        <p class="text-gray-600"><?php echo $community?></p>
      </div>
      <!-- review - end -->

      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">昨日のあなたより、今日のあなたができるようになったことはなんですか？</span>
        </div>

        <p class="text-gray-600"><?php echo $improvement?></p>
      </div>
      <!-- review - end -->

      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">周りの人に感謝することや、良かった点を教えてください。</span>
        </div>

        <p class="text-gray-600"><?php echo $thanks?></p>
      </div>
      <!-- review - end -->

      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">明日の目標はなんですか？</span>
        </div>
        <p class="text-gray-600"><?php echo $message?></p>
      </div>
      <!-- review - end -->

      <!-- review - start -->
      <div class="flex flex-col gap-3 py-4 md:py-8">
        <div>
          <span class="block text-sm font-bold">コスモは燃えていますか？</span>
        </div>
        <p class="text-gray-600"><?php echo $cosmos?></p>
      </div>
      <!-- review - end -->

    </div>
  </div>
</div>

<footer class="mx-auto py-8">
  <div class="py-8 pb-0 border-t text-center text-sm text-gray-300">© 2024 - kadai.</div>
</footer>

</body>
</html>