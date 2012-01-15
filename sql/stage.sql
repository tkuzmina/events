drop table if exists comments;
drop table if exists eventtags;
drop table if exists events;
drop table if exists tags;
drop table if exists categories;
drop table if exists users;
drop table if exists roles;

create table roles (
  id int not null auto_increment,
  name char(30) not null,
  primary key (id)
) engine=MyISAM;
insert into roles (id, name) values (1, 'user'), (2, 'admin');

create table users (
  id int not null auto_increment,
  login char(255) not null,
  password char(255) not null,
  name char(255),
  surname char(255),
  role_id int not null,

  primary key (id),
  foreign key (role_id) references roles(id) on delete cascade
) engine=MyISAM;
insert into users (id, login, password, name, surname, role_id) values (1, 'admin', '', 'Tatjana', 'Kuzmina', 2);

create table categories (
  id int not null auto_increment,
  name char(255) not null,

  primary key (id)
) engine=MyISAM;

create table tags (
  id int not null auto_increment,
  name char(255) not null,
  user_id int not null,

  primary key (id),
  foreign key (user_id) references users(id) on delete cascade
) engine=MyISAM;

create table events (
  id int not null auto_increment,
  name char(255) not null,
  description text,
  category_id int not null,
  user_id int not null,
  created_date datetime not null,

  primary key (id),
  foreign key (category_id) references categories(id) on delete cascade,
  foreign key (user_id) references users(id) on delete cascade,
  fulltext (name, description)
) engine=MyISAM;

create table eventtags (
  id int not null auto_increment,
  event_id int not null,
  tag_id int not null,

  primary key (id),
  foreign key (event_id) references events(id) on delete cascade,
  foreign key (tag_id) references tags(id) on delete cascade
) engine=MyISAM;

create table comments (
  id int not null auto_increment,
  text text not null,
  event_id int not null,
  user_id int not null,
  created_date datetime not null,

  primary key (id),
  foreign key (event_id) references events(id) on delete cascade,
  foreign key (user_id) references users(id) on delete cascade
) engine=MyISAM;
