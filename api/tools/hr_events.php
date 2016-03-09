<?php
class HrEvents extends BaseOceanic
{
    public function __construct($conn)
    {
        $columns = array(
            'hr_events_id' => 'integer',
            'org_id' => 'integer',
            'title' => 'text',
            'location' => 'text',
            'start' => 'timestamp',
            'end' => 'timestamp',
            'created_by' => 'integer',
            'dt_created' => 'timestamp',
            'modified_by' => 'integer',
            'dt_last_modified' => 'timestamp'
            );
        $uks = array(array('title', 'location', 'start', 'end'));
        $viewable = array(
            'hr_events_id' => 'integer',
            'title' => 'text',
            'location' => 'text',
            'start' => 'timestamp',
            'end' => 'timestamp'
            );

        $searchable = $viewable;
        unset($searchable['hr_events_id']);

        $required = array('title', 'location', 'start', 'end', 'created_by', 'dt_created');
        $updateable = array('title', 'location', 'start', 'end', 'modified_by', 'dt_last_modified');

        parent::__construct($conn, 'hr_events', $columns, 'hr_events_id', $uks, $viewable, $searchable, $required, $updateable);
    }
}
?>