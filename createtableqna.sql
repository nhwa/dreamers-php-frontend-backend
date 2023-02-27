create table qna(
num int not null primary key auto_increment,
id char(20) not null,
nick char(20) not null,
subject char(80) not null,
content text not null,
regist_day char(20),
file_name_0 char(40),
file_name_1 char(40),
file_name_2 char(40),
file_copied_0 char(30),
file_copied_1 char(30),
file_copied_2 char(30),
ip char(20),
foreign key(id) references member(id)
);