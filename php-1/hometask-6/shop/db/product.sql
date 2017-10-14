CREATE TABLE product
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    image VARCHAR(255),
    short_description VARCHAR(255),
    description TEXT,
    price FLOAT,
    category_id INT(11)
);