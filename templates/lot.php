<section class="lot-item container">
    <h2><?= $lot_name ?></h2>
    <div class="lot-item__content">
    <div class="lot-item__left">
        <div class="lot-item__image">
        <img src="<?= $lot_pic; ?>" width="730" height="548" alt="Сноуборд">
        </div>
        <p class="lot-item__category">Категория: <?= $lot_category; ?></p>
        <p class="lot-item__description"><?= $lot_description; ?></p>
    </div>
    <div class="lot-item__right">
        <?php if ($is_auth): ?>
        <div class="lot-item__state">
        <div class="lot-item__timer timer">
            10:54
        </div>
        <div class="lot-item__cost-state">
            <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost"><?= $lot_price ?></span>
            </div>
            <div class="lot-item__min-cost">
            Мин. ставка <span><?= $lot_step; ?>р</span>
            </div>
        </div>
        <form name="bids" class="lot-item__form" action="bids.php" method="POST">
            <p class="lot-item__form-item form__item <?= isset($error) ? "form__item--invalid" : "" ?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="number" name="cost" placeholder="12 000">
                <span class="form__error"><?= isset($error) ? $error : '' ?></span>
                <input name="lot_id" type='hidden' value = '<?= $lot_id; ?>'>
            </p>
            <button type="submit" class="button">Сделать ставку</button>
        </form>
        </div>
        <?php endif; ?>
        <div class="history">
        <h3>История ставок <span></span></h3>
        <table class="history__list">
            <?php $bid_check = isset($bids) ? $bids : false;?>
            <?php if ($bid_check): ?>
                <?php foreach(array_reverse($bids) as $bid): ?>
                    <tr class="history__item">
                        <td class="history__name"><?= $user ?></td>
                        <td class="history__price"><?= $bid['sum_price'] ?> р</td>
                        <td class="history__time"><?= $bid['date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        </div>
    </div>
    </div>
</section>



