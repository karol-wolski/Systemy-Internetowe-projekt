<div class="main">
			<?php 
				echo "<p>Witaj " . $_SESSION['name'] . "!</p>";
				if(isset($_SESSION['edit_success']))
				{
					echo "<p>" . $_SESSION['edit_success'] . "</p>";
				}
			 ?>
		</div>