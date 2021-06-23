<?
require_once('config.php');
$loc=jsonrider($cnf['alllngfile']);
$diff=jsonrider('diff.json');
foreach($diff as $node=>$data){
   foreach($data as $key=>$val){
      $loc[$node][$key]=$val;
   }
}

jsonwriter($cnf['alllngfile'],$loc);
echo "\nDone!\n";