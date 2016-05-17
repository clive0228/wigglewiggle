<!doctype HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>KakaoLink Demo(Web Button) - Kakao Javascript SDK</title>
    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
  </head>
  <body>
    <?php       
    // Get class for Instagram
    // More examples here: https://github.com/cosenary/Instagram-PHP-API
    require_once 'instagram.php';

    // Initialize class with client_id
    // Register at http://instagram.com/developer/ and replace client_id with your own
    $instagram = new Instagram('6110dbe0862e43cd8bf15811ec94a84e');

    // Set keyword for #hashtag
    $tag = 'wigglewiggle';

    // Get latest photos according to #hashtag keyword
    $media = $instagram->getTagMedia($tag);

    // Set number of photos to show
    $limit = 5;

    // Set height and width for photos
    $size = '100';

    // Show results
    // Using for loop will cause error if there are less photos than the limit
    foreach(array_slice($media->data, 0, $limit) as $data)
    {
        // Show photo
        echo '<p>1<img src="'.$data->images->thumbnail->url.'" height="'.$size.'" width="'.$size.'" alt="SOME TEXT HERE"></p>';
    }
?>
  </body>
</html>