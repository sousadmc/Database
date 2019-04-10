1-	 select numprocessosocorro
	   from aciona
	   group by numprocessosocorro
	   having count(distinct nummeio) >= all(select count(distinct nummeio)
					  			                         from aciona
					 			                           group by numprocessosocorro);

2- 	 select nomeentidade
	   from aciona natural join eventoEmergencia
	   where instantechamada between '2018-06-21 00:00:00' and '2018-09-23 00:00:00'
  	 group by nomeEntidade
	   having count(nomeentidade) >= all (select count(nomeentidade)
							                          from  aciona natural join eventoemergencia
							                          where instantechamada between '2018-06-21 00:00:00' and '2018-09-23 00:00:00'
							                          group by nomeentidade);

3-	select distinct numprocessosocorro
	  from eventoEmergencia natural join aciona
	  where moradaLocal like 'Oliveira do Hospital'
	  and instanteChamada between '2018-01-01 00:00' and '2018-12-31 23:59'
	  and (numprocessosocorro not in(select  numprocessosocorro
                                   from Audita natural join eventoemergencia
					                         where moradaLocal like 'Oliveira do Hospital' and instanteChamada between '2018-01-01 00:00' and '2018-12-31 23:59')
	       or nummeio not in(select  nummeio
                           from Audita natural join eventoemergencia
					                 where moradaLocal like 'Oliveira do Hospital' and instanteChamada between '2018-01-01 00:00' and '2018-12-31 23:59'));

4-  select count(numSegmento)
	  from segmentoVideo natural join vigia
	  where moradaLocal = 'Monchique' and duracao >'00:00:60' and dataHoraInicio between '2018-08-01 00:00:00' and '2018-09-01 00:00:00';


5-	select numMeio, nomeEntidade, nomemeio
	  from meio natural join meiocombate
	  where numMeio not in (select numMeio from MeioApoio natural join aciona);

6-	select distinct a.nomeentidade
    from aciona a
    where not exists ((select distinct numprocessosocorro
                       from aciona)
				              except
                      (select distinct c.numprocessosocorro
						           from aciona C, meioCombate M
						           where c.nummeio = m.nummeio and a.nomeentidade = m.nomeentidade));
