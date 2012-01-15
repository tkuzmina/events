-- create database and user
create database events;
create user 'events' identified by 'events';
grant all on events.* to 'events';