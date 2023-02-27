create table pushpush(
num int primary key auto_increment,
table_name char(20) not null,
item_num int not null,
id char(20) not null,
ip char(20),
foreign key(id) references member(id)
);