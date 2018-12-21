    <form class="form container" action="sign-up.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item <?= isset($errors['email']) ? "form__item--invalid" : ""; ?>"> <!-- form__item--invalid -->
        <label for="email ">E-mail*</label>
        <input class = "email" id="email" type="text" name="email" placeholder="Введите e-mail" value = <?= isset($_POST['email']) ? $_POST['email'] : ''; ?>>
        <span class="form__error"><?= $errors['email']; ?></span>
      </div>
      <div class="form__item <?= isset($errors['password']) ? "form__item--invalid" : ""; ?>">
        <label for="password">Пароль*</label>
        <input class = password id="password" type="text" name="password" placeholder="Введите пароль" value= <?= isset($_POST['password']) ? $_POST['password'] : ''; ?>>
        <span class="form__error"><?= $errors['password']; ?></span>
      </div>
      <div class="form__item <?= isset($errors['name']) ? "form__item--invalid" : ""; ?>">
        <label for="name">Имя*</label>
        <input class = name id="name" type="text" name="name" placeholder="Введите имя" value= <?= isset($_POST['name']) ? $_POST['name'] : ''; ?>>
        <span class="form__error"><?= $errors['name']; ?></span>
      </div>
      <div class="form__item <?= isset($errors['message']) ? "form__item--invalid" : ""; ?>">
        <label for="message">Контактные данные*</label>
        <textarea class ="message" id="message" name="message" placeholder="Напишите как с вами связаться"><?= isset($_POST['message']) ? $_POST['message'] : ""; ?></textarea>
        <span class="form__error"><?= $errors['message']; ?></span>
      </div>
      <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
          <button class="preview__remove" type="button">x</button>
          <div class="preview__img">
            <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
          </div>
        </div>
        <div class="form__input-file">
          <input name="avatar" class = "avatar, visually-hidden" type="file" id="photo2" value="">
          <label for="photo2">
            <span>+ Добавить</span>
          </label>
        </div>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
