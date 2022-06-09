<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="index.php" method="post" enctype="multipart/form-data">
    ファイル:
    <input type="file" name="upfile" size="30" /><br />
    <br />
    <input type="submit" name="submit" value="アップロード" />
  </form>
  <?php if(!empty($result)): ?>
    <h1>画像が保存されました！ ファイル名：<?= $result['filename']; ?><h1>
  <?php endif; ?>
</body>
</html>