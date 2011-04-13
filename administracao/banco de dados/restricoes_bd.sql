---- Tabela: campus ----
-- Mudadndo a engine para InnoDB
ALTER TABLE `ifbaiano15`.`campus` ENGINE = InnoDB ;



---- Tabela: curso ----
-- Mudadndo a engine para InnoDB
ALTER TABLE `ifbaiano15`.`curso` ENGINE = InnoDB ;
-- Criando a foreign key da tabela campus
ALTER TABLE `ifbaiano15`.`curso` 
  ADD CONSTRAINT `fk_curso_campus`
  FOREIGN KEY (`campus` )
  REFERENCES `ifbaiano15`.`campus` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_curso_campus` (`campus` ASC) ;



---- Tabela: inscrito ----
-- Mudadndo a engine para InnoDB
ALTER TABLE `ifbaiano15`.`inscrito` ENGINE = InnoDB ;
-- Criando a restrição UNIQUE para o CPF
ALTER TABLE `ifbaiano15`.`inscrito` 
ADD UNIQUE INDEX `unique_cpf` (`cpf` ASC) ;



---- Tabela: inscrito_curso ----
-- Mudadndo a engine para InnoDB
ALTER TABLE `ifbaiano15`.`inscrito_curso` ENGINE = InnoDB ;
-- Criando foreign keys
ALTER TABLE `ifbaiano15`.`inscrito_curso` 
  ADD CONSTRAINT `fk_inscrito_curso_curso`
  FOREIGN KEY (`cod_curso` )
  REFERENCES `ifbaiano15`.`curso` (`cod_curso` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION, 
  ADD CONSTRAINT `fk_inscrito_curso_inscrito`
  FOREIGN KEY (`id_inscrito` )
  REFERENCES `ifbaiano15`.`inscrito` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_inscrito_curso_curso` (`cod_curso` ASC) 
, ADD INDEX `fk_inscrito_curso_inscrito` (`id_inscrito` ASC) ;



---- Tabela: localprova ----
-- Mudadndo a engine para InnoDB
ALTER TABLE `ifbaiano15`.`localprova` ENGINE = InnoDB ;
-- Criando foreign keys
ALTER TABLE `ifbaiano15`.`localprova` 
  ADD CONSTRAINT `fk_localprova_campus`
  FOREIGN KEY (`campus` )
  REFERENCES `ifbaiano15`.`campus` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_localprova_campus` (`campus` ASC) ;



---- Tabela: usuario ----
-- Mudadndo a engine para InnoDB
ALTER TABLE `ifbaiano15`.`usuario` ENGINE = InnoDB ;
