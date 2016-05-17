<?php

require '../src/Instagram.php';
use MetzWeb\Instagram\Instagram;

$instagram = new Instagram('6110dbe0862e43cd8bf15811ec94a84e');
$result = $instagram->getPopularMedia();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - popular photos</title>
    <link href="assets/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="main">
        <ul class="grid">
        <?php
          foreach ($result->data as $media) {
	        $content = "<li>";

            // output media
			$image = $media->images->low_resolution->url;
			$content .= "<img class=\"media\" src=\"{$image}\"/>";

            // create meta section
            $avatar = $media->user->profile_picture;
            $username = $media->user->username;
            $comment = (!empty($media->caption->text)) ? $media->caption->text : '';
            $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>{$username}</p>
                           <div class=\"comment\">{$comment}</div>
                         </div>";

            // output media
            echo $content . "</li>";
          }
        ?>
        </ul>
      </div>
    </div>
    <!-- javascript -->
  </body>
</html>
