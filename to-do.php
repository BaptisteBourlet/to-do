<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$jsonString = file_get_contents('to-do.json');
$data = json_decode($jsonString, true);

if (isset($_POST['tache'])) {

    $data[] = ["id" => count($data), "tache" => $_POST['tache'], "active"=>true];
    
    $codejson = json_encode($data,JSON_UNESCAPED_UNICODE);
    $depart = trim(filter_input(INPUT_POST, 'tache'));
    $depart = fopen("to-do.json", "w");

    fwrite($depart, $codejson);
    fclose($depart);
}
if (isset($_POST['namen'])) {
   
    //print_r($_POST['namen']);

    foreach ($_POST['namen'] as $id) {
            if ($data[$id]["active"] == true){
                $data[$id]['active'] = false;
                $newJsonString = json_encode($data);
                file_put_contents('to-do.json', $newJsonString);
            }
    }

    //$data[0]['active'] = true;
    
    // or if you want to change all entries with activity_code "1"
//    foreach ($data as  $entry) {
        //print_r($entry);
        //print_r($entry);

  /*      
        if ($entry['tache']) {
            $data[$key]['active'] = false;
            $newJsonString = json_encode($data);
            file_put_contents('to-do.json', $newJsonString);
        } */
 //   } 
                            
} else {
                                          
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="shortcut icon" type="image/png" href="https://pbs.twimg.com/profile_images/378800000765892928/49b0cf8a89026ef646eb696a8d1d13ea.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="to-do.css">
    <title>ma to-do list</title>
    
</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <h1 class="col-sm-12 titre">To-Do-List</h1>
        </div>
    </div>

    <div class="container-fluid to-do" id='to-do'>
        <div class="container">

            <form class="col-sm-12 todo" action="to-do.php" method="post">

                <div class="col-sm-12">
                    <p>A faire</p>
                </div>
                <ul id=sortable>
                <?php
                $json = file_get_contents("to-do.json");
                $parsed_json = json_decode($json);
                
                    if ($parsed_json) {
                        foreach ($parsed_json as $value) {
                            foreach ($value as $value2) {
                                if (!empty(trim($value2[0]))) {
                                    if ($value->active == true) {
                                        echo "<li class='drag'>
                                            <input type=checkbox name=namen[] value=" . $value->id. ">
                                            <label for=autre>".$value2."</label></li>";
                                            
                                    }
                                    else {
                                        
                                    }
                                }
                            }
                        }
                    } else {
                        echo "Il faut en rajouter pour en avoir";
                    }
                    ?>
                    </ul>
                <div class="col-sm-12">
                    <input type="submit" class="enregistrer" id= "submitbout" value="Enregistrer">
                </div>

            </form>
        </div>
    </div>
    <div class="container-fluid" id="x">
        <div class="container">

            <form class="col-sm-12">
                <div class="col-sm-12">
                    <p>Archive</p>
                </div>
               
               <?php 
                    if ($parsed_json) {
                        foreach ($parsed_json as $value) {
                            foreach ($value as $value2) {
                                if (!empty(trim($value2[0]))) {
                                    if ($value->active== false) {
                                        echo "<div class=col-sm-12>
                                        <label for=autre><s>".$value2."</s></label>                                      
                                        </div>";
                                    }else{
                                
                                    }
                                }
                            }
                        }
                    } else {
                           
                    }
                ?>
                
            </form>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <form class="col-sm-12" action="to-do.php" method="post">
                <div class="form-group purple-border col-sm-12">
                    <label for="Votre message">Votre tâche</label>
                    <textarea class="form-control" name="tache" id="tache" rows="3"></textarea>
                </div>

                <div class="col-sm-12 submit">
                    <input type="submit" name="submit" value= "Ajouter">
                </div>

            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>

    
</body>

</html>