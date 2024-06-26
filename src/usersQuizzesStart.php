<?php 

require_once __DIR__ . '/helpers.php';

checkAuth();

$user = currentUser();

?>

<?php include_once "head.php"; ?>
<body>
    <div class="headerSite">Quiziz</div>
    <div class="container">
        <div class="choose_topic">
            <h1>Выберите тему</h1>
            <div class="search">
                <label for="searchField">Поиск по теме:</label>
                <input id="searchField" class="searchInput inputStylized"></input>
            </div>

            <div class="topic-buttons user-topic-buttons">
                <?php getAllUsersQuizzes(); ?>
            </div>
        </div>
        <a class="quitQuiz" href="/startQuiz.php">Назад</a>
    </div>
  </body>
  <script src="js/checkSearchField.js"></script>
</html>