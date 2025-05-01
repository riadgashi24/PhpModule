CREATE TABLE categories(
    INTEGER PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
)

CREATE TABLE products(
    INTEGER PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INTEGER NOT NULL,
    FOREIGN  KEY (category_id) REFERENCES categories(id)
);


INSERT INTO categories(id,name ) VALUES
(1,'Fruit'),
(2,'Bakery'),
(3,'Dry Goods'),
(4,'Drinks');

INSERT INTO products(id,name,category_id)VALUES

(1,'Apple',1),
(2,'Bananas',1),
(3,'Cookies',2),
(4,'Oranges',1),
(5,'Bread',2),
(6,'Rice',3),
(7,'Pasta',3);