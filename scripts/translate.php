<?
require_once('config.php');
require_once('translator.php');
$gtrans=new GoogleTranslateForFree();
//$new=$gtrans->translate('ru','en','Поваренная книга');
//print_r($new);

$loc=jsonrider($cnf['alllngfile']);
$pt=0;
foreach($loc as $node=>$data){
   foreach($data as $key=>$val){
      if(mb_strlen( $txt[$pt] )>$cnf['translatorlen']){
         $pt++;
      }
      $txt[$pt].=$val[ $cnf['primlang'] ]."\n*\n";
   }
}
$txt[$pt]=mb_substr($txt[$pt],0,-3);

foreach($cnf['langs'] as $lng){
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
   foreach($loc as $node=>$data){
      foreach($data as $key=>$val){
         $spc=mb_strpos($val[$cnf['primlang']], '$');
         if($spc){
            $spcl=mb_strpos($txt_arr[$k], '$');
            $txt_arr[$k]=mb_substr($txt_arr[$k],0,$spcl).mb_substr($val[$cnf['primlang']],$spc);
         }
         $spstr=stristr($val[$cnf['primlang']],"[d]");
         if($spstr){
             $txt_arr[$k]=trim(stristr( $txt_arr[$k],"[d]",true)).$spstr;
         }
         $txt_arr[$k]=str_replace(' ...', '...', $txt_arr[$k]);
         
         $loc[$node][$key][ $lng ]=$txt_arr[$k];
         $k++;
      }
   }
}
jsonwriter($cnf['alllngfile'],$loc);

echo "\nDone!\n";