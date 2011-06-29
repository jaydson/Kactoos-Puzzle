<?php 
	function __autoload($class_name) {
    $file = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', 'lib/' . $class_name)). '.php';
    require_once($file);
	}

	$kapi = new KactoosAPI();
	$kapi->oauthConsumerKey('83486dc925e2b84f1a4f63aa50f85a0a04e089c27')
		 ->country('br')
		 ->module('products')
		 ->format('xml');
	$products = $kapi->getProductsByRange(1000, 1500, 'best-price');
?>
<!doctype html>
<html>
<head>
	<title>Kactoos Puzzle</title>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js'></script>
	<script type="text/javascript" src="jquery.jqpuzzle.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="jquery.jqpuzzle.css" />
	<style>
		.puzzle_images{
			float:left;
			padding:8px;
		}
		.puzzle_images .link{
			font-size:11px;
			width:480px;
		}
		.puzzle_images div{
			font-size:16px;
			width:480px;
			font-weight:bold;
		}
	</style>
	<script>
		$(document).ready(function() { 
        var mySettings = { 
            cols: 5, 
            hole: 11, 
            numbers: false, 
            control: { 
                toggleNumbers: false, 
                counter: false, 
                timer: false 
            }, 
            animation: { 
                shuffleRounds: 1, 
                slidingSpeed: 100, 
                shuffleSpeed: 200 
            } 
        }; 
        // call jqPuzzle with mySettings on an image with id 'myImage' 
        $('#box img').jqPuzzle(mySettings); 
    });  
	</script>
</head>
<body>
	<h1>Kactoos Puzzle - Products by Range (R$ 1000 and R$1500)</h1>
	<div id="box">	
	<?php 
		for($i=0;$i<sizeof($products);$i++){
			?>
				<div class="puzzle_images">
					<div>
					<?php
						echo $products[$i]->name;
					 ?>
					 </div>
					<img src="<?php echo $products[$i]->image; ?>" alt=""/>
					<div class="link">
						<a target="_blank" href="<?php echo $products[$i]->url; ?>"><?php echo $products[$i]->url; ?></a>					
					 </div>
				</div>
			<?php
		}
	?>
	</div>
</body>
</html>
