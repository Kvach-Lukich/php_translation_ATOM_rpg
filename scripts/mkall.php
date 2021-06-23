<?
require_once('config.php');

$langs=array_merge([$cnf['primlang']], $cnf['langs']);

foreach($langs as $lng){
   $arr[$lng]=jsonrider($cnf['projectdir'].$cnf['Localization'].$cnf['projectprefix'].'text_'.$lng.'.json');
}

foreach($arr[$cnf['primlang']] as $obj=>$data){
   foreach($data as $key=>$val){
      foreach($langs as $lng){
         $all[$obj][$key][$lng]=$arr[$lng][$obj][$key];
      }
   }
}

jsonwriter($cnf['alllngfile'],$all);
echo "\nDone!\n";
