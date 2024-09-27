<?php
include('Conn.php');
require 'PhpSpreadsheet-master/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];

    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(null, true, true, true);

    $databaseColumns = [];
    $databaseColumns = $_POST;
    $rowIndex = 0;
    $table = 'users';

    foreach ($data as $row) {
        $rowIndex++;

        if ($rowIndex <= 3) {
            continue;
        }

        $mappedData = [];
        $rowIndexeds = array_values($row);

        foreach ($rowIndexeds as $index => $rowIndexed) {
            if (isset($databaseColumns[$index])) {
                $mappedData[':' . $databaseColumns[$index]] = $cleanValue = str_replace(['$',','], '', $rowIndexed);
            }
        }

        $stmt = $conn->prepare("
        INSERT INTO users (
            acct_number, debtor1_name,debtor1_address1,debtor1_address2,debtor1_city,debtor1_county,debtor1_state,debtor1_zip,debtor1_phone,debtor1_ssn,debtor1_dob,debtor1_employer_name,debtor1_emp_address,
            debtor1_emp_state,debtor1_emp_zip,debtor1_emp_phone,debtor2_name,debtor2_address1,debtor2_address2,debtor2_city, debtor2_county, debtor2_state,
            debtor2_zip,debtor2_phone,debtor2_ssn,debtor2_dob,debtor2_employer_name,debtor2_emp_address,debtor2_emp_state,debtor2_emp_zip,debtor2_emp_phone,orig_acct_number,
            orig_creditor,interest_rate,last_interest_post_date,contract_date,chargeoff_date,
            prin_due,other_due,int_due,total_due,jdmt_date,jdmt_case_number,
            jdmt_court,jdmt_amt_awarded,jdmt_county,jdmt_state,
            status,last_pmt_date,last_pmt_amt
        ) 
        VALUES (
            :acct_number,:debtor1_name,:debtor1_address1,:debtor1_address2,:debtor1_city,:debtor1_county,:debtor1_state,:debtor1_zip,:debtor1_phone,:debtor1_ssn,:debtor1_dob,:debtor1_employer_name,:debtor1_emp_address,
            :debtor1_emp_state,:debtor1_emp_zip, :debtor1_emp_phone,:debtor2_name,:debtor2_address1,:debtor2_address2,:debtor2_city,:debtor2_county,:debtor2_state,
            :debtor2_zip,:debtor2_phone,:debtor2_ssn,:debtor2_dob,:debtor2_employer_name,:debtor2_emp_address,:debtor2_emp_state,:debtor2_emp_zip,:debtor2_emp_phone,:orig_acct_number,
            :orig_creditor,:interest_rate,:last_interest_post_date,:contract_date,:chargeoff_date,
            :prin_due, :other_due,:int_due,:total_due,:jdmt_date,:jdmt_case_number,
            :jdmt_court,:jdmt_amt_awarded,:jdmt_county,:jdmt_state,
            :status,:last_pmt_date,:last_pmt_amt
        )
    ");
        try {
            // Execute the prepared statement with mapped data
            if ($stmt->execute($mappedData)) {
                echo "Data successfully inserted.";
            } else {
               
                echo "Data insertion failed.";
            }
        } catch (PDOException $e) {
           
            echo "Error inserting data: " . $e->getMessage();
        }
    }
}
