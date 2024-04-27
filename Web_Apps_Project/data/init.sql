CREATE DATABASE svdns;
USE svdns;

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50),
    pwd VARCHAR(25),
    email VARCHAR(50),
    phone INT(12),
    CONSTRAINT user_PRIMARY_KEY PRIMARY KEY (id)
);

CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT,
    prodname VARCHAR(50),
    category VARCHAR(25),
    proddescription VARCHAR(100),
    price INT(12),
    image VARCHAR(20),
    CONSTRAINT product_PRIMARY_KEY PRIMARY KEY (id)
);

INSERT INTO `user`
    (`id`, `username`, `pwd`, `email`, `phone`)
    VALUES
    (1, 'ricardo', 'password', 'ricardo@gmail.com', 895548879);
    
INSERT INTO `user`
    (`id`, `username`, `pwd`, `email`, `phone`)
    VALUES
    (2, 'admin', 'admin', 'admin@svdsn.com', 854659878);

INSERT INTO `product`
    (`id`, `prodname`, `category`, `proddescription`, `price`, `image`)
    VALUES
    (1, 'Dice Original', 'Cables', 'Original DICE diagnostic unit', 99, 'dice.jpeg');
    
INSERT INTO `product`
    (`id`, `prodname`, `category`, `proddescription`, `price`, `image`)
    VALUES
    (2, 'VxDiag', 'Cables', 'VcXNano diagnostic interface', 60, 'vxdiag.jpg');
    
INSERT INTO `product`
    (`id`, `prodname`, `category`, `proddescription`, `price`, `image`)
    VALUES
    (3, 'Mongose', 'Cables', 'Super J2534 diag cable', 89, 'mongose.jpg');
    
INSERT INTO `product`
    (`id`, `prodname`, `category`, `proddescription`, `price`, `image`)
    VALUES
    (4, 'VDASH', 'Software', 'Aftermarket Volvo Diag SW', 25, 'vdash.png');
    
