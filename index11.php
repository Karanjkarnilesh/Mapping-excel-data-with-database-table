<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Hello, world!</title>
    <style>
        .table>tbody {
    vertical-align: middle;
}
        </style>
</head>

<body>
    <h1>Excel data mapping with database Column</h1>

    <div>
        <label for="formFileLg" class="form-label">File input</label>
        <input class="form-control form-control-lg" name="file" id="file" type="file">
    </div>

    <div class="" id="here_table" style="margin-top: 20px;">
        <table class="table table-bordered border-primary">
            <thead>
                <tr class="table_header">

                </tr>
            </thead>
            <tbody class="table_data">

            </tbody>
        </table>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var fileData;
            $('#file').on('change', function() {
                var headerArray = [
                    'Acct Number', 'Debtor1 Name', 'Debtor1 Address1', 'Debtor1 Address2', 'Debtor1 City', 'Debtor1 County', 'Debtor1 State',
                    'Debtor1 Zip', 'Debtor1 Ph#', 'Debtor1 SSN', 'Debtor1 DOB', 'Debtor1 Employer Name', 'Debtor1 Emp Address', 'Debtor1 Emp State',
                    'Debtor1 Emp ZIP', 'Debtor1 Emp Ph#', 'Debtor2 Name', 'Debtor2 Address1', 'Debtor2 Address2', 'Debtor2 City', 'Debtor2 County',
                    'Debtor2 State', 'Debtor2 Zip', 'Debtor2 Ph#', 'Debtor2 SSN', 'Debtor2 DOB', 'Debtor2 Employer Name', 'Debtor2 Emp Address',
                    'Debtor2 Emp State', 'Debtor2 Emp ZIP', 'Debtor2 Emp Ph#', 'Orig Acct #', 'Orig Creditor', 'Interest Rate', 'Last Interest Post Date',
                    'Contract Date', 'Chargeoff Date', 'Prin Due', 'Other Due', 'Int Due', 'Total Due', 'Jgmt Date',
                    'Jdmt Case #', 'Jdmt Court', 'Jdmt Amt Awarded', 'Jdmt County', 'Jdmt State', 'STATUS', 'Last Pmt Dt',
                    'Last Pmt Amt'
                ];
                var validations = [
                    /^[0-9A-Za-z#\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[A-Za-z&()\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9A-Za-z#/&\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(-?\d+(\.\d{1,2})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/

                ]
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {

                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // Get the first sheet
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    // Convert sheet to JSON
                    fileHeader = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    })[2];

                    if (compareHeaders(headerArray, fileHeader)) {

                        fileData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1,
                            raw: true
                        }).slice(3);
                        
                        if (fileData) {
                            $.each(fileData, function(i, row) {
                                $('.table_data').append('<tr>');
                                $.each(row, function(index, value) {
                                   
                                    if (value) {
                                        $(".table_data").append('<td>' + value + '</td>');
                                        if (validations[index].test(value)) {
                                           
                                        } else {
                                            alert(value + " Data not allowed Please Convert value in Text ,Number DataType");
                                        }
                                    }else{
                                        $(".table_data").append('<td>' + ' ' + '</td>');
                                    }

                                });
                                $('.table_data').append('</tr>');
                            })
                            // var file_data = $('#file').prop('files')[0];
                            // var form_data = new FormData();
                            // form_data.append('file', file_data);
                            // $.ajax({
                            //     url: 'import_ajax.php', // Point to server-side PHP script 
                            //     dataType: 'json', // Expecting a JSON response
                            //     cache: false,
                            //     contentType: false,
                            //     processData: false,
                            //     data: form_data,
                            //     type: 'POST', // Ensure the type is POST for file uploads
                            //     success: function(response) {
                            //         // The response is already parsed as JSON
                            //         console.log('Server Response:',JSON.parse(response));

                            //         if (response.status === 'success') {
                            //             console.log('File uploaded successfully:', response.fileName);
                            //         } else {
                            //             console.log('Error:', response.message);
                            //         }
                            //     },
                            //     error: function(xhr, status, error) {
                            //         console.log('AJAX Error:', error);
                            //         console.log('Response Text:', JSON.parse(xhr.responseText)); // This will show any HTML errors (e.g., PHP errors)
                            //     }
                            // });

                        }



                    }



                }

                reader.readAsArrayBuffer(file);

            });

            function compareHeaders(headerArray, arrayData) {

                const missingHeaders = headerArray.filter(header => !arrayData.includes(header));
                const extraHeaders = arrayData.filter(header => !headerArray.includes(header));

                if (missingHeaders.length > 0 || extraHeaders.length > 0) {
                    alert('Missing Headers:' + missingHeaders);
                }
                $.each(arrayData, function(i, row) {
                    $(".table_header").append('<th>' + row + '</th>');

                });
                return true;
            }
        });
    </script>
</body>

</html><!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Hello, world!</title>
    <style>
        .table>tbody {
    vertical-align: middle;
}
        </style>
</head>

<body>
    <h1>Excel data mapping with database Column</h1>

    <div>
        <label for="formFileLg" class="form-label">File input</label>
        <input class="form-control form-control-lg" name="file" id="file" type="file">
    </div>

    <div class="" id="here_table" style="margin-top: 20px;">
        <table class="table table-bordered border-primary">
            <thead>
                <tr class="table_header">

                </tr>
            </thead>
            <tbody class="table_data">

            </tbody>
        </table>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var fileData;
            $('#file').on('change', function() {
                var headerArray = [
                    'Acct Number', 'Debtor1 Name', 'Debtor1 Address1', 'Debtor1 Address2', 'Debtor1 City', 'Debtor1 County', 'Debtor1 State',
                    'Debtor1 Zip', 'Debtor1 Ph#', 'Debtor1 SSN', 'Debtor1 DOB', 'Debtor1 Employer Name', 'Debtor1 Emp Address', 'Debtor1 Emp State',
                    'Debtor1 Emp ZIP', 'Debtor1 Emp Ph#', 'Debtor2 Name', 'Debtor2 Address1', 'Debtor2 Address2', 'Debtor2 City', 'Debtor2 County',
                    'Debtor2 State', 'Debtor2 Zip', 'Debtor2 Ph#', 'Debtor2 SSN', 'Debtor2 DOB', 'Debtor2 Employer Name', 'Debtor2 Emp Address',
                    'Debtor2 Emp State', 'Debtor2 Emp ZIP', 'Debtor2 Emp Ph#', 'Orig Acct #', 'Orig Creditor', 'Interest Rate', 'Last Interest Post Date',
                    'Contract Date', 'Chargeoff Date', 'Prin Due', 'Other Due', 'Int Due', 'Total Due', 'Jgmt Date',
                    'Jdmt Case #', 'Jdmt Court', 'Jdmt Amt Awarded', 'Jdmt County', 'Jdmt State', 'STATUS', 'Last Pmt Dt',
                    'Last Pmt Amt'
                ];
                var validations = [
                    /^[0-9A-Za-z#\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[A-Za-z&()\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9A-Za-z#/&\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(-?\d+(\.\d{1,2})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/

                ]
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {

                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // Get the first sheet
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    // Convert sheet to JSON
                    fileHeader = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    })[2];

                    if (compareHeaders(headerArray, fileHeader)) {

                        fileData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1,
                            raw: true
                        }).slice(3);
                        
                        if (fileData) {
                            $.each(fileData, function(i, row) {
                                $('.table_data').append('<tr>');
                                $.each(row, function(index, value) {
                                   
                                    if (value) {
                                        $(".table_data").append('<td>' + value + '</td>');
                                        if (validations[index].test(value)) {
                                           
                                        } else {
                                            alert(value + " Data not allowed Please Convert value in Text ,Number DataType");
                                        }
                                    }else{
                                        $(".table_data").append('<td>' + ' ' + '</td>');
                                    }

                                });
                                $('.table_data').append('</tr>');
                            })
                            // var file_data = $('#file').prop('files')[0];
                            // var form_data = new FormData();
                            // form_data.append('file', file_data);
                            // $.ajax({
                            //     url: 'import_ajax.php', // Point to server-side PHP script 
                            //     dataType: 'json', // Expecting a JSON response
                            //     cache: false,
                            //     contentType: false,
                            //     processData: false,
                            //     data: form_data,
                            //     type: 'POST', // Ensure the type is POST for file uploads
                            //     success: function(response) {
                            //         // The response is already parsed as JSON
                            //         console.log('Server Response:',JSON.parse(response));

                            //         if (response.status === 'success') {
                            //             console.log('File uploaded successfully:', response.fileName);
                            //         } else {
                            //             console.log('Error:', response.message);
                            //         }
                            //     },
                            //     error: function(xhr, status, error) {
                            //         console.log('AJAX Error:', error);
                            //         console.log('Response Text:', JSON.parse(xhr.responseText)); // This will show any HTML errors (e.g., PHP errors)
                            //     }
                            // });

                        }



                    }



                }

                reader.readAsArrayBuffer(file);

            });

            function compareHeaders(headerArray, arrayData) {

                const missingHeaders = headerArray.filter(header => !arrayData.includes(header));
                const extraHeaders = arrayData.filter(header => !headerArray.includes(header));

                if (missingHeaders.length > 0 || extraHeaders.length > 0) {
                    alert('Missing Headers:' + missingHeaders);
                }
                $.each(arrayData, function(i, row) {
                    $(".table_header").append('<th>' + row + '</th>');

                });
                return true;
            }
        });
    </script>
</body>

</html><!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Hello, world!</title>
    <style>
        .table>tbody {
    vertical-align: middle;
}
        </style>
</head>

<body>
    <h1>Excel data mapping with database Column</h1>

    <div>
        <label for="formFileLg" class="form-label">File input</label>
        <input class="form-control form-control-lg" name="file" id="file" type="file">
    </div>

    <div class="" id="here_table" style="margin-top: 20px;">
        <table class="table table-bordered border-primary">
            <thead>
                <tr class="table_header">

                </tr>
            </thead>
            <tbody class="table_data">

            </tbody>
        </table>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var fileData;
            $('#file').on('change', function() {
                var headerArray = [
                    'Acct Number', 'Debtor1 Name', 'Debtor1 Address1', 'Debtor1 Address2', 'Debtor1 City', 'Debtor1 County', 'Debtor1 State',
                    'Debtor1 Zip', 'Debtor1 Ph#', 'Debtor1 SSN', 'Debtor1 DOB', 'Debtor1 Employer Name', 'Debtor1 Emp Address', 'Debtor1 Emp State',
                    'Debtor1 Emp ZIP', 'Debtor1 Emp Ph#', 'Debtor2 Name', 'Debtor2 Address1', 'Debtor2 Address2', 'Debtor2 City', 'Debtor2 County',
                    'Debtor2 State', 'Debtor2 Zip', 'Debtor2 Ph#', 'Debtor2 SSN', 'Debtor2 DOB', 'Debtor2 Employer Name', 'Debtor2 Emp Address',
                    'Debtor2 Emp State', 'Debtor2 Emp ZIP', 'Debtor2 Emp Ph#', 'Orig Acct #', 'Orig Creditor', 'Interest Rate', 'Last Interest Post Date',
                    'Contract Date', 'Chargeoff Date', 'Prin Due', 'Other Due', 'Int Due', 'Total Due', 'Jgmt Date',
                    'Jdmt Case #', 'Jdmt Court', 'Jdmt Amt Awarded', 'Jdmt County', 'Jdmt State', 'STATUS', 'Last Pmt Dt',
                    'Last Pmt Amt'
                ];
                var validations = [
                    /^[0-9A-Za-z#\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[A-Za-z&()\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9A-Za-z#/&\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(-?\d+(\.\d{1,2})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/

                ]
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {

                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // Get the first sheet
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    // Convert sheet to JSON
                    fileHeader = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    })[2];

                    if (compareHeaders(headerArray, fileHeader)) {

                        fileData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1,
                            raw: true
                        }).slice(3);
                        
                        if (fileData) {
                            $.each(fileData, function(i, row) {
                                $('.table_data').append('<tr>');
                                $.each(row, function(index, value) {
                                   
                                    if (value) {
                                        $(".table_data").append('<td>' + value + '</td>');
                                        if (validations[index].test(value)) {
                                           
                                        } else {
                                            alert(value + " Data not allowed Please Convert value in Text ,Number DataType");
                                        }
                                    }else{
                                        $(".table_data").append('<td>' + ' ' + '</td>');
                                    }

                                });
                                $('.table_data').append('</tr>');
                            })
                            // var file_data = $('#file').prop('files')[0];
                            // var form_data = new FormData();
                            // form_data.append('file', file_data);
                            // $.ajax({
                            //     url: 'import_ajax.php', // Point to server-side PHP script 
                            //     dataType: 'json', // Expecting a JSON response
                            //     cache: false,
                            //     contentType: false,
                            //     processData: false,
                            //     data: form_data,
                            //     type: 'POST', // Ensure the type is POST for file uploads
                            //     success: function(response) {
                            //         // The response is already parsed as JSON
                            //         console.log('Server Response:',JSON.parse(response));

                            //         if (response.status === 'success') {
                            //             console.log('File uploaded successfully:', response.fileName);
                            //         } else {
                            //             console.log('Error:', response.message);
                            //         }
                            //     },
                            //     error: function(xhr, status, error) {
                            //         console.log('AJAX Error:', error);
                            //         console.log('Response Text:', JSON.parse(xhr.responseText)); // This will show any HTML errors (e.g., PHP errors)
                            //     }
                            // });

                        }



                    }



                }

                reader.readAsArrayBuffer(file);

            });

            function compareHeaders(headerArray, arrayData) {

                const missingHeaders = headerArray.filter(header => !arrayData.includes(header));
                const extraHeaders = arrayData.filter(header => !headerArray.includes(header));

                if (missingHeaders.length > 0 || extraHeaders.length > 0) {
                    alert('Missing Headers:' + missingHeaders);
                }
                $.each(arrayData, function(i, row) {
                    $(".table_header").append('<th>' + row + '</th>');

                });
                return true;
            }
        });
    </script>
</body>

</html><!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Hello, world!</title>
    <style>
        .table>tbody {
    vertical-align: middle;
}
        </style>
</head>

<body>
    <h1>Excel data mapping with database Column</h1>

    <div>
        <label for="formFileLg" class="form-label">File input</label>
        <input class="form-control form-control-lg" name="file" id="file" type="file">
    </div>

    <div class="" id="here_table" style="margin-top: 20px;">
        <table class="table table-bordered border-primary">
            <thead>
                <tr class="table_header">

                </tr>
            </thead>
            <tbody class="table_data">

            </tbody>
        </table>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var fileData;
            $('#file').on('change', function() {
                var headerArray = [
                    'Acct Number', 'Debtor1 Name', 'Debtor1 Address1', 'Debtor1 Address2', 'Debtor1 City', 'Debtor1 County', 'Debtor1 State',
                    'Debtor1 Zip', 'Debtor1 Ph#', 'Debtor1 SSN', 'Debtor1 DOB', 'Debtor1 Employer Name', 'Debtor1 Emp Address', 'Debtor1 Emp State',
                    'Debtor1 Emp ZIP', 'Debtor1 Emp Ph#', 'Debtor2 Name', 'Debtor2 Address1', 'Debtor2 Address2', 'Debtor2 City', 'Debtor2 County',
                    'Debtor2 State', 'Debtor2 Zip', 'Debtor2 Ph#', 'Debtor2 SSN', 'Debtor2 DOB', 'Debtor2 Employer Name', 'Debtor2 Emp Address',
                    'Debtor2 Emp State', 'Debtor2 Emp ZIP', 'Debtor2 Emp Ph#', 'Orig Acct #', 'Orig Creditor', 'Interest Rate', 'Last Interest Post Date',
                    'Contract Date', 'Chargeoff Date', 'Prin Due', 'Other Due', 'Int Due', 'Total Due', 'Jgmt Date',
                    'Jdmt Case #', 'Jdmt Court', 'Jdmt Amt Awarded', 'Jdmt County', 'Jdmt State', 'STATUS', 'Last Pmt Dt',
                    'Last Pmt Amt'
                ];
                var validations = [
                    /^[0-9A-Za-z#\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[A-Za-z&()\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9A-Za-z#/&\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(-?\d+(\.\d{1,2})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/

                ]
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {

                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // Get the first sheet
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    // Convert sheet to JSON
                    fileHeader = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    })[2];

                    if (compareHeaders(headerArray, fileHeader)) {

                        fileData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1,
                            raw: true
                        }).slice(3);
                        
                        if (fileData) {
                            $.each(fileData, function(i, row) {
                                $('.table_data').append('<tr>');
                                $.each(row, function(index, value) {
                                   
                                    if (value) {
                                        $(".table_data").append('<td>' + value + '</td>');
                                        if (validations[index].test(value)) {
                                           
                                        } else {
                                            alert(value + " Data not allowed Please Convert value in Text ,Number DataType");
                                        }
                                    }else{
                                        $(".table_data").append('<td>' + ' ' + '</td>');
                                    }

                                });
                                $('.table_data').append('</tr>');
                            })
                            // var file_data = $('#file').prop('files')[0];
                            // var form_data = new FormData();
                            // form_data.append('file', file_data);
                            // $.ajax({
                            //     url: 'import_ajax.php', // Point to server-side PHP script 
                            //     dataType: 'json', // Expecting a JSON response
                            //     cache: false,
                            //     contentType: false,
                            //     processData: false,
                            //     data: form_data,
                            //     type: 'POST', // Ensure the type is POST for file uploads
                            //     success: function(response) {
                            //         // The response is already parsed as JSON
                            //         console.log('Server Response:',JSON.parse(response));

                            //         if (response.status === 'success') {
                            //             console.log('File uploaded successfully:', response.fileName);
                            //         } else {
                            //             console.log('Error:', response.message);
                            //         }
                            //     },
                            //     error: function(xhr, status, error) {
                            //         console.log('AJAX Error:', error);
                            //         console.log('Response Text:', JSON.parse(xhr.responseText)); // This will show any HTML errors (e.g., PHP errors)
                            //     }
                            // });

                        }



                    }



                }

                reader.readAsArrayBuffer(file);

            });

            function compareHeaders(headerArray, arrayData) {

                const missingHeaders = headerArray.filter(header => !arrayData.includes(header));
                const extraHeaders = arrayData.filter(header => !headerArray.includes(header));

                if (missingHeaders.length > 0 || extraHeaders.length > 0) {
                    alert('Missing Headers:' + missingHeaders);
                }
                $.each(arrayData, function(i, row) {
                    $(".table_header").append('<th>' + row + '</th>');

                });
                return true;
            }
        });
    </script>
</body>

</html><!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Hello, world!</title>
    <style>
        .table>tbody {
    vertical-align: middle;
}
        </style>
</head>

<body>
    <h1>Excel data mapping with database Column</h1>

    <div>
        <label for="formFileLg" class="form-label">File input</label>
        <input class="form-control form-control-lg" name="file" id="file" type="file">
    </div>

    <div class="" id="here_table" style="margin-top: 20px;">
        <table class="table table-bordered border-primary">
            <thead>
                <tr class="table_header">

                </tr>
            </thead>
            <tbody class="table_data">

            </tbody>
        </table>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var fileData;
            $('#file').on('change', function() {
                var headerArray = [
                    'Acct Number', 'Debtor1 Name', 'Debtor1 Address1', 'Debtor1 Address2', 'Debtor1 City', 'Debtor1 County', 'Debtor1 State',
                    'Debtor1 Zip', 'Debtor1 Ph#', 'Debtor1 SSN', 'Debtor1 DOB', 'Debtor1 Employer Name', 'Debtor1 Emp Address', 'Debtor1 Emp State',
                    'Debtor1 Emp ZIP', 'Debtor1 Emp Ph#', 'Debtor2 Name', 'Debtor2 Address1', 'Debtor2 Address2', 'Debtor2 City', 'Debtor2 County',
                    'Debtor2 State', 'Debtor2 Zip', 'Debtor2 Ph#', 'Debtor2 SSN', 'Debtor2 DOB', 'Debtor2 Employer Name', 'Debtor2 Emp Address',
                    'Debtor2 Emp State', 'Debtor2 Emp ZIP', 'Debtor2 Emp Ph#', 'Orig Acct #', 'Orig Creditor', 'Interest Rate', 'Last Interest Post Date',
                    'Contract Date', 'Chargeoff Date', 'Prin Due', 'Other Due', 'Int Due', 'Total Due', 'Jgmt Date',
                    'Jdmt Case #', 'Jdmt Court', 'Jdmt Amt Awarded', 'Jdmt County', 'Jdmt State', 'STATUS', 'Last Pmt Dt',
                    'Last Pmt Amt'
                ];
                var validations = [
                    /^[0-9A-Za-z#\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[A-Za-z&()\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^[a-zA-Z\s]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^[a-zA-Z/\s]+$/,
                    /^[a-zA-Z0-9\s,.#]+$/,

                    /^[a-zA-Z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9\s]+$/,
                    /^[0-9A-Za-z#/&\s]+$/,
                    /^[a-zA-Z\s]+$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(-?\d+(\.\d{1,2})?)$/,
                    /^(-?\d+(\.\d{2})?)$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,

                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[0-9\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^[A-Za-z\s]+$/,
                    /^(\d{0,2})\/(\d{0,2})\/(\d{0,4})$/,
                    /^(-?\d+(\.\d{1,3})?)$/

                ]
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {

                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // Get the first sheet
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];

                    // Convert sheet to JSON
                    fileHeader = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    })[2];

                    if (compareHeaders(headerArray, fileHeader)) {

                        fileData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1,
                            raw: true
                        }).slice(3);
                        
                        if (fileData) {
                            $.each(fileData, function(i, row) {
                                $('.table_data').append('<tr>');
                                $.each(row, function(index, value) {
                                   
                                    if (value) {
                                        $(".table_data").append('<td>' + value + '</td>');
                                        if (validations[index].test(value)) {
                                           
                                        } else {
                                            alert(value + " Data not allowed Please Convert value in Text ,Number DataType");
                                        }
                                    }else{
                                        $(".table_data").append('<td>' + ' ' + '</td>');
                                    }

                                });
                                $('.table_data').append('</tr>');
                            })
                            // var file_data = $('#file').prop('files')[0];
                            // var form_data = new FormData();
                            // form_data.append('file', file_data);
                            // $.ajax({
                            //     url: 'import_ajax.php', // Point to server-side PHP script 
                            //     dataType: 'json', // Expecting a JSON response
                            //     cache: false,
                            //     contentType: false,
                            //     processData: false,
                            //     data: form_data,
                            //     type: 'POST', // Ensure the type is POST for file uploads
                            //     success: function(response) {
                            //         // The response is already parsed as JSON
                            //         console.log('Server Response:',JSON.parse(response));

                            //         if (response.status === 'success') {
                            //             console.log('File uploaded successfully:', response.fileName);
                            //         } else {
                            //             console.log('Error:', response.message);
                            //         }
                            //     },
                            //     error: function(xhr, status, error) {
                            //         console.log('AJAX Error:', error);
                            //         console.log('Response Text:', JSON.parse(xhr.responseText)); // This will show any HTML errors (e.g., PHP errors)
                            //     }
                            // });

                        }



                    }



                }

                reader.readAsArrayBuffer(file);

            });

            function compareHeaders(headerArray, arrayData) {

                const missingHeaders = headerArray.filter(header => !arrayData.includes(header));
                const extraHeaders = arrayData.filter(header => !headerArray.includes(header));

                if (missingHeaders.length > 0 || extraHeaders.length > 0) {
                    alert('Missing Headers:' + missingHeaders);
                }
                $.each(arrayData, function(i, row) {
                    $(".table_header").append('<th>' + row + '</th>');

                });
                return true;
            }
        });
    </script>
</body>

</html>