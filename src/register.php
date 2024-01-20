<?php

require_once __DIR__ . '/helpers.php';

// $_SESSION['validation'] = [];

?>

<?php include_once "head.php"; ?>
  <body>
    <div class="headerSite">Quiziz</div>
    <div class="container">
      <div class="startPage">
        <!-- <h1>Проверьте свои знания с Quiziz</h1>
        <p>Испытайте свою сноровку и повеселитесь в нашей викторине!</p> -->
        <div class="nameInput">
          <form class="registerForm" action="/actions/register.php" method="post" enctype="multipart/form-data">
            <h2>Регистрация</h2>
              <div class="input-group">

                <div class="playerName">
					<input 
						type="text" 
						id="name" 
						name="name" 
						autocomplete="off"
						placeholder="Иван"
						value="<?php echo old(key: 'name') ?>"
						<?php validationErrorAttr(fieldName: 'name') ?>
						minlength="1" 
						maxlength="70" 
						onblur="checkInput(this)"
					/>

					<label id="playerName" for="name">
						Имя: 
					</label>

					<!-- если ключ массива $_SESSION['validation']['name'] не пустой, то отображаем под инпутом с именем ошибку с текстом  -->
					<?php if(hasValidationError(fieldName: 'name')): ?>
						<small><?php validationErrorMessage(fieldName: 'name') ?></small>
					<?php endif; ?>
                </div>

				<div class="playerEmail">
					<input 
						type="text" 
						id="email" 
						name="email"
						autocomplete="off"
						placeholder="example@gmail.com"
						value="<?php echo old(key: 'email') ?>"
						<?php validationErrorAttr(fieldName: 'email') ?>
						minlength="1" 
						maxlength="70" 
						onblur="checkInput(this)"
					/>
					<label id="playerEmail"  for="email">
						Эл. почта:
					</label>

					<?php if(hasValidationError(fieldName: 'email')): ?>
						<small><?php validationErrorMessage(fieldName: 'email') ?></small>
					<?php endif; ?>
				</div>

				<div class="playerPassword">

						<input 
							type="password" 
							id="password" 
							name="password"
							autocomplete="off" 
							placeholder="********"
							<?php validationErrorAttr(fieldName: 'password') ?>
							minlength="8" 
							maxlength="20" 
							onblur="checkInput(this)"
						/>
						<label id="playerPassword" for="password">
							Пароль: 
						</label>

						<?php if(hasValidationError(fieldName: 'password')): ?>
							<small><?php validationErrorMessage(fieldName: 'password') ?></small>
						<?php endif; ?>
				</div>

				<div class="confirmPlayerPassword">
					<input 
						type="password" 
						id="confirmPassword"
						name="confirmPassword"
						autocomplete="off" 
						placeholder="********"
						<?php validationErrorAttr(fieldName: 'confirmPassword') ?>
						minlength="8" 
						maxlength="20" 
						onblur="checkInput(this)"
					/>
					<label id="confirmPlayerPassword" for="confirmPassword">
						Подтвердите: 
					</label>

					<?php if(hasValidationError(fieldName: 'confirmPassword')): ?>
						<small><?php validationErrorMessage(fieldName: 'confirmPassword') ?></small>
					<?php endif; ?>
				</div>
              </div>
			  <fieldset>
					<label for="terms">
						<input
							type="checkbox"
							id="terms"
							name="terms"
						>
						Я принимаю все условия пользования
					</label>
				</fieldset>
              <button type="submit" id="submit" disabled class="inputButton">СОХРАНИТЬ</button>
              <div>
			  	<p>Уже есть аккаунт? <a class="inputLink" href="./index.php">Войти</a></p>
			  </div>
              <!-- <input type="submit" value="Сохранить" class="submit" /> -->
          </form>
        </div>
      </div>
    </div>
  </body>
  <script defer src="js/startPage.js"></script>
  <script>
	const terms = document.getElementById('terms');
	const submit = document.getElementById('submit');

	terms.addEventListener('change', (e) => {
		submit.disabled = !e.currentTarget.checked;
	});
  </script>
</html>