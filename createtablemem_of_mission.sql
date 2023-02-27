create table mem_of_mission(
num int not null primary key auto_increment,
parent int not null,
id char(20) not null,
nick char(20) not null,
regist_day char(20),
ip char(20),
foreign key(id) references member(id)
);