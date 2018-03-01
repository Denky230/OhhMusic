create database ohhmusic;
use ohhmusic;

create table local(
username varchar(25) primary key not null,
name varchar(25) not null,
location varchar(30) not null,
email varchar(35) not null,
phone int not null,
capacity int not null,
image varchar(255)
);

create table musician(
username varchar(35) primary key not null,
name varchar(20) not null,
surname varchar(30) not null,
artist_name varchar(35) not null,
genre varchar(20) not null,
phone int not null,
email varchar(35) not null,
web varchar(255),
group_size int not null
);

create table fan(
username varchar(30) primary key not null,
name varchar(20) not null,
surname varchar(30) not null,
email varchar(35) not null,
phone int,
address varchar(50),
image varchar(50)
);

create table concert(
id_concert int not null primary key AUTO_INCREMENT,
concert_date date not null,
concert_time time not null,
genre varchar(30) not null,
ticketPrice int not null,
un_local varchar(25) not null, 
constraint fk_conc foreign key(un_local) references local(username) on delete cascade on update cascade
);

create table assist(
un_fan varchar(35) not null,
id_concert int not null,
constraint pk_assist primary key(un_fan, id_concert),
constraint fk_assist_fan foreign key(un_fan) references fan(username) on delete cascade on update cascade,
constraint fk_assist_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table play(
un_musician varchar(35) not null,
id_concert int not null,
constraint pk_play primary key(un_musician, id_concert),
constraint fk_play_mus foreign key(un_musician) references musician(username) on delete cascade on update cascade,
constraint fk_play_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table applyConcert(
un_musician varchar(35) not null,
id_concert int not null,
state char(1) not null,
constraint pk_applyConcert primary key(un_musician, id_concert),
constraint fk_apply_mus foreign key(un_musician) references musician(username) on delete cascade on update cascade,
constraint fk_apply_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table voteConcert(
un_fan varchar(30) not null,
id_concert int not null,
constraint pk_vote1 primary key(un_fan, id_concert),
constraint fk_user foreign key(un_fan) references fan(username) on delete cascade on update cascade,
constraint fk_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table voteMusician(
un_fan varchar(35) not null,
un_musician varchar(30) not null,
constraint pk_vote2 primary key(un_fan, un_musician),
constraint fk_usern foreign key(un_fan) references fan(username) on delete cascade on update cascade,
constraint fk_userna foreign key(un_musician) references musician(username) on delete cascade on update cascade
);