<?
function jsonrider($file){
   return json_decode(file_get_contents($file),true);
}
function jsonwriter($file,$arr){
   file_put_contents($file, json_encode( $arr , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) );
}

function stringsFile($lng, $isdefault=false){
   global $cnf;
   if(!$isdefault){
      $file=$cnf['projectdir'].$cnf['Localization'].$cnf['projectprefix'].'text_'.$lng.'.json';
   }else{
      $file=$cnf['projectdir'].$cnf['Localization'].'text_'.$lng.'.json';
   }
   return $file;
}

function getObj(){
   global $cnf;
   foreach($cnf['objfolders'] as $path){
      $objfiles=scandir($path);
      foreach($objfiles as $file){
         if( substr($file,-5)=='.json' ){
            $obj[ strtolower( substr($file,0,-5) ) ]=$path.$file;
         }
      }
   }

   return $obj;
}


function mylog($data){
   $log="\n======================================================\n";
   $log.=print_r($data,true);
   file_put_contents('log.txt',$log,FILE_APPEND);
}