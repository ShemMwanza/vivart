<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Craft</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Css/craft.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>


<section>

    <article>
        <div class="body">
        <form id="addCraft" action="" method="POST">
        <h1>Craft</h1>
        <h2>Add Craft</h2>
        <input type="file" id="craft_photo" name="photo" accept="audio/* video/* image/*">
        <button type="button" id="craft_upload_file" >Choose File</button><br><br>
        <h2>Select Craft Type</h2>
        <select name="art_type" id="art_type">
          <option value="Music" selected>Music</option>
          <option value="Painting">Painting</option>
          <option value="Drawing">Drawing</option>
          <option value="Poem">Poem</option>
        </select>
        <br>
        <h2>Add Caption</h2>
        <textarea name="caption" id="caption" cols="30" rows="10"></textarea>
        <p class="error" id="craftUpload_error"></p>
        <p class="success" id="craftUpload_success"></p>
        <button type="submit"id="upload">Upload</button>
        </form>
        </div>
        
        
        <div id="svg">
            <div id="svg-1">
                <svg height="105" width="105">
                    <circle cx="50" cy="50" r="50"   />
                  </svg>
                  <br>
                  <br>
                  <svg id="center-2" height="120" width="120">
                    <circle cx="60" cy="60" r="50"  />
                  </svg>
            </div>
            <div id="svg-2">
                <svg id="center" height="100" width="100">
                    <circle cx="30" cy="30" r="20" />
                  </svg>
            </div>
            <div id="svg-3">
                <svg height="100" width="100">
                    <circle cx="50" cy="50" r="40" />
                  </svg>
                  <br>
                  <br>
                  <svg id="center-1" height="100" width="100">
                    <circle cx="50" cy="50" r="40"  />
                  </svg>
            </div>

            
            

        </div>
    </article>
</section>
<script src="Js/dash.js"></script>
<script src="Js/script.js"></script>
</body>
</html>