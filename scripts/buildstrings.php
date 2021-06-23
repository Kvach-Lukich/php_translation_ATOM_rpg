<?
require_once('config.php');
$strs=jsonrider('allstrings.json');
$langs=array_merge([$cnf['primlang']], $cnf['langs']);

foreach($langs as $lng){
   foreach($strs as $type=>$obj){
      foreach($obj as $name=>$data){
         $strf[$type][$name]=$data[$lng];
      }
   }
   jsonwriter($cnf['projectdir'].$cnf['Localization'].$cnf['projectprefix'].'strings_'.$lng.'.json', $strf);
   $strf=[];
}

echo "\nDone!\n";