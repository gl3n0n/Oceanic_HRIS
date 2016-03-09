<?php
class LvForm extends BaseOceanicForm
{
    public function __construct($conn)
    {
        $this->session = $_SESSION;
        $columns = array(
            'leave_id' => 'integer',
            'org_id' => 'integer',
            'employee_id' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'leave_type' => 'text',
            'reason' => 'text',
            'status' => 'text',
            'sup_approved_by' => 'integer',
            'sup_approved_date' => 'timestamp',
            'sup_rejected_by' => 'integer',
            'sup_rejected_date' => 'timestamp',
            'man_approved_by' => 'integer',
            'man_approved_date' => 'timestamp',
            'man_rejected_by' => 'integer',
            'man_rejected_date' => 'timestamp',
            'reject_reason' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );

        $uks = array(array('employee_id', 'start_date', 'end_date'));
        $viewable = array_keys($columns);
        unset($viewable['created_by']);
        unset($viewable['dt_created']);
        unset($viewable['modified_by']);
        unset($viewable['dt_last_modified']);

        $searchable = $viewable;
        unset($searchable['leave_id']);
        unset($searchable['created_by']);
        unset($searchable['dt_created']);
        unset($searchable['modified_by']);
        unset($searchable['dt_last_modified']);

        $required = array('employee_id', 'start_date', 'end_date', 'leave_type', 'reason', 'status', 'created_by', 'dt_created');
        $updateable = array_keys($columns);
        unset($updateable['leave_id']);
        unset($updateable['employee_id']);
        unset($updateable['created_by']);
        unset($updateable['dt_created']);

        parent::__construct($conn, 'leave_applications', $columns, 'leave_id', $uks, $viewable, $searchable, $required, $updateable);
    }

    public function viewDataById($id)
    {
        // $this->conn->loadModule('Extended');
        $where_clause = "a.".$this->primary_id_name." = ".$this->conn->quote($id, 'integer');

        return $this->selectData($where_clause);
    }

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
        // $query = "SELECT a.empl_infraction_id, a.employee_id, a.policy_id, a.description, a.date_received, a.sanction, b.policy_code FROM employee_infraction a LEFT JOIN policies b ON a.policy_id = b.policy_id";
        $query ="SELECT a.leave_id, a.org_id, a.employee_id, a.start_date, a.end_date, a.leave_type, a.reason, a.status, a.sup_approved_by, a.sup_approved_date, a.sup_rejected_by, a.sup_rejected_date, a.man_approved_by, a.man_approved_date, a.man_rejected_by, a.man_rejected_date, b.firstname, b.middlename, b.lastname FROM leave_applications a INNER JOIN employees b ON a.employee_id = b.employee_id";

        if ('SUPERVISORS' == $this->session['level'])
        {
            $user_id = $this->session['user_id'];
            if (!empty($where_clause))
                $where_clause .= ' AND ';
            // $where_clause .= "((a.sup_approved_by = $user_id AND a.status != 'REJECTED') OR (a.sup_rejected_by = $user_id AND a.status NOT IN ('MAN-APPROVED', 'SUP-APPROVED')))";
            $where_clause .= "(a.employee_id = ".$this->session['employee_id']." OR ((a.sup_approved_by = $user_id AND a.sup_rejected_by = 0) OR (a.sup_approved_by = 0 AND a.sup_rejected_by = $user_id) OR (a.sup_approved_by = 0 AND a.sup_rejected_by = 0 AND a.man_approved_by = 0 AND a.man_rejected_by = 0)))";
        }

        if (!empty($where_clause))
            $query .= " WHERE $where_clause";

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
}
?>