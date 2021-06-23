<?
require_once('config.php');

$unitylocfile=stringsFile($cnf['primlang'], true);
$unityloc=jsonrider($unitylocfile);

$obj=getObj();

foreach($unityloc as $node=>$data){
   if($data){
      $node=strtolower($node);
      print_r($node); echo "\n";
      $filedata=jsonrider($obj[$node]);
      foreach($data as $key=>$val){
         $all[$node][$key][$cnf['primlang']]=$val;
         $strs=$filedata['states'][$key]['desc']['comment'];
         foreach($cnf['langs'] as $lng){
            $lngstr=explode("<{$lng}>", $strs);
            $all[$node][$key][$lng]=$lngstr[1];
         }
      }
   }
}

jsonwriter('all_unity.json',$all);
echo "\nDone!\n";