<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  

    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  

  <head>  

    <title>List of words</title>  

    <meta http-equiv="content-type"  

        content="text/html; charset=utf-8"/>  

  </head>  

  <body>  
	<p><a href="?addword">Add your own word</a></p> 
    <p>Here are all the words in the database:</p>  

    <?php 

    $count = 0;
    foreach ($words as $word): ?>    

  <form action="?deleteword" method="post">

    <blockquote>    

      <p>    

        <?php 
        $count = $count + 1;
        echo $count . " ";
        echo htmlspecialchars($word['text'], ENT_QUOTES,    

            'UTF-8'); ?>    

        <input type="hidden" name="id" value="<?php    

            echo $word['id']; ?>"/>

        <input type="submit" value="Delete"/>

      </p>    

    </blockquote>    

  </form>    

<?php endforeach; ?>

  </body>  

</html>