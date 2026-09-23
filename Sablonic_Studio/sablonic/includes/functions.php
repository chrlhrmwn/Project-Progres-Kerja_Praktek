<?php
if(session_status()===PHP_SESSION_NONE)session_start();
function db(){static $pdo;if($pdo)return $pdo;$c=require __DIR__.'/../config/database.php';$pdo=new PDO("mysql:host={$c['host']};port={$c['port']};dbname={$c['dbname']};charset={$c['charset']}",$c['user'],$c['pass'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);return $pdo;}
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function redirect($p){header('Location: '.$p);exit;}
function current_user(){return $_SESSION['user']??null;}
function is_logged_in(){return isset($_SESSION['user']);}
function require_login(){if(!is_logged_in())redirect('login.php');}
function require_role($roles){require_login();if(!in_array(current_user()['role'],$roles,true))die('Akses ditolak.');}
function calculate_price($pid,$qty,$printing){$s=db()->prepare("SELECT base_price FROM products WHERE id=?");$s->execute([$pid]);$base=(float)$s->fetchColumn();$extra=['DTF'=>0,'DTG'=>5000,'Screen Printing'=>3000,'Embroidery'=>10000][$printing]??0;return ($base+$extra)*$qty;}
function save_upload($f,$folder){if(($f['error']??UPLOAD_ERR_NO_FILE)!==UPLOAD_ERR_OK)return ['ok'=>false,'error'=>'Upload gagal.'];if($f['size']>8*1024*1024)return ['ok'=>false,'error'=>'File maksimal 8 MB.'];$allowed=['image/jpeg'=>'jpg','image/png'=>'png','application/pdf'=>'pdf'];$mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);if(!isset($allowed[$mime]))return ['ok'=>false,'error'=>'Format file harus JPG, PNG, atau PDF.'];$dir=__DIR__.'/../uploads/'.$folder;if(!is_dir($dir))mkdir($dir,0775,true);$name=bin2hex(random_bytes(12)).'.'.$allowed[$mime];move_uploaded_file($f['tmp_name'],$dir.'/'.$name);return ['ok'=>true,'path'=>'uploads/'.$folder.'/'.$name,'name'=>$f['name']];}
