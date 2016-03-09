<?php
class SalaryGrade extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'sal_grd_id' => 'integer',
            'org_id' => 'integer',
            'gr_lvl' => 'integer',
            'job_id' => 'integer',
            'classification' => 'text',
            'minimum' => 'integer',
            'median' => 'integer',
            'maximum' => 'integer',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = null;
        // no need to set since we will construct this manually
        $viewable = array(
            'sal_grd_id' => 'integer',
            'gr_lvl' => 'integer',
            'job_id' => 'integer',
            'classification' => 'text',
            'minimum' => 'integer',
            'median' => 'integer',
            'maximum' => 'integer'
            );

        $searchable = $viewable;
        unset($searchable['sal_grd_id']);

        $required = array('gr_lvl', 'job_id', 'classification', 'created_by', 'dt_created');
        $updateable = array('gr_lvl', 'job_id', 'classification', 'minimum', 'median', 'maximum', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'salary_grade', $columns, 'sal_grd_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    // public function viewDataById($id)
    // {
    //     // $this->conn->loadModule('Extended');
    //     $where_clause = "a.".$this->primary_id_name." = ".$this->conn->quote($id, 'integer');

    //     return $this->selectData($where_clause);
    // }

    protected function generateFilterWhereClause($where_clause, $filters)
    {
        if (!empty($filters))
        {
            $addtnl_clause = empty($where_clause) ? '' : ' AND ';
            $len = count($filters);
            $i = 0;
            foreach ($filters as $column => $value)
            {
                $addtnl_clause .= "a.$column = ".$this->conn->quote($value, $this->columns[$column]);
                if ($i != $len - 1)
                    $addtnl_clause .= ' AND ';
                $i++;
            }

            return $where_clause.$addtnl_clause;
        }

        return $where_clause;
    }

    protected function generateSearchWhereClause($search_kw='')
    {
        $where_clause = false;

        if(!empty($search_kw))
        {
            // $this->conn->loadModule('Extended');
            $len = count($this->searchable_columns);
            $i = 0;
            foreach ($this->searchable_columns as $column)
            {
                if ('id' != substr($column, -2))
                {
                    $where_clause .= "a.$column like ".$this->conn->quote('%'.$search_kw.'%', 'text');
                    if ($i != $len - 1)
                        $where_clause .= ' OR ';
                }
                $i++;
            }
        }

        return $where_clause;
    }

    protected function selectData($where_clause=false)
    {
        // di pwede MDB2 since kailangan mag join, kailangan rekta na para iwas lookup
        // used by both view and view-id so reveal all needed columns
        $query = "SELECT a.sal_grd_id, a.gr_lvl, a.job_id, b.job_description, a.classification, a.minimum, a.median, a.maximum FROM salary_grade a LEFT JOIN jobs b ON a.job_id = b.job_id";

        if (!empty($where_clause))
            $query .= " WHERE $where_clause";

        $res = execute_query($this->conn, $query, '');
        if (!PEAR::isError($res))
        {
            $data = array('total'=>0, $this->table=>array());
            if ($res->numRows() > 0)
            {
                $data['total'] = $res->numRows();
                $data[$this->table] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
            }

            return $data;
        }
        print_r($res);
        die($res->getMessage()." -- ".$res->getError());
    }
}

// class SalaryGrade
// {
//     public function SalaryGrade($conn, $gr_lvl, $job_id, $classification, $minimum, $median, $maximum)
//     {
//         $this->conn = $conn;
//         $this->gr_lvl = strtoupper($gr_lvl);
//         $this->job_id = strtoupper($job_id);
//         $this->classification = strtoupper($classification);
//         $this->minimum = strtoupper($minimum);
//         $this->median = strtoupper($median);
//         $this->maximum = strtoupper($maximum);
//     }

//     public function checkSalaryGrade()
//     {
//         $table_name = 'salary_grade';
//         $result_types = array(
//                 'sal_grd_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'job_id="'.$this->job_id.'" AND classification="'.$this->classification.'"', null, true, $result_types);
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
//         }

//         return $row['sal_grd_id'];
//     }

//     public function checkSalaryGradeId($sal_grd_id)
//     {
//         $table_name = 'salary_grade';
//         $result_types = array(
//                 'sal_grd_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'sal_grd_id='.$sal_grd_id, null, true, $result_types);
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
//         }
//         $res = ($row['sal_grd_id'] != ''? true : False);
//         return $res;
//     }

//     public function CreateSalaryGrade()
//     {
//         $time = date('Y-m-d H:i:s');
//         $table_name = 'salary_grade';
//         $table_fields = array('gr_lvl', 'job_id', 'classification', 'minimum', 'median', 'maximum', 'created_by', 'dt_created');
//         $types = array('text', 'text', 'text', 'integer', 'integer', 'integer', 'integer', 'timestamp');
//         $sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
//         $table_values = array($this->gr_lvl, $this->job_id, $this->classification, $this->minimum, $this->median, $this->maximum,  $_SESSION['user_id'], $time);
//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
//         if (PEAR::isError($res)) {
//             die($res->getMessage());
//         }
//         else
//             return $lastInsert;
//     }

//     public function UpdateSalaryGrade($sal_grd_id)
//     {
//         $table_name = 'salary_grade';
//         $field_values = array(
//             'gr_lvl' => $this->gr_lvl,
//             'job_id' => $this->job_id,
//             'classification' => $this->classification,
//             'minimum' => $this->minimum,
//             'median' => $this->median,
//             'maximum' => $this->maximum,
//             'modified_by' => $_SESSION['user_id'],
//             'dt_last_modified' => date("Y-m-d H:i:s")
//         );
//         $types  = array('integer', 'text', 'text', 'integer', 'integer', 'integer');
//         $res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'sal_grd_id = "'.$sal_grd_id.'" LIMIT 1', $types);
//     }

//     public function viewSalaryGrades($keyword='')
//     {
//         $query = "SELECT a.sal_grd_id, a.gr_lvl, b.job_description, a.classification, a.minimum, a.median, a.maximum FROM salary_grade a LEFT JOIN jobs b ON a.job_id = b.job_id";

//         $res = execute_query($this->conn, $query, '');
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $data = array();
//             if ($res->numRows() > 0)
//             {
//                 $data['total'] = $res->numRows();
//                 $data['salary_grades'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//             else
//             {
//                 $data['total'] = 0;
//             }
//         }

//         return $data;
//         // $table_name = 'salary_grade';
//         // $result_types = array(
//         //         'sal_grd_id' => 'integer',
//         //         'gr_lvl' => 'text',
//         //         'rank' => 'text',
//         //         'classification' => 'text',
//         //         'minimum' => 'integer',
//         //         'median' => 'integer',
//         //         'maximum' => 'integer'
//         // );
//         // $data = array();
//         // if ($keyword != '')
//         // {
//         //     $where_clause = '';
//         //     $len = count($result_types);
//         //     $i = 0;
//         //     foreach ($result_types as $key => $value)
//         //     {
//         //         if ('id' != substr($key, -2))
//         //         {
//         //             $where_clause .= "$key like '%$keyword%'";
//         //             if ($i != $len - 1)
//         //                 $where_clause .= ' OR ';
//         //         }
//         //         $i++;
//         //     }
//         //     $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, $where_clause, null, true, $result_types);
//         // }
//         // else
//         //     $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, null, null, true, $result_types);

//         // if (PEAR::isError($res))
//         // {
//         //     die($res->getMessage());
//         // }
//         // else
//         // {
//         //     $data = array();
//         //     if ($res->numRows() > 0)
//         //     {
//         //         $data['total'] = $res->numRows();
//         //         $data['salary_grades'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//         //     }
//         // }
//         // return $data;
//     }

//     public function viewSalaryGradeById($sal_grd_id)
//     {
//         $table_name = 'salary_grade';
//         $result_types = array(
//                 // 'sal_grd_id' => 'integer',
//                 'gr_lvl' => 'text',
//                 'job_id' => 'integer',
//                 'classification' => 'text',
//                 'minimum' => 'integer',
//                 'median' => 'integer',
//                 'maximum' => 'integer'
//         );

//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "sal_grd_id = $sal_grd_id LIMIT 1", null, true, $result_types);
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $data = array();
//             if ($res->numRows() > 0)
//             {
//                 $data['total'] = $res->numRows();
//                 $data['salary_grades'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//         }
//         return $data;
//     }

//     public function DeleteRecord($sal_grd_id)
//     {
//         $query = "DELETE FROM salary_grade WHERE sal_grd_id = $sal_grd_id LIMIT 1";
//         $res = execute_query($this->conn, $query, '');

//     }

// }
?>