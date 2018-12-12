<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach($categories as $category_name => $category): ?>
            <?= include_template('category.php', [
                'category' => $category,
                'category_name' => $category_name
            ]); ?>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach($lots as $lot): ?>
            <?= include_template('lot_card.php', ['lot' => $lot]); ?>
        <?php endforeach; ?>
    </ul>
</section>
