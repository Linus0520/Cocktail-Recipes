<!-- insert cocktail page  -->
<!Doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create</title>
  <link rel="stylesheet" type="text/css" href="css/create.css"/>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cuprum" />
</head>
<body>

<!-- Navigation bar --> 
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


<!-- select beverage, liquor and cocktail name and join them together-->  
  <?php
  $db = new PDO('mysql:host=db674453308.db.1and1.com; dbname=db674453308;charset=utf8', 'dbo674453308', 'Woaixiaotu520@@');
  $sql = "SELECT DISTINCT
  l.lid,
  b.bid,
  l.name AS l_name,
  b.name AS b_name
  FROM beverage AS b
  INNER JOIN cocktail AS c 
  ON (b.bid = c.bid)
  INNER JOIN liquor AS l
  ON (c.bid = l.lid)";
  
  try{
   $query = $db->prepare( $sql );
   $result = $query->execute();	
 } catch( PDOException $err ) {
   echo "ERROR: " . $err->getMessage();
 }
 $data = $query->fetchAll();
 ?>

 <div id="main">
     <div class = "slogan"><h1>CREATE COCKTAIL</h1></div>

<!--   create a form for user to create cocktail--> 
    <div class="form">
        <form method='get' action='insert.cocktail.php'>

    <!-- create a drop down bar to select beverage name -->
         <div class="beverage">
           <select name ='beverage' >        
            <?php
            foreach( $data as $row ) {
             echo "<option value='";
             echo $row['bid'];
             echo "'>";
             echo $row['b_name'];
             echo "</option>";
           };
           ?>
         </select>
       </div>

    <!-- create a drop down bar to select liquor name -->
       <div class="liquor">
         <select name ='liquor' >
            <?php
            foreach( $data as $row ) {
             echo "<option value='";
             echo $row['lid'];
             echo "'>";
             echo $row['l_name'];
             echo "</option>";
           }
           ?>
         </select>
     </div>

    <!-- enter cocktail name -->
     <div class="cocktail">
        <input type='text' name='cocktail' placeholder='Enter cocktail name' required >
     </div>
     <div class="button">
       <input type='submit'  value='CREATE' />
     </div>
    </form>

    <?php
    if( isset($_GET['beverage']) ) {
      $beverage= $_GET['beverage'];
    }

    if( isset($_GET['liquor']) ) {
      $liquor = $_GET['liquor'];
    }
    if( isset($_GET['cocktail']) ){
      $cocktail = $_GET['cocktail'];
    }

    // insert beverage, liquor, cocktail name and a picture to the database 

    if( isset($beverage) && isset($cocktail) && ($liquor)) {

      $sql = "INSERT INTO `cocktail` (`bid`,`lid`,`name`,`path`) VALUES (? , ?, ?, 'http://res.cloudinary.com/hjqklbxsu/image/upload/v1476817659/header/recipe/100_proof_neat.png');";
      $query = $db->prepare( $sql );
      $result = $query->execute( [ $beverage, $liquor, $cocktail ] );

    //a message will be showed when insert the record successfully
    //the new cocktail will be displayed on recipe page

      if( $result ) {
        echo "<div class='record'><h2>"."COCKTAIL CREATED SUCCESSFULLY"."<h2></div>";
      };
    };

    ?>

  </div>
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