<?php
class Employee extends BaseOceanic
{
    public function __construct($conn)
    {
        $this->session = $_SESSION;
        $columns = array(
            'employee_id' => 'integer',
            'org_id' => 'integer',
            'lastname' => 'text',
            'firstname' => 'text',
            'middlename' => 'text',
            'dept_id' => 'text',
            'position_id' => 'text',
            'empl_type_id' => 'text',
            'gender' => 'text',
            'address' => 'text',
            'tel_no' => 'text',
            'cell_no' => 'text',
            'civil_status' => 'text',
            'religion' => 'text',
            'date_hired' => 'date',
            'birthdate' => 'date',
            'birthplace' => 'text',
            'empl_status' => 'text',
            'sss' => 'text',
            'tin' => 'text',
            'pagibig' => 'text',
            'philhealth' => 'text',
            'tax_type' => 'text',
            'salary_grade' => 'text',
            'passport_no' => 'text',
            'passport_exp' => 'text',
            'date_resigned' => 'date',
            'seaman_book_no' => 'text',
            'seaman_book_exp' => 'text',
            'biometric_no' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('lastname', 'firstname', 'middlename'));

        $viewable = array_keys($columns);
        unset($viewable['created_by']);
        unset($viewable['dt_created']);
        unset($viewable['modified_by']);
        unset($viewable['dt_last_modified']);

        $searchable = $viewable;
        unset($searchable['employee_id']);

        $required = array('lastname', 'firstname', 'middlename', 'dept_id', 'position_id', 'empl_type_id', 'gender', 'civil_status', 'empl_status', 'created_by', 'dt_created');
        $updateable = array_keys($columns);
        unset($updateable['employee_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'employees', $columns, 'employee_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    public function viewDataById($id)
    {
        if ('SUPERVISORS' == $this->session['level'])
        {
            // $this->conn->loadModule('Extended');
            $where_clause = "a.".$this->primary_id_name." = ".$this->conn->quote($id, 'integer');

            return $this->selectData($where_clause);
        }
        else
            return parent::viewDataById($id);
    }

    protected function generateFilterWhereClause($where_clause, $filters)
    {
        if ('SUPERVISORS' == $this->session['level'])
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
        else
            return parent::generateFilterWhereClause($where_clause, $filters);
    }

    protected function generateSearchWhereClause($search_kw='')
    {
        if ('SUPERVISORS' == $this->session['level'])
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
        else
            return parent::generateSearchWhereClause($search_kw);
    }

    protected function selectData($where_clause=false)
    {
        if ('SUPERVISORS' == $this->session['level'])
        {
            $query ="SELECT a.employee_id, a.org_id, a.lastname, a.firstname, a.middlename, a.dept_id, a.position_id, a.empl_type_id, a.gender, a.address, a.tel_no, a.cell_no, a.civil_status, a.religion, a.date_hired, a.birthdate, a.birthplace, a.empl_status, a.sss, a.tin, a.pagibig, a.philhealth, a.tax_type, a.salary_grade, a.passport_no, a.passport_exp, a.date_resigned, a.seaman_book_no, a.seaman_book_exp, a.biometric_no, a.created_by, a.dt_created, a.modified_by, a.dt_last_modified, b.level FROM employees a LEFT JOIN users b ON a.employee_id = b.employee_id  WHERE (b.level NOT IN ('HR MANAGERS', 'SYS ADMIN') OR b.level IS NULL)";

            if (!empty($where_clause))
                $query .= " AND $where_clause";

            $res = execute_query($this->conn, $query, '');
            // print_r($res);
            if (!PEAR::isError($res))
            {
                $data = array('total' => 0, $this->table => array());
                if ($res->numRows() > 0)
                {
                    // print_r($res);
                    $data['total'] = $res->numRows();
                    $data[$this->table] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
                }

                return $data;
            }
            print_r($res);
            die($res->getMessage());
        }
        else
            return parent::selectData($where_clause);
    }
}

// class Employee
// {
//     public function Employee($conn, $lastname='', $firstname='', $middlename='', $dept_id='', $position_id='',
//                                     $gender='', $empl_type_id='', $address='', $tel_no='', $cell_no='', $civil_status='',
//                                     $religion='', $date_hired='', $birthdate='', $birthplace='', $empl_status='', $sss='',
//                                     $tin='', $pagibig='', $philhealth='', $tax_type='', $salary_grade='', $passport_no='',
//                                     $passport_exp='', $date_resigned='', $seaman_book_no='', $seaman_book_exp='', $biometric_no='')
//     {
//         $this->conn = $conn;
//         $this->lastname = $lastname;
//         $this->firstname = $firstname;
//         $this->middlename = $middlename;
//         $this->dept_id = $dept_id;
//         $this->position_id = $position_id;
//         $this->gender = $gender;
//         $this->empl_type_id = $empl_type_id;
//         $this->address = $address;
//         $this->tel_no = $tel_no;
//         $this->cell_no = $cell_no;
//         $this->civil_status = $civil_status;
//         $this->religion = $religion;
//         $this->date_hired = $date_hired;
//         $this->birthdate = $birthdate;
//         $this->birthplace = $birthplace;
//         $this->empl_status = $empl_status;
//         $this->sss = $sss;
//         $this->tin = $tin;
//         $this->pagibig = $pagibig;
//         $this->philhealth = $philhealth;
//         $this->tax_type = $tax_type;
//         $this->salary_grade = $salary_grade;
//         $this->passport_no = $passport_no;
//         $this->passport_exp = $passport_exp;
//         $this->date_resigned = $date_resigned;
//         $this->seaman_book_no = $seaman_book_no;
//         $this->seaman_book_exp = $seaman_book_exp;
//         $this->biometric_no = $biometric_no;
//     }

//     public function checkDeptCode()
//     {
//         $table_name = 'departments';
//         $result_types = array(
//                 'dept_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'dept_code="'.$this->dept_code.'"', null, true, $result_types);
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
//         }
//         return $row['dept_id'];
//     }

//     public function checkDeptId($dept_id)
//     {
//         $table_name = 'departments';
//         $result_types = array(
//                 'dept_id' => 'integer'
//         );
//         $data = array();
//         $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, 'dept_id='.$dept_id, null, true, $result_types);
//         if (PEAR::isError($res))
//         {
//             die($res->getMessage());
//         }
//         else
//         {
//             $row = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
//         }
//         $res = ($row['dept_id'] != ''? true : False);
//         return $res;
//     }

//     public function CreateEmployee()
//     {
//         $time = date('Y-m-d H:i:s');
//         $table_name = 'employees';
//         $table_fields = array('lastname', 'firstname', 'middlename', 'dept_id', 'position_id', 'gender', 'empl_type_id',
//                             'address', 'tel_no', 'cell_no', 'civil_status', 'religion', 'date_hired', 'birthdate',
//                             'birthplace', 'empl_status', 'sss', 'tin', 'pagibig', 'philhealth', 'tax_type',
//                             'salary_grade', 'passport_no', 'passport_exp', 'date_resigned', 'seaman_book_no', 'seaman_book_exp', 'biometric_no',
//                             'created_by', 'dt_created');




//        /*
//         $conn, $lastname='', $firstname='', $middlename='', $dept_id='', $position_id='',
//                                     $gender='', $empl_type_id='', $address='', $tel_no='', $cell_no='', $civil_status='',
//                                     $religion='', $date_hired='', $birthdate='', $birthplace='', $empl_status='', $sss='',
//                                     $tin='', $pagibig='', $philhealth='', $tax_type='', $salary_grade='', $passport_no='',
//                                     $passport_exp='', $date_resigned='', $seaman_book_no='', $seaman_book_exp='', $biometric_no=''
//        */


//         $types = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text',
//                         'text', 'text', 'text', 'timestamp');
//         $sth = $this->conn->extended->autoPrepare($table_name, $table_fields, MDB2_AUTOQUERY_INSERT, null, $types);
//         $table_values = array($this->lastname, $this->firstname, $this->middlename, $this->dept_id, $this->position_id, $this->gender, $this->empl_type_id,
//                             $this->address, $this->tel_no, $this->cell_no, $this->civil_status, $this->religion, $this->date_hired, $this->birthdate,
//                             $this->birthplace, $this->empl_status, $this->sss, $this->tin, $this->pagibig, $this->philhealth, $this->tax_type,
//                             $this->salary_grade, $this->passport_no, $this->passport_exp, $this->date_resigned, $this->seaman_book_no, $this->seaman_book_exp, $this->biometric_no,
//                         $_SESSION['user_id'], $time);

//         $res =& $sth->execute($table_values);
//         $lastInsert = $this->conn->lastInsertID();
//         if (PEAR::isError($res)) {
//             die($res->getMessage());
//         }
//         else
//             return $lastInsert;
//     }

//     public function UpdateDept($dept_id)
//     {
//         $table_name = 'departments';
//         $field_values   = array(
//                       'name' => $this->name,
//                       'location' => $this->location,
//                       'headed_by' => $this->headed_by,
//                       'parent_dept' => $this->parent_dept,
//                       'modified_by' => $_SESSION['user_id']
//                );
//         $types  = array('text', 'text', 'text', 'text', 'text');
//         $res = $this->conn->extended->autoExecute($table_name, $field_values, MDB2_AUTOQUERY_UPDATE, 'dept_id = "'.$dept_id.'" LIMIT 1', $types);
//     }

//     public function viewEmployee($keyword='')
//     {
//         $table_name = 'employees';
//         $result_types = array(
//                 'employee_id' => 'integer',
//                 'lastname' => 'text',
//                 'firstname' => 'text',
//                 'middlename' => 'text',
//                 'empl_status' => 'text'

//         );
//         $data = array();
//         if($keyword != '')
//             $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, "lastname like '%$keyword%'", null, true, $result_types);
//         else
//             $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, null, null, true, $result_types);
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
//                 $data['employees'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//         }
//         return $data;
//     }

//     public function viewEmployeeRecord($employee_id='')
//     {
//         $data = array();
//         $query = "select * from employees WHERE employee_id = $employee_id LIMIT 1";
//         $res = execute_query($this->conn, $query, '');
//         // $res = $this->conn->extended->autoExecute($table_name, null, MDB2_AUTOQUERY_SELECT, null, null, true, $result_types);
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
//                 $data['position'] = $res->fetchAll(MDB2_FETCHMODE_ASSOC);
//             }
//             else
//             {
//                 $data['total'] = 0;
//             }
//         }
//         return $data;
//     }

// }

?>