<?PHP 
// エラーを出力する
ini_set( 'display_errors', 1 );

//1.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/output.css">
    <title>LAB17 GEEK日記｜一覧表示</title>
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
    <div class="mx-autolg px-4 md:px-8">
        <h2 class="mb-4 text-center text-2xl font-bold md:mb-8 lg:text-3xl xl:mb-12">LAB17 みんなのGEEK日記</h2>

        <div class="mx-auto max-w-screen-sm mb-8">
            <p class="text-sm mb-0.5">質問１ CREDOに則り、自らのチカラでセカイを変えようとする全ての挑戦を讃えましたか？</p>
            <p class="text-sm mb-0.5">質問２ コミュニティの活性化に自ら貢献しましたか？</p>
            <p class="text-sm mb-0.5">質問３ 昨日のあなたより、今日のあなたができるようになったことはなんですか？</p>
            <p class="text-sm mb-0.5">質問４ 周りの人に感謝することや、良かった点を教えてください。</p>
            <p class="text-sm mb-0.5">質問５ 明日の目標はなんですか？</p>
            <p class="text-sm mb-0.5">質問６ コスモは燃えていますか？</p>
        </div>

        <div class="w-full mx-auto overflow-auto">


        <table class='mb-4 table-auto w-full text-left whitespace-no-wrap'>
            <tr>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl'>回答日時</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100'>ニックネーム</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100'>質問１</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100'>質問２</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100'>質問３</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100'>質問４</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100'>質問５</th>
                <th class='whitespace-nowrap px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br'>質問６</th>
            </tr>
            <?php foreach($values as $v){ ?>
                <tr>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><a href="detail.php?id=<?=$v["id"]?>" class="text-sky-500 underline decoration-sky-500 hover:no-underline"><?=$v["indate"]?></a></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["name"])?></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["q1"])?></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["q2"])?></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["q3"])?></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["q4"])?></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["q5"])?></td>
                  <td class='border-t-2 border-gray-200 px-4 py-3'><?=h($v["q6"])?></td>
                </tr>
            <?php } ?>
        </table>

        </div>

        <div><img class="m-auto" src="./img/cool_geek_actwithpassion.png" alt=""></div>
    </div>
</div>

<footer class="mx-auto py-8">
  <div class="py-8 pb-0 border-t text-center text-sm text-gray-300">© 2024 - kadai.</div>
</footer>

</body>
</html>