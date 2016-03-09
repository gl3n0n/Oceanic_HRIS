<?php
class Division extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'division_id' => 'integer',
            'org_id' => 'integer',
            'division_code' => 'text',
            'description' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('division_code'));
        $viewable = array(
            'division_id' => 'integer',
            'division_code' => 'text',
            'description' => 'text'
            );

        $searchable = $viewable;
        unset($searchable['division_id']);

        $required = array('division_code', 'description', 'created_by', 'dt_created');
        $updateable = array('description', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'division', $columns, 'division_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}
?>