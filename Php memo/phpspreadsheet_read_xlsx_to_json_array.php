<?php

function phpspreadsheet_read_xlsx($excel)
{
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($excel);
    $row_array = $spreadsheet->getActiveSheet()->toArray(null, true, false, false);

    $rows_total_size = count($row_array); //include empty cells rows

    $fields_array = array_filter($row_array[0]);
    $content_array = [];
    $fields_index_array = array_keys($fields_array);
    for ($n = 1; $n < $rows_total_size; $n++) {
        $temp = array_filter($row_array[$n]);
        if (!empty($temp)) { //remove empty cells rows
                array_push($content_array, $row_array[$n]);
        }
    }
    $JSON_EXCEL = [];
    $JSON_ITEMS = [];
    foreach ($content_array as $content_item) {
        $JSON_ITEMS = [];
        foreach ($fields_index_array as $field_index) {
            if (isset($content_item[trim($field_index)])) {
                if (!empty(trim($content_item[trim($field_index)]))) {
                    $JSON_ITEMS[trim($fields_array[trim($field_index)])] = trim(strval($content_item[$field_index]));
                } else {
                    $JSON_ITEMS[trim($fields_array[trim($field_index)])] = '';
                }
            } else {
                $JSON_ITEMS[trim($fields_array[trim($field_index)])] = '';
            }
        }
        array_push($JSON_EXCEL, $JSON_ITEMS);
    }


    return $JSON_EXCEL;
}
