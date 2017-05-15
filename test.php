<?php
require_once('db_class.php');


$db= new db();

 $arr= array(
 'col1'=>'val1',
 'col2'=>'val2',
 'col3'=>'val3'
 );
 
 $cols = array('col1','col2','col3','col4');
//var_dump($db->insert('tablename',$arr));

//var_dump($db->delete('tablename','id=7'));

//var_dump($db->update('tablename','id=7',$arr));

//var_dump($db->select('tablename'));

var_dump($db->select('tablename', '1=1',$cols));

?>