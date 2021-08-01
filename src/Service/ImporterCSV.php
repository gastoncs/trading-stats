<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/20/21
 * Time: 5:59 PM
 */

namespace App\Service;

class ImporterCSV
{
    public static function importCSV($file)
    {
        $arrRow = [];
        $i = 0;

        try{

            if (($fp = fopen($file, "r")) !== FALSE) {

                while (($row = fgetcsv($fp, 1000, ",")) !== FALSE) {
                    $num = count($row);

                    $i++;
                    for ($c=0; $c < $num; $c++) {
                        $arrRow[$i][] = $row[$c];
                    }
                }
                fclose($fp);

                return $arrRow;
            }
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }
}