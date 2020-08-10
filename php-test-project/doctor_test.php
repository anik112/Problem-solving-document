<?php

require('dbConnect.php');
$doctorNameList = ['Pranta', 'Shuvo'];

$doctorsZoomList=[
    'Pranta' => 'https://us04web.zoom.us/s/2950190800?pwd=NENQVjg4NlVRTWY1ZHYvSGI3VjB1Zz09',
    'Shuvo' => 'https://us04web.zoom.us/s/2950190800?pwd=NENQVjg4NlVRTWY1ZHYvSGI3VjB1Zz09'
];

// get url and trim url
//$url = trim( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/' );
// $parts=explode('/',$url);
// foreach($parts as $part){
//     echo '</br>';
//     echo $part; 
// }

$getData = $connect->prepare("SELECT * FROM tb_patient_pendding_list");
$getData->execute();
$dataLists = $getData->fetchAll(PDO::FETCH_OBJ);

foreach ($dataLists as $ls) {
    if (array_key_exists("$ls->patient_id", $_POST)) {
        echo $ls->patient_id;
        $waLink='https://wa.me/88'.$_POST['whatsAppNumber'];
        $meetLink=$_POST['meetLinks'];
        updateTime($connect, $ls->patient_id, $_POST['time'], $_POST['id'],$waLink,$meetLink);
        header("Refresh:0");
    }
}


function updateTime($connect, $patient_id, $time, $doctor_id, $doctorWaLink, $doctorMeetLink)
{
    $insertData = $connect->prepare("UPDATE `tb_patient_pendding_list` SET `check_status`=1,`apt_time`='$time', `doctor_meet_links`='$doctorMeetLink',`doctor_whatsapp_links`='$doctorWaLink' WHERE `patient_id`=$patient_id AND `doctor_id`=$doctor_id");
    $insertData->execute() or die("Data not update..");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.min.js"></script>
</head>

<body>
<div class="card bg-primary">
        <h1 style="color: white;">Patient Dashboard</h1>
    </div>
    <div class="container my-1">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <?php foreach ($dataLists as $list) : ?>
                    <div class="col-sm-4">
                        <div class="card my-5">
                            <div class="card-body">
                                <input type="text" name="id" value="<?php echo $list->doctor_id ?>" class="my-3 pr-3" style="width: 50px;">  Dector Name: <?php echo $list->doctor_name; ?>
                                <?php if ($list->check_status == 1) : ?>
                                    <h5 style="color: green;">Appointment Time: <?php echo $list->apt_time;?></h5>
                                    <h5>Patient Name: <?php echo $list->patient_name ?></h5>
                                    <input type="text" name="time" id="" class="form-control my-2" value='<?php echo $list->apt_time;?>' readonly>
                                    <input type="text" name="meetLinks" id="" class="form-control my-2" value="<?php echo $list->doctor_meet_links;?>" readonly>
                                    <input type="text" name="whatsAppNumber" id="" class="form-control my-2" value="<?php echo $list->doctor_whatsapp_links;?>" readonly>
                                    <a href="<?php echo $doctorsZoomList[$list->doctor_name];?>" class="btn btn-outline-primary px-5"> Get Meeting On ZOOM </a>
                                <?php endif; ?>
                                <?php if ($list->check_status != 1) : ?>
                                    <h5 style="color: firebrick;">Pandding</h5>
                                    <h5>Patient Name: <?php echo $list->patient_name ?></h5>
                                    <input type="text" name="time" id="" class="form-control my-2" placeholder="Time">
                                    <input type="text" name="meetLinks" id="" class="form-control my-2" placeholder="Meet Link">
                                    <input type="text" name="whatsAppNumber" id="" class="form-control my-2" placeholder="WhatsApp Number Eg: 017851..">
                                    <input type="submit" name="<?php echo $list->patient_id ?>" value="Add In List" class="btn btn-outline-primary px-5" />
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
</body>

</html>