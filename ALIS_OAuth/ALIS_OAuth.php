<?php
session_start();

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

//ランダムに数字を生成
$length = mt_rand(111111,999999);

//登録したアプリケーションのidをセット
$client_id = "xxxxx";
$redirect_uri = "http://voemushroom.com/alis_code.php";
$scope = "read";

//生成
$code_verifier  = base64url_encode(substr(bin2hex(random_bytes($length)), 0, 50));
$code_challenge = base64url_encode( hash ('sha256',$code_verifier, true));

$code_challenge_method = "S256";
$response_type = "code";                  

//code_verifierをセッションで保存
$_SESSION["code_verifier"] = $code_verifier;

$url = "https://alis.to/oauth-authenticate?client_id=".$client_id."&redirect_uri=".$redirect_uri."&scope=".$scope."&code_challenge=".$code_challenge."&code_challenge_method=".$code_challenge_method."&response_type=".$response_type;

//認証画面へジャンプ
header("Location: ".$url);
exit();

?>



