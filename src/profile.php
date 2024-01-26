<?php 

require_once __DIR__ . '/helpers.php';

checkAuth();

$user = currentUser();

?>

<?php include_once "head.php"; ?>
<body>
    <div class="headerSite">Quiziz</div>
    <div class="container">
      <div class="startPage">
        <h1>Проверьте свои знания с Quiziz</h1>
        <p>Испытайте свою сноровку и повеселитесь в нашей викторине!</p>

        <div class="startMenu">
     		<h2>Привет, <?php echo $user['name']; ?>!</h2>
          	<img 
            	class="avatar" 
            	src="<?php echo $user['avatar']; ?>" 
            	alt="<?php echo $user['name']; ?>"
			>
          	<a class="startButton">Старт</a>
          	<a class="score__button">Результаты</a>
          	<form action="/actions/logout.php" method="post">
				<button role="button">Выйти из аккаунта</button>
			</form>
        </div>
      </div>
    </div>
  </body>
  <script defer src="js/startPage.js"></script>
</html>