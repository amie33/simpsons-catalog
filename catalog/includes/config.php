<?php
//session_start();
	//local
		if($_SERVER['HTTP_HOST'] == "localhost")
			{
				define("HOST", "localhost");
				define("USER", "root"); 
				define("PASS", "sparky33"); 
				define("BASE", "lessinsecure");
			}
	//remote machine (live)
		else
			{
				define("HOST", "localhost");
				define("USER", "id10733680_poll"); 
				define("PASS", "polly"); 
				define("BASE", "id10733680_webpoll");
			}

	//connect to database
		$connection = mysqli_connect(HOST, USER, PASS, BASE);
?>