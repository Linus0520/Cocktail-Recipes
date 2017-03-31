<!-- display beverage and liqour page -->
<!Doctype html>
<html lang="en">
<head>
 <meta charset="UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Recipes</title>
 <link rel="stylesheet" type="text/css" href="css/search.css"/>
 <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cuprum" />
</head>
<body>

<!-- Navigation bar --> 
     <div id = "wrap">
        <div id = "header">
            <div class='logo'></div>
            <!-- <img class='logo' src='./images/LOGO.png' alt='Logo' /> -->
            <div id ="nav" class= "old">
                    <a class = "click" href='#'> &#9776; </a>
                    <ul>
                        <li><a href='index.php'>HOME</a></li>
                        <li><a href='recipe.php'>RECIPE</a></li>
                        <li><a href='insert.cocktail.php'>CREATE</a></li>
                        <li><a href='http://www.linuswang.com/googlemap/'>FIND</a></li>
                    </ul>
            </div>
        </div>
            <h1>COCKTAIL RECIPES</h1>
            <div class="btn"><a href="recipe.php" >BACK</a></div>
    </div>

<!-- search page display beverage and liquor name and image of each cocktail -->

    <div id="main">
        <?php
        if( isset($_GET['search']) ) {
         $search = "%".$_GET['search']."%";
     } else {
         $search = "%";
     }

     $db = new PDO('mysql:host=db674453308.db.1and1.com; dbname=db674453308;charset=utf8', 'dbo674453308', 'Woaixiaotu520@@');
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

     $sql = "SELECT 
     l.lid,
     l.path AS l_img,
     l.name AS l_name,
     b.bid,
     b.path AS b_img,
     b.name AS b_name,
     c.name AS c_name
     FROM liquor AS l
     INNER JOIN cocktail AS c 
     ON (l.lid = c.lid)
     INNER JOIN beverage AS b
     ON (c.bid = b.bid)
     WHERE c.name LIKE :search";
     
     try {
        $query = $db->prepare( $sql );
        $query->bindParam( ':search', $search );
        $query->execute();
        $data = $query->fetchAll(); 
    } catch( PDOException $err ) {
        echo "Sorry, error happened.";
        echo $err->getMessage();
    };

    $cocktail = -1;
    foreach ($data as $row ) {
        if( $cocktail != $row['c_name'] ) {
            if( $cocktail > -1 ) {
                echo "</div>";
            }        
            echo "<h3>" . $row['c_name'] . "</h3>";
            echo "<div class='col'>";
            echo "<div class='item'>"."<img src='" .$row['l_img']. "' alt='' width=400 height=400'/>"."<h4>" . $row['l_name'] . "</h4>"."</div>";
            echo "<div class='item'>"."<img src='" .$row['b_img']. "' alt='' width=400 height=400'/>"."<h4>" . $row['b_name'] . "</h4>"."</div>";
            $cocktail = $row['c_name'];
        } else {
            echo "<h3>" . $row['c_name'] . "</h3>";
            echo "<div class='col'>";
            echo "<div class='item'>"."<img src='" .$row['l_img']. "' alt='' width=400 height=400'/>"."<h4>" . $row['l_name'] . "</h4>"."</div>";
            echo "<div class='item'>"."<img src='" .$row['b_img']. "' alt='' width=400 height=400'/>"."<h4>" . $row['b_name'] . "</h4>"."</div>";
        };
    };
    ?>
</div>
    <div id ="footer">
        <div class="share-buttons">
            <div class="item">
                <a href="https://www.facebook.com/sharer/sharer.php?u=&t=" title="Share on Facebook" target="_blank"><img alt="Share on Facebook" src="./images/Facebook.png"></a>
            </div>
            <div class="item">
                <a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank" title="Tweet"><img alt="Tweet" src="./images/Twitter.png"></a>
            </div>
            <div class="item">
                <a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+"><img alt="Share on Google+" src="./images/Google+.png"></a>
            </div>
            <div class="item">
                <a href="http://www.tumblr.com/share?v=3&u=&t=&s=" target="_blank" title="Post to Tumblr"><img alt="Post to Tumblr" src="./images/Tumblr.png"></a>
            </div>
            <div class="item">
                <h2>© 2016 Creative Cocktail</h2>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src = "js/main.js"></script>
</html>