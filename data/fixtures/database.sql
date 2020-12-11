CREATE TABLE brands
(
  id   INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  CONSTRAINT brands_id_uindex
  UNIQUE (id)
);

ALTER TABLE brands
  ADD PRIMARY KEY (id);

CREATE TABLE products
(
  id       INT AUTO_INCREMENT,
  name     VARCHAR(255)    NOT NULL,
  color    VARCHAR(255)    NOT NULL,
  price    FLOAT           NOT NULL,
  brand_id INT             NULL,
  quantity INT DEFAULT '0' NOT NULL,
  reserved INT DEFAULT '0' NOT NULL,
  CONSTRAINT products_id_uindex
  UNIQUE (id),
  CONSTRAINT products_brands_id_fk
  FOREIGN KEY (brand_id) REFERENCES brands (id)
);

ALTER TABLE products
  ADD PRIMARY KEY (id);


INSERT INTO brands (id, name) VALUES (1, 'Footshop');
INSERT INTO brands (id, name) VALUES (2, 'Nike');
INSERT INTO brands (id, name) VALUES (3, 'The North Face');

INSERT INTO products (id, name, color, price, brand_id, quantity, reserved) VALUES (2, 'Nike Sportswear Table Tee', 'Black/ University Red', 790, 2, 10, 1);
INSERT INTO products (id, name, color, price, brand_id, quantity, reserved) VALUES (3, 'The North Face M Shortsleeve Fine 2 Tee', 'Tillandsia Purple', 890, 3, 20, 15);
INSERT INTO products (id, name, color, price, brand_id, quantity, reserved) VALUES (4, 'The North Face W Redbox Crewneck', 'Misty Rose', 1790, 3, 10, 5);
