drop table d_evento cascade;
drop table d_meio cascade;
drop table d_tempo cascade;
drop table d_evento_meio cascade;

create table d_evento
  (idEvento serial,
   numTelefone int not null,
   instanteChamada timestamp not null,
   constraint pk_d_evento primary key(idEvento));

create table d_meio
  (idMeio serial,
   numMeio int not null,
   nomeMeio varchar(30) not null,
   nomeEntidade varchar(30) not null,
   tipo varchar(30) not null,
   constraint pk_d_meio primary key(idMeio));

create table d_tempo
  (idData serial,
   dia int not null,
   mes int not null,
   ano int not null,
   constraint pk_d_tempo primary key(idData));

create table d_evento_meio
  (idEvento int not null,
   idMeio int not null,
   idData int not null,
   constraint pk_d_evento_meio primary key(idEvento,idMeio,idData),
   constraint fk_d_evento_meio_d_evento foreign key(idEvento) references d_evento(idEvento),
   constraint fk_d_evento_meio_d_meio foreign key(idMeio) references d_meio(idMeio),
   constraint fk_d_evento_meio_d_tempo foreign key(idData) references d_tempo(idData));


insert into d_evento (numTelefone,instanteChamada)
select numTelefone,instanteChamada
from eventoEmergencia;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo)
select numMeio, nomeMeio, nomeEntidade, 'Meio Apoio'
from meioApoio natural join meio;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo)
select numMeio, nomeMeio, nomeEntidade, 'Meio Socorro'
from meioSocorro natural join meio;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo)
select numMeio, nomeMeio, nomeEntidade, 'Meio Combate'
from meioCombate natural join meio;

insert into d_meio (numMeio, nomeMeio, nomeEntidade, tipo)
select numMeio, nomeMeio, nomeEntidade, NULL
from meio
where (numMeio,nomeEntidade) not in(
  select * from meioApoio
  union
  select * from meioSocorro
  union
  select * from meioCombate
);

insert into d_tempo (dia, mes, ano)
select distinct extract(day from instanteChamada),
                extract(month from instanteChamada),
                extract(year from instanteChamada)
from eventoEmergencia;


insert into d_evento_meio (idEvento, idMeio, idData)
select idEvento, idMeio, idData
from aciona natural join meio natural join eventoemergencia
            natural join d_evento natural join d_meio natural join d_tempo
where dia = extract(day from instanteChamada)
  and mes = extract(month from instanteChamada)
  and ano = extract(year from instanteChamada)
