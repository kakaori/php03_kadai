<?PHP 
// エラーを出力する
ini_set( 'display_errors', 1 );

$id = $_GET["id"];

//1.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$row = $stmt -> fetch();
// $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/output.css">
    <title>LAB17 GEEK日記｜編集</title>
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
  <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
    <!-- text - start -->
    <div class="mb-10 md:mb-16">
      <h2 class="mb-4 text-center text-2xl font-bold md:mb-6 lg:text-3xl">LAB17 GEEK日記</h2>
      <p class="mx-auto max-w-screen-md text-center text-sky-500 md:text-lg">編集画面</p>
    </div>
    <!-- text - end -->

    <!-- form - start -->
    <form action="update.php" method="post" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2">

      <!-- ニックネーム -->
      <div class="sm:col-span-2">
        <label for="name" class="mb-2 inline-block text-sm sm:text-base">ニックネーム ※変更できません</label>
        <input name="name" value="<?= $row["name"] ?>" class="w-full rounded border px-3 py-3 outline-none" disabled />
        <input name="name" type="hidden" value="<?= $row["name"] ?>">
      </div>

      <!-- クレド -->
      <div class="sm:col-span-2">
        <label for="credo" class="mb-2 inline-block text-sm sm:text-base">CREDOに則り、自らのチカラでセカイを変えようとする全ての挑戦を讃えましたか？</label>
          <div class="flex justify-between grid gap-x-8 gap-y-4 grid-cols-3">
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="credo" value="讃えた" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q1"] === "讃えた") ? 'checked' : ''; ?>>讃えた</label>
            </div>
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="credo" value="はい" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q1"] === "はい") ? 'checked' : ''; ?>>はい</label>
            </div>
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="credo" value="Yes" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q1"] === "Yes") ? 'checked' : ''; ?>>Yes</label>
            </div>
          </div>
      </div>

      <!-- コミュニティ -->
      <div class="sm:col-span-2">
        <label for="community" class="mb-2 inline-block text-sm sm:text-base">コミュニティの活性化に自ら貢献しましたか？</label>
          <div class="flex justify-between grid gap-x-8 gap-y-4 grid-cols-3">
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="community" value="貢献した" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q2"] === "貢献した") ? 'checked' : ''; ?>>貢献した</label>
            </div>
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="community" value="はい" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q2"] === "はい") ? 'checked' : ''; ?>>はい</label>
            </div>
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="community" value="Yes" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q2"] === "Yes") ? 'checked' : ''; ?>>Yes</label>
            </div>
          </div>
      </div>

      <!-- 改善 -->
      <div class="sm:col-span-2">
        <label for="improvement" class="mb-2 inline-block text-sm sm:text-base">昨日のあなたより、今日のあなたができるようになったことはなんですか？</label>
        <textarea name="improvement" class="w-full rounded border bg-sky-50 px-3 py-2 outline-none ring-sky-300 transition duration-100 focus:ring" required><?= $row["q3"] ?></textarea>
      </div>
  
      <!-- ありがとう -->
      <div class="sm:col-span-2">
        <label for="thanks" class="mb-2 inline-block text-sm sm:text-base">周りの人に感謝することや、良かった点を教えてください。</label>
        <textarea name="thanks" class="w-full rounded border bg-sky-50 px-3 py-2 outline-none ring-sky-300 transition duration-100 focus:ring" required><?= $row["q4"] ?></textarea>
      </div>

      <!-- 取り組み -->
      <div class="sm:col-span-2">
        <label for="message" class="mb-2 inline-block text-sm sm:text-base">明日の目標はなんですか？</label>
        <textarea name="message" class="w-full rounded border bg-sky-50 px-3 py-2 outline-none ring-sky-300 transition duration-100 focus:ring" required><?= $row["q5"] ?></textarea>
      </div>

      <!-- コスモ -->
      <div class="sm:col-span-2">
        <label for="cosmos" class="mb-2 inline-block text-sm sm:text-base">コスモは燃えていますか？</label>
          <div class="flex justify-between grid gap-x-8 gap-y-4 grid-cols-3">
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="cosmos" value="燃えている" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q6"] === "燃えている") ? 'checked' : ''; ?>>燃えている</label>
            </div>
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="cosmos" value="はい" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q6"] === "はい") ? 'checked' : ''; ?>>はい</label>
            </div>
            <div>
              <label class="ring-gray-200 has-[:checked]:ring-sky-500 has-[:checked]:bg-sky-50 grid grid-cols-[5px_1fr_auto] items-center gap-6 rounded-lg p-4 ring-2 hover:bg-sky-50 cursor-pointer mb-2"><input type="radio" name="cosmos" value="Yes" class="box-content h-1.5 w-1.5 appearance-none rounded-full border-[5px] ring-1 ring-sky-950/10 checked:border-sky-500 checked:ring-sky-500" <?php echo ($row["q6"] === "Yes") ? 'checked' : ''; ?>>Yes</label>
            </div>
          </div>
      </div>

      <input type="hidden" name="id" value="<?= $row["id"] ?>">
      <div class="text-center items-center justify-between sm:col-span-2">
        <button class="w-64 inline-block rounded-lg bg-sky-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-sky-300 transition duration-100 hover:bg-sky-600 focus-visible:ring active:bg-sky-700 md:text-base">更新する</button>
      </div>
    </form>
    <!-- form - end -->

    <!-- form - start -->
    <form id="deleteForm" action="delete.php" method="post" class="mx-auto max-w-screen-md">
      <div class="mt-4">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <button id="delete" class="inline-block rounded-lg bg-gray-100 px-8 py-3 text-center text-sm outline-none transition duration-200 hover:bg-gray-200 focus-visible:ring active:bg-gray-300 md:text-base">削除</button>
      </div>
    </form>
    <!-- form - end -->

  </div>
</div>

<footer class="mx-auto py-8">
  <div class="py-8 pb-0 border-t text-center text-sm text-gray-300">© 2024 - kadai.</div>
</footer>


<script>
  document.getElementById('delete').addEventListener('click', function(event) {
    if (confirm('本当に削除しますか？')) {
      document.getElementById('deleteForm').submit();
    } else {
      // キャンセルをクリックした場合、フォームは送信されない
      event.preventDefault();
    }
  });
</script>
</body>
</html>