
# create it with phpmyadmin...

# create database tickets;

create table tickets (
    tid varchar(20),
    tname varchar(255),
    tusz varchar(255),
    ttsz varchar(255),
    tmail varchar(255),
    tmess text,
    tstat varchar(255),
    twork text,
    thour int,
    tkm int,
    tdat varchar(20),
    primary key (tid)
);


create table partner (
    pid varchar(20),
    pname varchar(255),
    ppw varchar(255),
    pszsz varchar(255),
    ptn varchar(255),
    paddr varchar(255),
    ptsz varchar(255),
    pmail varchar(255),
    primary key (pid)
);
