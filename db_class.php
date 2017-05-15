<?php

class db
{
	public $conn;
	public function __contruct($servername='localhost', $username='root', $password='', $dbname='service')
	{
		$this->conn= mysqli_connect($servername, $username, $password, $dbname);
		
echo "conn = ".$this->conn;
		if (!$this->conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	}
	public function insert($table, $column_values)
	{
		$columns='';
		$values='';
		$count=count($column_values);
		foreach($column_values as $column=>$value)
		{
			if($count==1)
			{
				$columns.=$column;
				$values.="'".$value."'";

			}
			else
			{
			$columns.=$column.',';
			$values.="'".$value."',";

			}
			$count--;
		}
		$query="INSERT INTO $table ($columns)
VALUES ($values)";
return $query;
	}
	public function select($table,$where='1=1', $columns= '*')
	{
		if(!($columns=='*'))
		{
			$columns=implode(",",$columns);
		}
		if(!empty(trim($table)))
		{
			if($columns== '*')
			{
				$query='SELECT * FROM '.$table.' WHERE '.$where;
				
			}
			else
			{
				$query='SELECT '.$columns.' FROM '.$table.' WHERE '.$where;
			}
		}
		
		else
		{
			return "Table Name should not be empty";
		}
		
		return $query;
	}
	public function update($table,$where, $column_values)
	{
		if(!empty($table) && !empty($where) && !empty($column_values))
		{
			
		$col_val='';
		$count=count($column_values);
		foreach($column_values as $column=>$value)
		{
			if($count==1)
			{
				$col_val.=$column." = '".$value."'";

			}
			else
			{
			$col_val.=$column." = '".$value."' , ";

			}
			$count--;
		}
		$query="UPDATE $table SET $col_val WHERE $where ";
		}
		else
		{
			return "none of the 3 parameters can be left blank";
		}
		return $query;
	}
	public function delete($table,$where)
	{
		if(!empty(trim($table)) && !empty(trim($where)))
		{
		$query='DELETE FROM '.$table.' WHERE '.$where;
		}
		else
		{
			return "Table name and/or WHERE condition should not be empty should not be empty";
		}
		return $query;
	}
	
	public function __destruct()
	{
		@mysqli_close($this->conn);
	}
}
?>