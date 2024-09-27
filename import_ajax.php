<?php

require 'PhpSpreadsheet-master/vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];


    // Check for upload errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filePath = $file['tmp_name']; // Temporary file path


        try {
            // Load the Excel file
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();


            foreach ($sheet->getRowIterator() as $rowindex => $row) {
                $rowIndex = $row->getRowIndex();  // Get the current row index

                // Skip the first two rows
                if ($rowIndex <= 2) {
                    continue;  // Skip to the next iteration
                }
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                foreach ($cellIterator as $cell) {
                    $test['data'][$rowindex][] = $cell->getValue();
                }
            }
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            echo 'Error loading file: ' . htmlspecialchars($e->getMessage());
        } catch (Exception $e) {
            echo 'General error: ' . htmlspecialchars($e->getMessage());
        }
        echo json_encode($test);
    } else {
        echo 'File upload error: ' . htmlspecialchars($file['error']);
    }
} else {
    echo 'No file uploaded.';
}
