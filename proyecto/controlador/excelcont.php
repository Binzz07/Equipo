<?php
require '../modelo/excel.php';

class ExcelController {

    private $excelModel;

    public function __construct($dbConnection) {
        $this->excelModel = new ExcelModel($dbConnection);
    }

    public function subirExcel() {
        if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == 0) {
            $fileTmpPath = $_FILES['excelFile']['tmp_name'];
            $fileName = $_FILES['excelFile']['name'];

            // Ruta donde se guardará el archivo temporalmente
            $filePath = 'uploads/' . $fileName;

            // Mover el archivo al directorio de subida
            if (move_uploaded_file($fileTmpPath, $filePath)) {
                // Procesar el archivo
                $resultado = $this->excelModel->procesarExcel($filePath);

                if ($resultado) {
                    echo "Datos cargados correctamente.";
                } else {
                    echo "Error al procesar el archivo.";
                }
            } else {
                echo "Error al subir el archivo.";
            }
        }
    }
}
