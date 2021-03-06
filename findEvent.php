<?php
require "functions.php";
require "DBconnect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/findEvent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <!--navbar-->
    <div class="div_nav">
        <nav class="nav">
            <div class="logo">

                <img id="logo" title="Go Back" src=".idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg"
                    alt="LOGO">
            </div>

            <form class="search_form" action="">
                <div class="search">
                    <button class="button_search" type="submit"><i class="fa fa-search" name="search"></i></button>
                    <input id="search_text" class="input" type="text" placeholder="Search...">
                </div>
            </form>
        </nav>
    </div>

    <!--body-->
    <article>
        <p class="success" id="reg_success"></p>
        <div id="search_results" class="body">
        <div class="body">
        <?php
        $connection= new DBConnect();
            $conn= $connection->getConnection();
            if (isset($_GET["search"])) {              
                    $search=$_GET["search"];
                    $results = getGigsEvents($conn,$search);
                    foreach ($results as $result) {
                        if(isset($result["gig_name"])){
                            $name = $result["gig_name"];
                            $description = $result["gig_description"];
                            $upload_path = $result["gig_upload_path"];
                            $button = "Apply";
                        }else{
                            $name = $result["event_name"];
                            $description = $result["event_description"];
                            $upload_path = $result["event_upload_path"];
                            $button = "none";
                            } ?>
                            
                            <div class="body_div">
                                <div>
                                    <img id="img" class="img" src=<?php echo $upload_path;?> />
                                </div>
                                <div>
                                    <h1><?php echo $name;?></h1>
                                </div>
                                <div>
                                    <p><?php echo $description;?></p>
                                </div>
                                <?php
                                if ($button!="none") {?>
                                <div>
                                    <button><?php echo $button;?></button>
                                </div>
                                
                                <?php } ?>
                               

                            </div>



                            <?php
                       
                    }
                }
                    
        ?>
    

            </div>
            <div class="body_div">
                <div>
                    <img id="img" class="img" src=".idea\Pictures\events_medium.jpg" />
                </div>
                <div>
                    <h1>Concert</h1>
                </div>
                <div>
                    <p>Come one,come all,calling all the artists to come and showcase</p>
                </div>
                <div>
                    <button>Apply</button>
                </div>

            </div>

        </div>




    </article>
    <script src="Js/findEvent.js"></script>

</body>

</html>