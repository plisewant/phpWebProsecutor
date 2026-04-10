create database board_db;

use board_db;

-- 삭제
-- drop table users;
-- drop table posts;
-- drop table comments;
-- 삭제

create table users(
	id int auto_increment primary key,
	name varchar(32) unique not null,
	password varchar(255) not null,
    role varchar(20) default 'user',
    created_at datetime default current_timestamp
);

CREATE TABLE posts (
	id int auto_increment primary key,
	title varchar(200) not null,
	content text not null,
	author_id int not null,
	created_at datetime default current_timestamp,
	views int default 0, 
    
    foreign key (author_id) 
    references users(id) 
    on delete cascade
);

CREATE TABLE comments(
	id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    author_id INT not null,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    foreign key (author_id) 
    references users(id)
    on delete cascade,
    
    foreign key(author_id)
	references users(id)
	on delete cascade
);

insert into users(name, password, role) value('admin', '4dm1nP4ssw0rd', 'admin');
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
insert into users(id, name, password, role) value(0, 'guest', 'guest', 'guest');

-- 모든 유저
select * from users;
-- 모든 게시글 
select * from posts;
-- 모든 댓글 
select * from comments;
