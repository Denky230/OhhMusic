create database ohhmusic;
use ohhmusic;

create table city(
id_city int not null primary key auto_increment,
name varchar(20) not null,
province varchar(20)
);

create table user(
id_user int not null primary key auto_increment,
type int(1) not null,
username varchar(25) not null,
pass varchar(255) not null,
name varchar(25) not null,
email varchar(30) not null,
city int not null,
image varchar(255),
constraint fk_user_city foreign key(city) references city(id_city)
);

create table local(
id_local int not null primary key,
phone varchar(12) not null,
capacity int not null,
web varchar(255),
constraint fk_local_user foreign key(id_local) references user(id_user)
);

create table genre(
id_genre int not null primary key auto_increment,
name varchar(50) not null
);

create table musician(
id_musician int not null primary key,
surname varchar(30) not null,
artist_name varchar(35) not null,
genre int not null,
phone varchar(12) not null,
web varchar(255),
group_size int not null,
constraint fk_musician_user foreign key(id_musician) references user(id_user),
constraint fk_musician_genre foreign key(genre) references genre(id_genre)
);

create table fan(
id_fan int not null primary key,
surname varchar(30) not null,
phone varchar(12),
address varchar(50),
constraint fk_fan_user foreign key(id_fan) references user(id_user)
);

create table concert(
id_concert int not null primary key auto_increment,
state int(1) not null,
concert_date date not null,
concert_time time not null,
genre int not null,
payment decimal not null,
id_local int not null,
id_musician int,
constraint fk_conc_genre foreign key(genre) references genre(id_genre),
constraint fk_conc_local foreign key(id_local) references local(id_local) on delete cascade on update cascade,
constraint fk_conc_musician foreign key(id_musician) references musician(id_musician) on delete cascade on update cascade
);

create table assist(
id_fan int not null,
id_concert int not null,
constraint pk_assist primary key(id_fan, id_concert),
constraint fk_assist_fan foreign key(id_fan) references fan(id_fan) on delete cascade on update cascade,
constraint fk_assist_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table applyConcert(
id_musician int not null,
id_concert int not null,
state int(1) not null,
constraint pk_applyConcert primary key(id_musician, id_concert),
constraint fk_apply_mus foreign key(id_musician) references musician(id_musician) on delete cascade on update cascade,
constraint fk_apply_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table voteConcert(
id_fan int not null,
id_concert int not null,
constraint pk_vote1 primary key(id_fan, id_concert),
constraint fk_user foreign key(id_fan) references fan(id_fan) on delete cascade on update cascade,
constraint fk_concert foreign key(id_concert) references concert(id_concert) on delete cascade on update cascade
);
create table voteMusician(
id_fan int not null,
id_musician int not null,
constraint pk_vote2 primary key(id_fan, id_musician),
constraint fk_usern foreign key(id_fan) references fan(id_fan) on delete cascade on update cascade,
constraint fk_userna foreign key(id_musician) references musician(id_musician) on delete cascade on update cascade
);