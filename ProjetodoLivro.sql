create table receitas_despesas
(
id mediumint NOT NULL auto_increment,
usuario varchar(20) NOT NULL,
descricao varchar(80) NOT NULL,
tipo char(2) NOT NULL,
data date NOT NULL,
valor float NOT NULL,
primary key (id)
);

create table usuarios_autorizados
(
usuario varchar(20) NOT NULL,
senha varchar(20) NOT NULL,
primary key (usuario)
);