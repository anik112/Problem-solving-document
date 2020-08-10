<?php

$doctorNameList = ['Pranta', 'Shuvo'];

$doctorsFbList = [
    'Pranta' => 'http://m.me/paulanik112',
    'Shuvo' => 'http://m.me/Shuvo.ix'
];

$doctorsZoomList=[
    'Pranta' => 'https://us04web.zoom.us/j/2950190800?pwd=NENQVjg4NlVRTWY1ZHYvSGI3VjB1Zz09',
    'Shuvo' => 'https://us04web.zoom.us/j/2950190800?pwd=NENQVjg4NlVRTWY1ZHYvSGI3VjB1Zz09'
];

$doctorsMeetList=[
    'Pranta' => 'https://meet.google.com/eqb-kkar-ifn',
    'Shuvo' => 'https://us04web.zoom.us/j/2950190800?pwd=NENQVjg4NlVRTWY1ZHYvSGI3VjB1Zz09'
];

require('dbConnect.php');

if (isset($_POST['submit'])) {
    echo 'requestToDoctor </br>';
    $patientId = 1;
    $patientName = $_POST['patientNames'];
    $patientNumber = $_POST['patientNumbers'];
    $doctorId = $_POST['doctor'];
    $doctorNm = $doctorNameList[$doctorId];


    try {
        $insertData = $connect->prepare("INSERT INTO `tb_patient_pendding_list` (`patient_id`, `doctor_id`, `patient_name`, `patient_number`, `doctor_name`) 
        VALUES ($patientId,$doctorId,'$patientName','$patientNumber','$doctorNm')");
        $insertData->execute();
    } catch (Exception $e) {
        // if create problrm when connection, then show error massage
        echo $e;
    }
}

$getData = $connect->prepare("SELECT * FROM tb_patient_pendding_list");
$getData->execute();
$dataLists = $getData->fetchAll(PDO::FETCH_OBJ);

/*
if (!function_exists('requestToDoctor')) {
    function requestToDoctor($connect, $doctorId, $doctorNm)
    {
        echo 'requestToDoctor';
        $patientId = 1;
        $patientName = $_POST['patientNames'];
        $patientNumber = $_POST['patientNumbers'];
        $insertData = $connect->prepare("INSERT INTO `tb_patient_pendding_list`(`patient_id`, `doctor_id`, `patient_name`, `patient_number`, `doctor_name`)
        VALUES
        ($patientId,$doctorId,$patientName,$patientNumber,$doctorNm);");
        $insertData->execute() or die('Sorry data not insert.. friend'); // statement execute
    }
}
*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.min.js"></script>
</head>

<body>
    <div class="card bg-primary">
        <h1 style="color: white;">Patient Dashboard</h1>
    </div>
    <div class='container'>
        <div class="card my-5">
            <div class="card-body">
                <div class="row">
                    <?php foreach ($dataLists as $list) :
                        if ($list->check_status == 1) : ?>
                            <div class="col-md-12">
                                <h5 style="color: green;">You Have A Appointment From ( Dr.<?php echo $list->doctor_name ?> And Time Is <?php echo $list->apt_time; ?> )</h5>
                                <strong class="mr-3" style="color: red">Click For Connection On:</strong>
                                <a href="<?php echo $doctorsFbList[$list->doctor_name];?>" class="stretched-link">| Facebook</a>
                                <a href="<?php echo $doctorsZoomList[$list->doctor_name];?>" class="stretched-link ml-2">| ZOOM </a>
                                <a href="<?php echo $list->doctor_meet_links;?>" class="stretched-link ml-2">| Google Meet </a>
                                <a href="<?php echo $list->doctor_whatsapp_links;?>" class="stretched-link ml-2">| WhatsApp </a>
                            </div>
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>

        <div class='title my-5'>
            <h2>Fill this option</h2>
        </div>
        <div class='row border-top'>
            <div class='col-lg-12 my-2'>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class='float-left'>
                        <div class='form-group'>
                            <input type="text" name="patientNames" id="" class='form-control my-2' placeholder='Name' required>
                            <input type="text" name="patientNumbers" id="" class='form-control my-2' placeholder='Number' required>
                            <h5 class='my-3'>Choose the Doctor from List:</h5>
                            <div class='my-3'></div>
                            <?php $i = 0;
                            foreach ($doctorNameList as $doctorName) : ?>
                                <input type="radio" name="doctor" value="<?php echo $i ?>" class='mx-2'> <?php echo $doctorName ?>
                            <?php $i++;
                            endforeach; ?>
                        </div>
                        <div class="form-group my-5">
                            <input type="submit" name='submit' value="submit" class='btn btn-outline-primary px-5' style="width: 200px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>