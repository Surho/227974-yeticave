INSERT
  category (alias, name)
VALUES
  ('boards', 'Доски и лыжи'),
  ('attachment', 'Крепления'),
  ('boots', 'Ботинки'),
  ('clothing', 'Одежда'),
  ('tools', 'Инструменты'),
  ('other', 'Разное');

INSERT
  users (name, registration_date, email, password, avatar, contacts)
VALUES
  ('Bob','2012-08-21', 'Bob@gmail.com', '123', 'img/avatar/Bob.jpg', 'contacts1'),
  ('Tom','2012-09-21', 'Tom@gmail.com', '123', 'img/avatar/Tom.jpg', 'contacts2'),
  ('Tim','2012-10-21', 'Tim@gmail.com', '123', 'img/avatar/Tim.jpg', 'contacts3');


INSERT
  lot (name, creation_date, end_date, category_id, user_id_author, user_id_winner, description, image, init_price, price, step)
VALUES
('2014 Rossignol District Snowboard', '2017-07-22', '2019-01-01', 1, 1, 1, "bla-bla-bla", 'image path', 10999, 12999, 200),
('DC Ply Mens 2016/2017 Snowboard', '2017-07-23', '2019-01-01', 1, 1, 2, "bla-bla-bla", 'image path', 159999, 163000, 2000),
('Крепления Union Contact Pro 2015 года размер L/XL', '2012-07-24', '2019-01-01', 2, 2, 3, "bla-bla-bla", 'image path', 8000, 16000, 200),
('Ботинки для сноуборда DC Mutiny Charocal', '2017-08-25', '2019-01-01', 3, 2, 3, "bla-bla-bla", 'image path', 10999, 18000, 200),
('Куртка для сноуборда DC Mutiny Charocal', '2018-07-26', '2019-01-01', 4, 3, 2, "bla-bla-bla", 'image path', 7500, 9000, 200),
('Маска Oakley Canopy', '2018-06-26', '2017-07-27', 6, 3, 2, "bla-bla-bla", 'image path', 5400, 9000, 200);

INSERT
  bid (lot_id, date, sum_price)
VALUES
  (3, '2018-08-21', 9000),
  (3, '2018-08-22', 9200),
  (3, '2018-08-23', 9400),
  (3, '2018-08-24', 9600),
  (4, '2018-08-21', 12000);

SELECT * FROM category;

SELECT lot.name, init_price, image, category.name
FROM lot
LEFT JOIN category
ON lot.category_id = category.id
ORDER BY creation_date ASC;

SELECT * , category.name
FROM lot
LEFT JOIN category
ON lot.category_id = category.id
WHERE lot.id = 2;

UPDATE lot
SET name = '2018 Rossignol District Snowboard'
WHERE id = 1;

SELECT *
FROM bid
WHERE lot_id = 3
LIMIT 3
ORDER BY date DESC;



