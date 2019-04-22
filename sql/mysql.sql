create database class default character set utf8 collate utf8_unicode_ci;
use class;
create table users(
	id varchar(100) primary key,
	name varchar(100),
	password varchar(100),
	role varchar(20),
	class varchar(100)
);
create table courses(
	id integer auto_increment primary key,
	subject varchar(100),
	subject_no varchar(100),
	teacher_id varchar(100)
);
create table courses_students(
	course_id integer,
	student_id varchar(100),
	created_at timestamp
);
create table assignments(
	id integer auto_increment primary key,
	title varchar(200),
	attachement varchar(200),
	created_at timestamp,
	course_id integer
);
create table assignments_records(
	id integer auto_increment primary key,
	assignment_id integer,
	student_id varchar(100),
	created_at timestamp,
	attachement varchar(200),
	score float
);
insert into users(id,name,password,role) values('1629220003',
	'1629220003','aci456852','teacher');