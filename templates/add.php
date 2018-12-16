
<form class="form form--add-lot container <?= !empty($errors) ? "form--invalid" : '' ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
    <?php $field_data = isset($_POST['lot']['lot-name']) ? $_POST['lot']['lot-name'] : ''; ?>
    <div class="form__item <?= isset($errors['lot-name']) ? "form__item--invalid" : ""; ?>">
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot[lot-name]" placeholder="Введите наименование лота" value= <?= $field_data; ?>>
        <span class="form__error"><?= $errors['lot-name']; ?></span>
    </div>
    <div class="form__item">
        <label for="category">Категория</label>
        <select id="category" name="lot[category]">
        <?php foreach($categories as $category): ?>
            <option name=<?= $category['id']; ?> value=<?= $category['id']; ?>> <?= $category['name']; ?> </option>
        <?php endforeach; ?>
        </select>
        <span class="form__error">Выберите категорию</span>
    </div>
    </div>
    <?php $field_data = isset($_POST['lot']['message']) ? $_POST['lot']['message'] : 'Напишите описание лота'; ?>
    <div class="form__item form__item--wide <?= isset($errors['message']) ? "form__item--invalid" : ''; ?>">
    <label for="message">Описание</label>
    <textarea id="message" name="lot[message]" placeholder="<?= $field_data; ?>"></textarea>
    <span class="form__error"><?= $errors['message'] ?></span>
    </div>
    <div class="form__item form__item--file <?= isset($errors['file']) ? "form__item--invalid" : ""; ?>">
    <label>Изображение</label>
    <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
    </div>
    <div class="form__input-file <?= isset($errors['lot-image']) ? "form__item--invalid" : ""; ?>">
        <input class="visually-hidden" name="lot-image" type="file" id="photo2">
        <label for="photo2">
        <span>+ Добавить</span>
        </label>
    </div>
    </div>
    <div class="form__container-three">
    <?php $field_data = isset($_POST['lot']['start-price']) ? $_POST['lot']['start-price'] : ""; ?>
    <div class="form__item form__item--small <?= isset($errors['start-price']) ? "form__item--invalid" : ""; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot[start-price]" placeholder="0" value=<?= $field_data; ?>>
        <span class="form__error"><?= $errors['start-price'] ?></span>
    </div>
    <?php $field_data = isset($_POST['lot']['step']) ? $_POST['lot']['step'] : ""; ?>
    <div class="form__item form__item--small <?= isset($errors['step']) ? "form__item--invalid" : ""; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot[step]" placeholder="0" value=<?= $field_data; ?>>
        <span class="form__error"><?= $errors['step'] ?></span>
    </div>
    <?php $field_data = isset($_POST['lot']['end-date']) ? $_POST['lot']['end-date'] : ""; ?>
    <div class="form__item <?= isset($errors['end-date']) ? "form__item--invalid" : ""; ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot[end-date]" value=<?= $field_data; ?>>
        <span class="form__error"><?= $errors['end-date'] ?></span>
    </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
