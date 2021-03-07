<?php

namespace connect\query;
use ForceUTF8\hash\Encodings_utf8;
//database connect
	class connDB{
		
		// mysql host
		var $host;

		// mysql user
		var $user;

		// mysql pass
		var $pass;

		// mysql database name
		var $dbms;
}

// database fetching data
	class query_exec extends connDB{
	
		function bindQuery($data = null ){

			$utf8 = new Encodings_utf8();
			// connect to parrent class
			$query = $this->Query($data);
			$rowCount = $this->rowCount($query);
			
			//fetch array to json
			while($fetch_array = $this->Fetch($query)) {
			
				foreach($fetch_array as $key => $value){
			
					$dist[] = "'".$key."' => '".$utf8->toUTF8($value)."',";
			
				}
			
				$fist[] = "[".implode(" ",$dist)."],";
			
			}
			
			$last = '$ay = ['.implode(" ",$fist).'];';
			
			// creat new variable rules
			eval ($last);

			// return json result
			return json_decode(json_encode($ay));
		}

		// mysql query
		function Query($data){
			$query = PDOconnect()->query($data);
			return @$query;
		}

		// mysql fetch array
		function Fetch($data){
			$query = $data->fetch();
			return @$query;
		}

		// mysql num row
		function rowCount($data){
			$query = $data->rowCount();
			return @$query;	
		}

		// mysql fetch assoc
		function fetchAssoc($data){
			$query = $data->fetch(PDO::FETCH_ASSOC);
			return @$query;
		}
}