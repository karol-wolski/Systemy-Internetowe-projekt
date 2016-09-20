<div class="sidebar-right">
			<?php 
			if(isset($_SESSION['logged']) && isset($_SESSION['permission']) > '0')
			{
				echo'<form class="form">
						<input type="text"/>
						<input type="submit" value="Szukaj" />
					</form>';
			}
			?>
			
			<nav class="navigation-right">
				<ul>
					<?php 
					if(!isset($_SESSION['logged']))
					{
						echo '<li><a href="signin.php">Zaloguj się</a></li>';
					}
					else
					{
						echo '<li><a href="admin/logout.php">Wyloguj się</a></li>';
					}
					?>		
					<li><a href="registration.php">Rejestracja</a></li>
				</ul>
			</nav>
		</div>