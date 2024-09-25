
TRUNCATE TABLE order_dish;
TRUNCATE TABLE receipt;
TRUNCATE TABLE ingredient_dish;
TRUNCATE TABLE reservation;
TRUNCATE TABLE `order`;
TRUNCATE TABLE dish;
TRUNCATE TABLE menu;
TRUNCATE TABLE status_dish;
TRUNCATE TABLE status_order;
TRUNCATE TABLE `table`;
TRUNCATE TABLE ingredient;
TRUNCATE TABLE discount;
TRUNCATE TABLE user;



INSERT INTO `user` (id, email, username, phone, password, roles) VALUES
                                                                     (1, 'admin1@gmail.com', 'admin1', '+380667778899', '$2y$13$RcW0Om7pT2vlCrcNjX6J5uMwl9tZofGlA8UoTJeO1PSP6u/JQ.z8i', '[\"ROLE_USER\"]'),
                                                                     (2, 'admin2@gmail.com', 'admin2', '+380667778899', '$2y$13$nOcQj8B5PRpFJYUzJEDQFuHF.CZZyoGbNcJ/nG5HjWqRhDSrgYJwS', '[\"ROLE_USER\"]'),
                                                                     (3, 'user1@gmail.com', 'user1', '+380667778899', '$2y$13$d1KcsE5hjEM.OQ6Z8ITN.O2Fa5mEYWJrvcSi6PTFVpk2DcsXLjb7W', '[\"ROLE_USER\"]'),
                                                                     (4, 'user2@gmail.com', 'user2', '+380667778899', '$2y$13$UaXrD5xZ0vOaUrdO8OhEQOlAa/MfaQpXlSgE/rOSHCNiES5bnVWwW', '[\"ROLE_USER\"]');

INSERT INTO discount (id, title, procent) VALUES
                                              (1, 'New Year Sale', 20),
                                              (2, 'Summer Discount', 15),
                                              (3, 'Weekend Special', 10),
                                              (4, 'Loyalty Reward', 25),
                                              (5, 'Flash Sale', 30);

INSERT INTO status_dish (id, title, description) VALUES
                                                     (1, 'У процесі приготування', 'Страва готується на кухні.'),
                                                     (2, 'Готово до подачі', 'Страва готова до подачі клієнту.'),
                                                     (3, 'Подано', 'Страва була подана клієнту.'),
                                                     (4, 'Скасовано', 'Приготування страви було скасовано.'),
                                                     (5, 'Помилка в замовленні', 'Виникла помилка при виконанні замовлення.');

INSERT INTO status_order (id, title, description) VALUES
                                                      (1, 'Новий', 'Замовлення тільки що зроблено.'),
                                                      (2, 'В обробці', 'Замовлення обробляється.'),
                                                      (3, 'Виконано', 'Замовлення успішно виконано.'),
                                                      (4, 'Скасовано', 'Замовлення було скасовано.'),
                                                      (5, 'Відправлено', 'Замовлення відправлено до клієнта.');

INSERT INTO ingredient (id, name, picture, is_allergic, count) VALUES
                                                                   (1, 'Пшеничне борошно', 'https://example.com/images/wheat_flour.jpg', 0, 100),
                                                                   (2, 'Цукор', 'https://example.com/images/sugar.jpg', 0, 50),
                                                                   (3, 'Яйця', 'https://example.com/images/eggs.jpg', 0, 200),
                                                                   (4, 'Молоко', 'https://example.com/images/milk.jpg', 0, 150),
                                                                   (5, 'Сіль', 'https://example.com/images/salt.jpg', 0, 20),
                                                                   (6, 'Олія соняшникова', 'https://example.com/images/sunflower_oil.jpg', 0, 75),
                                                                   (7, 'Дріжджі', 'https://example.com/images/yeast.jpg', 0, 30),
                                                                   (8, 'Томатна паста', 'https://example.com/images/tomato_paste.jpg', 0, 40),
                                                                   (9, 'Часник', 'https://example.com/images/garlic.jpg', 0, 60),
                                                                   (10, 'Цибуля', 'https://example.com/images/onion.jpg', 0, 80),
                                                                   (11, 'Сир', 'https://example.com/images/cheese.jpg', 1, 50),
                                                                   (12, 'Куряче філе', 'https://example.com/images/chicken_breast.jpg', 0, 120),
                                                                   (13, 'Свинина', 'https://example.com/images/pork.jpg', 0, 90),
                                                                   (14, 'Яловичина', 'https://example.com/images/beef.jpg', 0, 110),
                                                                   (15, 'Броколі', 'https://example.com/images/broccoli.jpg', 0, 70),
                                                                   (16, 'Морква', 'https://example.com/images/carrot.jpg', 0, 85),
                                                                   (17, 'Гриби', 'https://example.com/images/mushrooms.jpg', 1, 40),
                                                                   (18, 'Огірки', 'https://example.com/images/cucumbers.jpg', 0, 60),
                                                                   (19, 'Помідори', 'https://example.com/images/tomatoes.jpg', 0, 100),
                                                                   (20, 'Перці', 'https://example.com/images/bell_peppers.jpg', 0, 90),
                                                                   (21, 'Спеції', 'https://example.com/images/spices.jpg', 0, 25);



INSERT INTO menu (id, title, type) VALUES
                                       (1, 'Сніданки', 'сніданок'),
                                       (2, 'Обіди', 'обід'),
                                       (3, 'Вечері', 'вечеря'),
                                       (4, 'Десерти', 'десерт'),
                                       (5, 'Напої', 'напій'),
                                       (6, 'Закуски', 'закуска'),
                                       (7, 'Спеціальні пропозиції', 'спеціальна пропозиція'),
                                       (8, 'Вегетаріанське меню', 'вегетаріанське'),
                                       (9, 'Дитяче меню', 'дитяче'),
                                       (10, 'Гриль', 'гриль');

INSERT INTO dish (id, menu_id, price, description, weight, picture, is_hidden, title) VALUES
                                                                                          (1, 1, 150.00, 'Ситний омлет з овочами та сиром.', 250.000, 'https://example.com/images/omelet.jpg', 0, 'Омлет з овочами'),
                                                                                          (2, 1, 100.00, 'Салат з авокадо та тунцем.', 200.000, 'https://example.com/images/salad.jpg', 0, 'Салат з авокадо'),
                                                                                          (3, 2, 300.00, 'Суп з куркою та локшиною.', 350.000, 'https://example.com/images/chicken_soup.jpg', 0, 'Курячий суп'),
                                                                                          (4, 2, 400.00, 'Гречка з тушкованими овочами.', 300.000, 'https://example.com/images/buckwheat.jpg', 0, 'Гречка з овочами'),
                                                                                          (5, 3, 500.00, 'Стейк з яловичини з овочевим гарніром.', 400.000, 'https://example.com/images/beef_steak.jpg', 0, 'Яловичий стейк'),
                                                                                          (6, 3, 450.00, 'Філе курки з картоплею.', 350.000, 'https://example.com/images/chicken_filet.jpg', 0, 'Куряче філе'),
                                                                                          (7, 4, 250.00, 'Шоколадний торт з горіхами.', 200.000, 'https://example.com/images/chocolate_cake.jpg', 0, 'Шоколадний торт'),
                                                                                          (8, 4, 200.00, 'Тирамісу з кавовим кремом.', 150.000, 'https://example.com/images/tiramisu.jpg', 0, 'Тирамісу'),
                                                                                          (9, 5, 50.00, 'Капучино з молочною пінкою.', 250.000, 'https://example.com/images/cappuccino.jpg', 0, 'Капучино'),
                                                                                          (10, 5, 60.00, 'Чай з лимоном та медом.', 200.000, 'https://example.com/images/tea.jpg', 0, 'Чай з лимоном'),
                                                                                          (11, 6, 100.00, 'Закуска з овочами та соусом.', 150.000, 'https://example.com/images/appetizer.jpg', 0, 'Овочева закуска'),
                                                                                          (12, 6, 80.00, 'Курячі крильця в маринаді.', 200.000, 'https://example.com/images/chicken_wings.jpg', 0, 'Курячі крильця'),
                                                                                          (13, 7, 120.00, 'Фрукти на десерт.', 100.000, 'https://example.com/images/fruits.jpg', 0, 'Фрукти'),
                                                                                          (14, 7, 180.00, 'Морозиво з шоколадом.', 150.000, 'https://example.com/images/ice_cream.jpg', 0, 'Морозиво'),
                                                                                          (15, 8, 90.00, 'Салат з креветками та авокадо.', 250.000, 'https://example.com/images/shrimp_salad.jpg', 0, 'Салат з креветками'),
                                                                                          (16, 8, 130.00, 'Суп з грибами та сметаною.', 300.000, 'https://example.com/images/mushroom_soup.jpg', 0, 'Грибний суп'),
                                                                                          (17, 9, 110.00, 'Коктейль з тропічними фруктами.', 250.000, 'https://example.com/images/tropical_cocktail.jpg', 0, 'Тропічний коктейль'),
                                                                                          (18, 9, 140.00, 'Червоний виноград.', 200.000, 'https://example.com/images/red_grape.jpg', 0, 'Червоний виноград'),
                                                                                          (19, 10, 160.00, 'Бургер з яловичиною та овочами.', 300.000, 'https://example.com/images/beef_burger.jpg', 0, 'Яловичий бургер'),
                                                                                          (20, 10, 210.00, 'Курячий бургер з сиром.', 250.000, 'https://example.com/images/chicken_burger.jpg', 0, 'Курячий бургер');

INSERT INTO ingredient_dish (id, ingredient_id, dish_id, is_compulsory_item) VALUES
                                                                                 (1, 1, 1, 1),
                                                                                 (2, 2, 1, 1),
                                                                                 (3, 3, 2, 1),
                                                                                 (4, 4, 2, 0),
                                                                                 (5, 5, 3, 1),
                                                                                 (6, 6, 3, 1),
                                                                                 (7, 7, 4, 1),
                                                                                 (8, 8, 5, 1),
                                                                                 (9, 9, 6, 0),
                                                                                 (10, 10, 7, 1);

INSERT INTO `table` (id, number, count_seat_place, is_take) VALUES
                                                                (1, 1, 4, 0),
                                                                (2, 2, 2, 0),
                                                                (3, 3, 6, 1),
                                                                (4, 4, 4, 1),
                                                                (5, 5, 8, 0),
                                                                (6, 6, 2, 1),
                                                                (7, 7, 6, 0),
                                                                (8, 8, 4, 1),
                                                                (9, 9, 2, 0),
                                                                (10, 10, 8, 1);

INSERT INTO reservation (id, user_id, table_id, start_time, end_time) VALUES
                                                                          (1, 1, 3, '12:00:00', '14:00:00'),
                                                                          (2, 2, 1, '15:00:00', '17:00:00'),
                                                                          (3, 1, 2, '18:00:00', '20:00:00'),
                                                                          (4, 3, 4, '19:30:00', '21:30:00'),
                                                                          (5, 2, 5, '13:00:00', '15:00:00');


INSERT INTO `order` (id, status_order_id, table_id) VALUES
                                                        (1, 1, 3),
                                                        (2, 2, 1),
                                                        (3, 3, 2),
                                                        (4, 4, 4),
                                                        (5, 5, 5);


INSERT INTO `order_dish` (id, dish_id, user_id, status_dish_id, order_id, start_time, end_time) VALUES
                                                                                                    (1, 1, 1, 1, 1, '12:00:00', '12:30:00'),
                                                                                                    (2, 2, 2, 2, 2, '13:00:00', '13:45:00'),
                                                                                                    (3, 3, 1, 3, 3, '14:00:00', '14:30:00'),
                                                                                                    (4, 4, 3, 4, 4, '15:00:00', '15:30:00'),
                                                                                                    (5, 5, 2, 5, 5, '16:00:00', '16:30:00');

INSERT INTO `receipt` (id, order_id, user_id, discount_id, price) VALUES
                                                                      (1, 1, 1, 1, 150.00),
                                                                      (2, 2, 2, 2, 120.50),
                                                                      (3, 3, 1, 3, 180.75),
                                                                      (4, 4, 3, 4, 200.00),
                                                                      (5, 5, 2, 5, 175.25);