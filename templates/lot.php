<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?= $lot['url']; ?>" width="350" height="260" alt="<?= $lot['name']; ?>">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?= $lot['categorie']; ?></span>
        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= $lot['name']; ?></a></h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount"><?= format_number($lot['price']); ?></span>
                <span class="lot__cost"><?= format_number($lot['price']); ?></span>
            </div>
            <div class="lot__timer timer">
                12:23
            </div>
        </div>
    </div>
</li>
