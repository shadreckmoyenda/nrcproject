<?php


$allowed_columns = [
 'firstname', 'lastname', 'username', 'name', 'email', 'password', 'role', 'professional', 'about', 'address', 'phone', 'phone1','phone2', 'image', 'logo', 'slug', 'facebook', 'twitter', 'instagram', 'linkedin', 'activate', 'date', 'question_no',	'question', 'user_id', 'question_id1', 'answer1', 'question_id2', 'answer2', 'question_id3', 'answer3', 'viewed'
];


function db_query($query, $data = array()){

	$con = db_connection();

	$stmt = $con->prepare($query);
	if ($stmt) {
		$check = $stmt->execute($data);
		if ($check) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (is_array($result) && count($result) > 0) {
				return $result;
			}
		}
	}

	return false;
}



function db_query_one($query, $data = array()){

	$con = db_connection();

	$stmt = $con->prepare($query);
	if ($stmt) {
		$check = $stmt->execute($data);
		if ($check) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (is_array($result) && count($result) > 0) {
				return $result[0];
			}
		}
	}

	return false;
}


function get_allowed_columns($data){
  		
		if(!empty($allowed_columns)){
		foreach ($data as $key => $value) {
			if (!in_array($key, $allowed_columns)) {
				unset($data[$key]);
			}
		}
	}

	return $data;
}


function insert($data, $table){
	
 	$clean_array = get_allowed_columns($data);
 	$keys = array_keys($clean_array);

 	$query = "insert into $table ";
 	$query .= "(".implode(",", $keys) .") values ";
 	$query .= "(:".implode(",:", $keys) .")";
	
	db_query($query, $clean_array);
}


function update($id, $data, $table){
	
 	$clean_array = get_allowed_columns($data);
 	$keys = array_keys($clean_array);

 	$query = "update $table set ";
 	
 	foreach ($keys as $column) {
 		$query .= $column . "=:".$column .",";
 	}

 	$query = trim($query, ",");
 	$query .= " where id = :id";
 	$clean_array['id'] = $id;

	db_query($query, $clean_array);
}


function delete($id, $table){
	
 	$query = "delete from $table where id = :id";
 	
 	$clean_array['id'] = $id;

	db_query($query, $clean_array);
}


function where($data, $limit = 10, $offset = 0, $order = "desc", $order_column = "id", $table){
 
 	$keys = array_keys($data);

 	$query = "SELECT * from $table where ";
 	
 	foreach ($keys as $key) {
 		$query .= "$key = :$key AND ";
 	}

 	$query = trim($query, "AND ");
 	$query .= " order by $order_column $order limit $limit offset $offset";
	
	
	return db_query($query, $data);
}


function get_all($limit = 1000, $offset = 0, $order = "desc", $order_column = "id", $table){
  
 	$query = "SELECT * from $table where qty > '0' order by $order_column $order";
 	 
	
	return db_query($query);
}



function first($data, $table){
 
 	$keys = array_keys($data);

 	$query = "SELECT * from $table where ";
 	
 	foreach ($keys as $key) {
 		$query .= "$key = :$key AND ";
 	}

 	$query = trim($query, "AND ");
	 
	return db_query_one($query, $data);
}