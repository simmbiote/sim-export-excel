<?php
/**
 * Created by PhpStorm.
 * User: John Simms
 * Date: 2018/11/21
 * Time: 11:30
 */

namespace App;

class Exporter
{

    public $post_type;

    private function get_data()
    {

        $cols = [];
        $columns = [];
        $rows = [];

        if (!$this->post_type) return false;

        switch ($this->post_type) {
            case "flamingo_inbound":

                /* COLUMNS */

                $cols = [
                    'ID' => __('Item ID', 'sim-export'),
                    'post_date' => __('Date', 'sim-export'),
                    'post_title' => __('Subject', 'sim-export'),
                    'post_status' => __('Status', 'sim-export'),
                ];

                global $wpdb;

                $fields_query = "SELECT " . " DISTINCT({$wpdb->postmeta}.meta_key) as meta_field FROM {$wpdb->posts}
LEFT JOIN {$wpdb->postmeta} on {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
where {$wpdb->posts}.post_type = '{$this->post_type}'";

                $custom_fields = $wpdb->get_results($fields_query, OBJECT);

                $skip_fields = [
                    '_akismet',
                    '_subject',
                    '_from',
                    '_fields',
                    '_meta',
                    '_wp_trash_meta_status',
                    '_wp_trash_meta_time',
                    '_wp_desired_post_slug',
                ];

                foreach ($custom_fields as $key => $value) {

                    if (in_array($value->meta_field, $skip_fields)) continue;
                    $label = ucwords(trim(str_replace('_', ' ', $value->meta_field)));
                    if (substr($label, 0, strlen('Field ')) == 'Field ') {
                        $label = __(substr($label, strlen('Field ')), 'sim-export');
                    }

                    $cols[$value->meta_field] = $label;
                }

                foreach ($cols as $column => $label) {
                    $columns[] = $label ? $label : ucwords(str_replace('_', ' ', $column));
                }

                /* ROWS */

                $items = get_posts(['post_type' => $this->post_type, 'posts_per_page' => 1000]);

                foreach ($items as $item) {
                    $item_row = [];
                    foreach ($cols as $field => $label) {
                        switch ($field) {
                            case 'ID':
                            case 'post_date':
                            case 'post_title':
                            case 'post_status':
                                $item_row[] = $item->$field;
                                break;
                            default:

                                $value = get_post_meta($item->ID, $field, true);
                                if (is_array($value)) {
                                    $value = implode('; ', $value);
                                }
                                $item_row[] = $value;
                        }
                    }

                    $rows[] = $item_row;
                }
                break;

        }

        $data = [
            'columns' => $columns,
            'rows' => $rows
        ];

        return $data;
    }


    public function do_export()
    {

        $export = new ExportController;

        $export->filename = 'Export.' . $this->post_type . '.' . date("Ymd") . '';
        $export->data = $this->get_data();
        $export->file_type = "Excel";
        $export->download();

    }

}