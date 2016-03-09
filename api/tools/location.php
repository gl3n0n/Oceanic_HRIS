<?php
class Location extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'location_id' => 'integer',
            'org_id' => 'integer',
            'location_code' => 'text',
            'description' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('location_code'));

        $viewable = array(
            'location_id' => 'integer',
            'location_code' => 'text',
            'description' => 'text'
            );

        $searchable = $viewable;
        unset($searchable['location_id']);

        $required = array('location_code', 'description', 'created_by', 'dt_created');
        $updateable = array('description', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'location', $columns, 'location_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}
// class Location
// {
// 	public function Location($conn, $location_code='', $description='')
// 	{
// 		$this->conn           = $conn;
// 		$this->location_code  = strtoupper($location_code);
// 		$this->description       = strtoupper($description);
// 	}

// 	public function checkLocation()
//     {
//         $table_name = 'location';
//         $result_types = array(
//                 'location_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'location_code="'.$this->location_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}

// 		return $row['location_id'];
//     }

// 	public function checkLocationId($location_id)
//     {
//         $table_name = 'location';
//         $result_types = array(
//                 'location_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'location_id='.$location_id, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
// 		}
// 		$res = ($row['location_id'] != ''? true : False);
// 		return $res;
//     }

// 	public function CreateLocation()
//     {
// 		$time = date('Y-m-d H:i:s');
//         $table_name = 'location';
//         $table_fields = array('location_code', 'description', 'created_by', 'dt_created');
// 		$types = array('text', 'text', 'text', 'timestamp');
// 		$sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
// 		$table_values = array($this->location_code, $this->description,  $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
// 		if (PEAR::isError($res)) {
// 			die($res->getMessage());
// 		}
// 		else
// 			return $lastInsert;
//     }

// 	public function UpdateLocation($location_id)
// 	{
// 		$table_name = 'location';
// 		$field_values   = array(
//             'description' => $this->description,
// 			'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
// 			);
// 		$types  = array('text', 'text');
// 		$res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'location_id = "'.$location_id.'" LIMIT 1', $types);
// 	}

// 	public function viewLocations($keyword='')
//     {
//         $table_name = 'location';
//         $result_types = array(
//                 'location_id' => 'integer',
// 				'location_code' => 'text',
// 				'description' => 'text'
//         );
//         $data = array();
// 		if ($keyword != '')
//         {
//             $where_clause = '';
//             $len = count($result_types);
//             $i = 0;
//             foreach ($result_types as $key => $value)
//             {
//                 if ('id' != substr($key, -2))
//                 {
//                     $where_clause .= "$key like '%$keyword%'";
//                     if ($i != $len - 1)
//                         $where_clause .= ' OR ';
//                 }
//                 $i++;
//             }
//             $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, $where_clause, null, true, $result_types);
//         }
// 		else
// 			$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, null, null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$data = array();
// 			if ($res->numRows() > 0)
// 			{
// 				$data['total'] = $res->numRows();
// 				$data['location'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function viewLocationById($location_id)
//     {
//         $table_name = 'location';
//         $result_types = array(
//                 'location_code' => 'text',
// 				'description' => 'text'
//         );

//         $data = array();
// 		$res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "location_id = $location_id LIMIT 1", null, true, $result_types);
//         if (PEAR::isError($res))
// 		{
// 			die($res->getMessage());
// 		}
// 		else
// 		{
// 			$data = array();
// 			if ($res->numRows() > 0)
// 			{
// 				$data['total'] = $res->numRows();
// 				$data['location'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
// 			}
// 		}
// 		return $data;
// 	}

// 	public function DeleteRecord($location_id)
// 	{
// 		$query = "DELETE FROM location WHERE location_id = $location_id LIMIT 1";
// 		$res = execute_query($this->conn, $query, '');

// 	}
// }
?>