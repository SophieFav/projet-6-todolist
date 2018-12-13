<?php 

if(isset($_POST['tache'])) {
    $depart = trim(filter_input(INPUT_POST, 'tache', FILTER_SANITIZE_STRING));

    $document = file_get_contents("todo.json", true);//récupère le doc json

    $tableau = json_decode($document, true);

    $html = html_entity_decode(json_encode($tableau));

    $tableau[] = ["tache" => $depart];
    
    $codejson = json_encode($tableau,JSON_UNESCAPED_UNICODE);
    $depart = fopen("todo.json", "w");//ouvre le fichier
   /* print_r($codejson);*/
    fwrite($depart, $codejson);//écrit dans le doc
    fclose($depart);//ferme le doc
    }

    $document = file_get_contents("todo.json");
    $parsed_json = json_decode($document);
    

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body class="blue lighten-5">
    <div class="container">
        <div class="card blue darken-4 white-text z-depth-2">
            <form method="post" action="index.php">
                <h5 class="amber-text">A FAIRE</h5>
                    <?php 
                            if ($parsed_json)
                            {
                                foreach ($parsed_json as $value) {
                                    foreach ($value as $value2) {
                                        if(!empty(trim($value2))) { 
                                            if(isset($_POST['list'])){
                                               
                                            }
                                            else{
                                                echo '<p><label><input type=checkbox name=list><span>'.$value2.'</span></label></p>';
                                            }
                                    }
                                }
                            }
                        }
                            else{
                                echo "ERREUR : le champ est vide!";
                            }
                    ?>
                    <p>
                        <label>
                            <button class="btn waves-effect waves-light amber darken-2" type="submit" name="submit">Enregistrer</button>
                        </label>
                    </p>
                    <h5 class="amber-text">ARCHIVES</h5>
                    <?php 
                    
                    if ($parsed_json)
                    {
                        foreach ($parsed_json as $value) {
                            foreach ($value as $value2) {
                                if(!empty(trim($value2))) { 
                                    if (isset($_POST["list"])){
                                        echo '<p><label><input type=checkbox name=list><span>'.$value2.'</span></label></p>'; 
                                    }
                                }
                            }
                        }
                    }
                    else{
                        echo "ERREUR : le champ est vide!";
                    }
                    ?>
                    <div class="card-action">
                        <div class="col s12">
                            <form method="post" action="index.php">
                                <h5>Ajouter une tâche</h5>
                                Tâche à effectuer :
                                <div class="input-field inline">
                                    <textarea id="textarea1" name="tache" class="materialize-textarea"></textarea>
                                </div>
                            <button class="btn-floating btn-large waves-effect waves-light amber darken-2" type="submit"><i class="material-icons">playlist_add</i></a>     
                            </form>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>