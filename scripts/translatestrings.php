<?
require_once('config.php');
require_once('translator.php');
$gtrans=new GoogleTranslateForFree();

$strs=jsonrider('allstrings.json');

$pt=0;
foreach($cnf['langs'] as $lng){
   foreach($strs as $type=>$obj){
      foreach($obj as $name=>$data){
         if(is_array($data[$cnf['primlang']])){
            foreach($data[$cnf['primlang']] as $key=>$val){
               if(!$data[$lng][$key]){
                  if(mb_strlen( $txt[$pt] )>$cnf['translatorlen']){
                     $pt++;
                  }
                  $txt[$pt].=$val."\n*\n";
               }
            }
         }else{
            if(!$data[$lng]){
               if(mb_strlen( $txt[$pt] )>$cnf['translatorlen']){
                  $pt++;
               }
               $txt[$pt].=$data[$cnf['primlang']]."\n*\n";
            }
         }
      }
   }
   $txt[$pt]=mb_substr($txt[$pt],0,-3);

   foreach($txt as $key=>$text){
      echo "\n".$lng."\n";
      $newtr.=$gtrans->translate($cnf['primlang'],$lng,$text,1)."\n";
      echo "\ngoogle sleep 0.3 s\n";
      usleep(300000);
   }

   $newtr=mb_substr($newtr,0,-1);
   $txt_arr=explode("\n*\n",$newtr);
   $newtr='';
   $k=0;
   
   foreach($strs as $type=>$obj){
      foreach($obj as $name=>$data){
         if(is_array($data[$cnf['primlang']])){
            foreach($data[$cnf['primlang']] as $key=>$val){
               if(!$data[$lng][$key]){
                  $strs[$type][$name][$lng][$key]=$txt_arr[$k];
                  $k++;
               }
            }
         }else{
            if(!$data[$lng]){
               $strs[$type][$name][$lng]=$txt_arr[$k];
               $k++;
            }
         }
      }
   }
}

jsonwriter('allstrings.json',$strs);
echo "\nDone!\n";