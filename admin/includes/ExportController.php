<?php
/**
 * Created by PhpStorm.
 * User: John Simms
 * Date: 2018/11/21
 * Time: 11:28
 */

namespace App;

use XLSXWriter;

class ExportController
{

    public $data,
        $file_type,
        $filename;

    private $server_file;

    private function export_excel()
    {
        $first_row = [];
        foreach ($this->data['columns'] as $column) {
            $first_row[] = strtoupper($column);
        }
        $excel_data = array_merge([$first_row], $this->data['rows']);

        $writer = new XLSXWriter();

        $writer->writeSheet($excel_data);

        header('Content-disposition: attachment; filename=' . $this->filename . ".xlsx");
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        flush();
        $writer->writeToStdOut();

        exit();
    }

    public function download()
    {

        if (!$this->filename) {
            $this->filename = time();
        }

        if ($this->file_type == "Excel") {
            $this->export_excel();
        } else {
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $this->filename . '.csv"');
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            $file = fopen('php://output', 'w');
            fputcsv($file, $this->data['columns']);
            foreach ($this->data['rows'] as $row) {
                fputcsv($file, $row);
            }
            exit();
        }
    }

}