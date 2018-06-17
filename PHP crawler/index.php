<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="crawler.css">
  </head>
  <body>
  	<div class="header">
  		<div class="header-text">Crawler</div>
	  	<form>
	  		<input type="text" name="crawler">
	  		<input type="submit" value="Crawl!">
	  	</form>
	</div>

	<?php

function find_links($url) {
    // Init DOM file, containing all web structure
    $DOM_DOM_xml = new DOMDocument();
    $parsedLinks = '';

    // Load the url into DOM
    @$DOM_DOM_xml->loadHTMLFile($url);

    // Empty array to hold all links to return
    $links = array();

    //Loop through each <a> tag in the dom and add it to the link array
    foreach($DOM_DOM_xml->getElementsByTagName('a') as $link) {
    	$href = $link->getAttribute('href');
		
		//Add Http to links
    	if  ( $ret = parse_url($href) ) {
			if ( !isset($ret["scheme"]) ) {
				$href = "http://{$url}";
			}
		}
		
		$href = strtok($href, "#");

        $links[] = $href;
    }
	
	//Make links unique
    $links = array_unique($links);

	
    foreach($links as $link) {
        //Create user friendly appearence
		$parsedLinks .= '<a href="'. $link .'" class="link">' . $link . '</a>';
		//$parsedLinks .=$link;
    }
	
    //Return the links
    return $parsedLinks;
	
} 


	if (isset($_GET['crawler'])) {
		$url = $_GET['crawler'];

		print($_GET['crawler']); 

		if (filter_var($url, FILTER_VALIDATE_URL)) {
		    echo("$url is a valid URL");
			   echo find_links($url);
		} else {
		    echo("<br>$url is not a valid URL<br>");
		}
	}
	?>

  </body>
</html>