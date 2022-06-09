<?php

include_once('function/function.php');

$flg = true;
$chk = true;
$file = '';
$exif = '';
$error = [];

if(isset($_POST['submit'])){
  if($_FILES['upfile']['error'] > 0){
    $error['file'] = "ファイルエラーです"; //エラー文表示
    $chk = false;
  }
  //ファイルの拡張子チェック
  elseif(!check_ext($_FILES['upfile']['name'])){
    $error['file']= "この形式のファイルはアップロードできません";
    $chk = false;
  }
  if($chk){
    $ext = strtolower(pathinfo($_FILES['upfile']['name'] , PATHINFO_EXTENSION));
    $url = "http://localhost:8081/fileupload";
  
    // cURLセッションを初期化
    $ch = curl_init();
  
    $cfile = new CURLFile($_FILES["upfile"]["tmp_name"],'image/jpeg', date('YmdHis') . '.' . $ext);
    $params = array('image' => $cfile);

    // オプションを設定
    // curl_setopt($ch, CURLOPT_URL, $url); // 取得するURLを指定
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 実行結果を文字列で返す
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // サーバー証明書の検証を行わない

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params );  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  
  
    // URLの情報を取得
    $response =  curl_exec($ch);
  
    // 取得結果を表示
    $result = json_decode ($response , true);
    var_dump($result);
  
    // セッションを終了
    curl_close($ch);
  }
}

require_once './tpl_index.php';

?>