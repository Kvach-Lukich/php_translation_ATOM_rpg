<?
require_once('config.php');

$loc=jsonrider($cnf['alllngfile']);

$obj=getObj();

foreach($loc as $node=>$data){
   $node=strtolower($node);
   $filedata=jsonrider($obj[$node]);
   foreach($data as $key=>$val){
      
      if( $filedata['states'][$key]['text'] && ($filedata['states'][$key]['text'][0]=='#' || $argv[1]=='-force') ){
         $filedata['states'][$key]['text']=$val[ $cnf['primlang'] ];
         if($cnf['lng2comment']){
            foreach($cnf['langs'] as $lng){
               $comment.="<{$lng}>{$val[$lng]}<{$lng}>\n";
            }
            if($filedata['states'][$key]['desc']['comment'][0]=='<'){
               $filedata['states'][$key]['desc']['comment']=preg_replace('@<\w{2}>.*<\w{2}>@ms', '', $filedata['states'][$key]['desc']['comment']);
            }
            $filedata['states'][$key]['desc']['comment']=$comment.trim($filedata['states'][$key]['desc']['comment']);
            $comment='';
         }else{
            $filedata['states'][$key]['desc']['comment']=trim(preg_replace('@<\w{2}>.*<\w{2}>@ms', '', $filedata['states'][$key]['desc']['comment']));
         }
         if($filedata['states'][$key]['desc']['comment']==''){
            unset($filedata['states'][$key]['desc']['comment']);
         }
         //if($filedata['states'][$key]['comment']){
         //   unset($filedata['states'][$key]['comment']);
         //}
      }
   }
   if($filedata){
      jsonwriter($obj[$node],$filedata);
   }
   $filedata=[];
}

echo "\nDone!\n";
