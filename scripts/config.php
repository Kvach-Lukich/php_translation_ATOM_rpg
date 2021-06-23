<?php
//Внимание все пути писать через нормальный слеш!
$cnf['projectdir']='D:/utils_big/unity/Projects/TTmod/'; //путь к проекту Unity
$cnf['projectprefix']='TTmod'; //имя мода
$cnf['primlang']='ru'; //основной язык
$cnf['langs']=['en','de']; //массив дополнительных языков, если у вас в начале только ru - то оставить массив пустым $cnf['langs']=[];
//$cnf['langs']=['fr']; //можно комментировать/разкомментировать нужные варианты и создать предустановки.
$cnf['translator']='en'; //устаревшее
$cnf['alllngfile']='all.json'; //название основного файла

$cnf['objpath']='Assets/Resources/Entities/';
$cnf['Localization']='Assets/Resources/Localization/';
$cnf['objfolders']=['Behavior', 'Dialog', 'Interactive', 'Memo']; //список дирректорий в которых могут быть файлы для перевода
$cnf['lng2comment']=false; //добавлять в комменты языки
$cnf['translatorlen']=4200; //длина строки для гугль переводчика



require_once('lib.php');



$cnf['projectprefix'].='_';
foreach( $cnf['objfolders'] as $key=>$path ){
   $cnf['objfolders'][$key]=$cnf['projectdir'].$cnf['objpath'].$path.'/';
}