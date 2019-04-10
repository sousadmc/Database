
drop table  camara cascade;
drop table  video cascade;
drop table  segmentoVideo cascade;
drop table  local cascade;
drop table  vigia cascade;
drop table  eventoEmergencia cascade;
drop table  processoSocorro cascade;
drop table  entidadeMeio cascade;
drop table  meio cascade;
drop table  meioApoio cascade;
drop table  meioSocorro cascade;
drop table  meioCombate cascade;
drop table  transporta cascade;
drop table  alocado cascade;
drop table  aciona cascade;
drop table  coordenador cascade;
drop table  audita cascade;
drop table  solicita cascade;

----------------------------------------
-- Table Creation
----------------------------------------

-- Named constraints are global to the database.
-- Therefore the following use the following naming rules:
--   1. pk_table for names of primary key constraints
--   2. fk_table_another for names of foreign key constraints



create table  camara
  (numCamara int not null,
  constraint pk_camara primary key(numCamara));

create table  video
  (dataHoraInicio timestamp not null,
   dataHoraFim timestamp not null,
   numCamara int not null,
   constraint pk_video primary key(dataHoraInicio,numCamara),
   constraint fk_video_camara foreign key(numCamara) references  camara(numCamara) on delete cascade);

create table  segmentoVideo
  (numSegmento int not null,
   duracao varchar(20) not null,
   dataHoraInicio timestamp not null,
   numCamara int not null,
   constraint pk_segmentoVideo primary key(numSegmento, dataHoraInicio, numCamara),
   constraint fk_segmentoVideo_video foreign key(dataHoraInicio,numCamara) references  video(dataHoraInicio, numCamara) on delete cascade);

create table  local
  (moradaLocal varchar(255) not null,
   constraint pk_local primary key(moradaLocal));

create table  vigia
  (moradaLocal varchar(255) not null,
   numCamara int not null,
   constraint pk_vigia primary key(moradaLocal,numCamara),
   constraint fk_vigia_local foreign key(moradaLocal) references  local(moradaLocal) on delete cascade,
   constraint fk_vigia_camara foreign key(numCamara) references  camara(numCamara) on delete cascade);

create table  processoSocorro
  (numProcessoSocorro int not null,
   constraint pk_processoSocorro primary key(numProcessoSocorro));

create table  eventoEmergencia
  (numTelefone int not null,
   instanteChamada timestamp not null,
   nomePessoa varchar(80) not null,
   moradaLocal varchar(255) not null,
   numProcessoSocorro int,
   constraint pk_eventoEmergencia primary key(numTelefone, instanteChamada),
   constraint uk_eventoEmergencia unique (numTelefone, nomePessoa),
   constraint fk_eventoEmergencia_local foreign key(moradaLocal) references  local(moradaLocal) on delete cascade,
   constraint fk_eventoEmergencia_processoSocorro foreign key(numProcessoSocorro) references  processoSocorro(numProcessoSocorro) on delete cascade);

create table  entidadeMeio
  (nomeEntidade varchar(30) not null,
   constraint pk_entidadeMeio primary key(nomeEntidade));

create table  meio
  (numMeio int not null,
   nomeMeio varchar(30) not null,
   nomeEntidade varchar(30) not null,
   constraint pk_meio primary key(numMeio, nomeEntidade),
   constraint fk_meio_entidadeMeio foreign key(nomeEntidade) references  entidadeMeio(nomeEntidade) on delete cascade);

create table  meioCombate
  (numMeio int not null,
   nomeEntidade varchar(30) not null,
   constraint pk_meioCombate primary key(numMeio, nomeEntidade),
   constraint fk_meioCombate_meio foreign key(numMeio,nomeEntidade) references  meio(numMeio,nomeEntidade) on delete cascade);

create table  meioApoio
  (numMeio int not null,
   nomeEntidade varchar(30) not null,
   constraint pk_meioApoio primary key(numMeio, nomeEntidade),
   constraint fk_meioApoio_meio foreign key(numMeio,nomeEntidade) references  meio(numMeio,nomeEntidade) on delete cascade);


create table  meioSocorro
  (numMeio int not null,
   nomeEntidade varchar(30) not null,
   constraint pk_meioSocorro primary key(numMeio, nomeEntidade),
   constraint fk_meioSocorro_meio foreign key(numMeio, nomeEntidade) references  meio(numMeio, nomeEntidade) on delete cascade);

create table  transporta
  (numMeio int not null,
   nomeEntidade varchar(30) not null,
   numVitimas int not null,
   numProcessoSocorro int not null,
   constraint pk_transporta primary key(numMeio, nomeEntidade, numProcessoSocorro),
   constraint fk_transporta_meioSocorro foreign key(numMeio, nomeEntidade) references  meioSocorro(numMeio, nomeEntidade) on delete cascade,
   constraint fk_transporta_processoSocorro foreign key(numProcessoSocorro) references  processoSocorro(numProcessoSocorro) on delete cascade);

create table  alocado
  (numMeio int not null,
   nomeEntidade varchar(30) not null,
   numHoras int not null,
   numProcessoSocorro int not null,
   constraint pk_alocado primary key(numMeio, nomeEntidade, numProcessoSocorro),
   constraint fk_alocado_meioApoio foreign key(numMeio, nomeEntidade) references  meioApoio(numMeio, nomeEntidade) on delete cascade,
   constraint fk_alocado_processoSocorro foreign key(numProcessoSocorro) references  processoSocorro(numProcessoSocorro) on delete cascade);

create table  aciona
  (numMeio int not null,
   nomeEntidade varchar(30) not null,
   numProcessoSocorro int not null,
   constraint pk_aciona primary key(numMeio, nomeEntidade, numProcessoSocorro),
   constraint fk_aciona_meio foreign key(numMeio, nomeEntidade) references  meio(numMeio, nomeEntidade) on delete cascade,
   constraint fk_aciona_processoSocorro foreign key(numProcessoSocorro) references  processoSocorro(numProcessoSocorro) on delete cascade);

create table  coordenador
  (idCoordenador int not null,
   constraint pk_coordenador primary key(idCoordenador));

create table  audita
  (idCoordenador int not null,
   numMeio int not null,
   nomeEntidade varchar(30) not null,
   numProcessoSocorro int not null,
   datahorainicio timestamp not null,
   datahorafim timestamp not null,
   dataAuditoria timestamp not null,
   texto varchar(1000) not null,
   constraint pk_audita primary key(idCoordenador, numMeio, nomeEntidade, numProcessoSocorro),
   constraint fk_audita_aciona foreign key(numMeio, nomeEntidade, numProcessoSocorro) references  aciona(numMeio, nomeEntidade, numProcessoSocorro) on delete cascade,
   constraint fk_audita_coordenador foreign key(idCoordenador) references  coordenador(idCoordenador) on delete cascade,
   check (dataHoraInicio < datahorafim));
   --check(dataAuditoria >= dataAtual)

create table  solicita
  (idCoordenador int not null,
   dataHoraInicioVideo timestamp not null,
   numCamara int not null,
   dataHoraInicio timestamp not null,
   dataHoraFim timestamp not null,
   constraint pk_solicita primary key(idCoordenador, dataHoraInicioVideo, numCamara),
   constraint fk_solicita_coordenador foreign key(idCoordenador) references  coordenador(idCoordenador) on delete cascade,
   constraint fk_solicita_video foreign key(dataHoraInicioVideo, numCamara) references  video(dataHoraInicio, numCamara) on delete cascade);
