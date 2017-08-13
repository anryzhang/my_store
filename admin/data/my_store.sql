use my_store;

create table admin(
  id int(11)  NOT NULL ,
  name VARCHAR(32) NOT NULL ,
  password VARCHAR(128) NOT NULL
);

create table emp(
  id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  name VARCHAR(64) NOT NULL ,
  grade TINYINT /*1,1级*/,
  email varchar(64) NOT NULL ,
  salary FLOAT
);

select * from admin;