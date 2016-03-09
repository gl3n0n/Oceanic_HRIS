<?php
class Organization extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'org_id' => 'integer',
            'org_name' => 'text',
            'logo' => 'text',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('org_name'));
        $viewable = array(
            'org_id' => 'integer',
            'org_name' => 'text',
            'logo' => 'text'
            );

        $searchable = $viewable;
        unset($searchable['org_id']);

        $required = array('org_name', 'logo', 'created_by', 'dt_created');
        $updateable = array('logo', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'organization', $columns, 'org_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}
?>