<?
require_once('config.php');

$langs=array_merge([$cnf['primlang']], $cnf['langs']);

foreach($langs as $lng){
   $stringsfile=$cnf['projectdir'].$cnf['Localization'].$cnf['projectprefix']."strings_{$lng}.json";
   $strs[$lng]=jsonrider($stringsfile);
}

foreach($strs[$cnf['primlang']] as $type=>$obj){
   if(is_array($obj)){
      foreach($obj as $name=>$data){
         foreach($langs as $lng){
            $allstr[$type][$name][$lng]=$strs[$lng][$type][$name];
         }
      }
   }
}

jsonwriter('allstrings.json',$allstr);
echo "\nDone!\n";
