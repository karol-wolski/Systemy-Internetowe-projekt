<div class="sidebar-right">
			<?php 
			if(($_SESSION['permission']) > '0')
			{
				echo'<form class="form" action="search.php" method="POST">
						<input type="text" name="search"/>
						<input type="submit" value="Szukaj" />
					</form>';
			}
			?>
			
			<nav class="navigation-right">
				<ul>
					<li><a href="logout.php">Wyloguj</a></li>
					<li><a href="registration.php">Rejestracja</a></li>
				</ul>
			</nav>
		</div>