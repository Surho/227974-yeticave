<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?= $lot['image']; ?>" width="350" height="260" alt="<?= $lot['alias']; ?>">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?= $lot['category_name']; ?></span>
        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= esc($lot['lot_name']); ?></a></h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount"><?= format_number(esc($lot['init_price'])); ?></span>
                <span class="lot__cost"><?= format_number(esc($lot['price'])); ?></span>
            </div>
            <div class="lot__timer timer">
                <?= time_to_midnight(); ?>
            </div>
        </div>
    </div>
</li>

