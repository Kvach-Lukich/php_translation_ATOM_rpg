<?
require_once('config.php');
$loc=jsonrider($cnf['alllngfile']);

$langs=$cnf['langs'];
$langs[]=$cnf['primlang'];


foreach($loc as $node=>$data){
   foreach($data as $key=>$val){
      foreach($langs as $lng){
         $arr[$lng][$node][$key]=$val[$lng];
      }
   }
}


foreach($arr as $lng=>$json){
   jsonwriter($cnf['projectdir'].$cnf['Localization'].$cnf['projectprefix'].'text_'.$lng.'.json', $json);
}
echo "\nDone!\n";