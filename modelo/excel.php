<?php
require '../modelo/PhpSpreadsheet-3.3.0/src/PhpSpreadsheet/IOFactory.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
class ExcelModel {
    private $conn;
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
    public function procesarExcel($filePath) {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            foreach ($sheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }
                if (count($data) >= 3) {
                    $cedula = $data[0];
                    $usuario = $data[1];
                    $nombre = $data[2];
                    $query = "INSERT INTO usuarios (cedula, usuario, nombre) VALUES (?, ?, ?)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param("sss", $cedula, $usuario, $nombre);
                    $stmt->execute();
                }
            }
            return true; 
        } catch (Exception $e) {
            return false; 
        }
    }
}
