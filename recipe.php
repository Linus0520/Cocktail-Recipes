<!-- display cocktail page -->
<!Doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Recipes</title>
   <link rel="stylesheet" type="text/css" href="css/recipe.css"/>
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
            <div class = "search">
             <form method='get' action='search.php'>
                 <input type='text' name='search' placeholder='Search for cocktail...' required >
                 <input type = 'submit' value ="SEARCH">    
             </form>
         </div>
    </div>

<!-- create a search bar, users can search cocktail name and will see the ingredient on search page  -->
        
 </div>

 <div id="main">
    <?php
    if( isset($_GET['search']) ) {
    	$search = "%".$_GET['search']."%";
    } else {
    	$search = "%";
    }

    $db = new PDO('mysql:host=; dbname=; charset=utf8', '', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "SELECT * FROM cocktail";
    $result = $db->query($sql);
    $data = $result->fetchAll(); 

// page list all cocktail names and imgs and link each cocktail to the beverage and liquor display page 

    foreach ($data as $row ) { 	
    	echo " <div class = 'item'>";
    	echo "<a href='search.php?search=".$row['name']."'>" . "<img src='" .$row['path']. "' width=300 height=300'/>" . "</a>";
    	echo "<h3><a href='search.php?search=".$row['name']."'>" . $row['name'] . "</a></h3>";
    	echo"</div>";
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
