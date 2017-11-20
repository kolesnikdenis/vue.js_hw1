<?php
header('Content-Type: application/json');

$file="login_pass_base.json";
$string = file_get_contents($file);
$json_a = json_decode($string, true);
$string = $_POST['auth'];
$out = array('msg' => "error auth",
'msg1' =>'',
'html' => '<img src="https://s3.amazonaws.com/flydata.com/wp-content/uploads/2015/08/Access-Denied-RDS.png" width=250px>');

if ($string) { 
 while (list($key, $value) = each($json_a['login_db'])) {
   if ( ( $value['login'] == $string['login'] ) && ( $value['pass'] == $string['pass'] ) ) {
	$out['msg']="auth ok";
	$out['html']='<img src="https://i.pinimg.com/736x/df/f1/43/dff143c1fcac09fed122ddf22b51d798--smile-qoutes-deep-quotes.jpg" width=250px>';
	echo json_encode($out);
	return 1; 
   }
 }
 echo json_encode($out);
}

$string = $_POST['reg'];
if ($string){
 if ( ( strlen($string['login'])> 1 ) && ( strlen( $string['pass']) > 1) ) {
	$save_login=array( 'login' => $string['login'],  'pass' => $string['pass'] );
	array_push($json_a['login_db'], $save_login); 
	file_put_contents($file, json_encode($json_a));
	//var_dump($json_a);
	$out['msg']="save OK";
	$out['html']='<img src="https://i0.wp.com/orbitbiotech.com/wp-content/uploads/2015/12/Registration-Complete-Empower-Biotech-Industrial-Training-Program-Orbit-Biotech.jpg" width=250px>';
	echo json_encode($out);
 } else {
	 $out['msg']="что то пошло не так или слишком короткий логин пароль ... или ... ";
	 $out['html']='<img src="https://blog.sqlauthority.com/i/a/errorstop.png" width=250px>';
	 echo json_encode($out);
	}
}
?>
