<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  

    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
<style>

.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    width: auto;
    margin: 0 auto;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    align-items: center;
}

.button1 {
    background-color: white;
    color: black;
    border: 2px solid #4CAF50;
    font-size: 40px;
    padding: 16px 32px;
}

.button1:hover {
    background-color: #4CAF50;
    color: white;
    font-size: 40px;
    padding: 16px 32px;
}
.al{
  text-align:center;
}
.button2{
  background-color: #4CAF50;
    color: white;
    border: 2px solid #4CAF50;
    font-size: 20px;
    padding: 4px 8px;
}
.button2:hover {
  background-color: white;
    color: black;
    font-size: 20px;
    padding: 4px 8px;
}
img {
    border-radius: 50%;
    display: block;
    margin: 0 auto;
    width: auto;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}
</style>
  <head>  

    <title><?php echo htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');?></title>  

    <meta http-equiv="content-type"  

        content="text/html; charset=utf-8"/>  

  </head>  

  <body>  
	<p><a href="?addword" class="button button2">Add your own word</a></p> 
    <!--<p>Here is a random word for you:</p>  -->

    <blockquote>    

      <p>    
      <div class="al">
        
        <a href='index.php?refresh=true' class = "button button1"><?php echo htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');?>    </a>
      </p>    

    </blockquote>    
<a href='index.php?refresh=true'><img src="./Brahmi-in-Aahna-Pellanta.jpg" alt="brahmi" width="400" height="300"></a>
</div>

<!--<a href='index.php?refresh=true' class = "button button1">Show me another word</a>-->
  </body>  

</html>