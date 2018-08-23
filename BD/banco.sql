create database sistem;
use sistem;

create table tipo_usuario(
id_tipo int not null auto_increment,
nome_tipo varchar(60) not null,
primary key(id_tipo)
);

create table Usuario(
id_usuario int not null auto_increment,
nome_usuario varchar(120) not null,
login_usuario varchar(120) not null,
senha_usuario varchar(120) not null,
tipo_id int not null,
telefone_usuario varchar(18) not null,
primary key(id_usuario),
foreign key(tipo_id) references tipo_usuario(id_tipo)
);

create table tipo_colecao(
id_tipo int not null auto_increment,
nome_tipo varchar(40) not null,
primary key(id_tipo)
);
insert into tipo_colecao(nome_tipo) values ('Ocorrendo');
insert into tipo_colecao(nome_tipo) values ('Principal');
insert into tipo_colecao(nome_tipo) values ('Concluido');

create table Colecao(
id_colecao int not null auto_increment,
nome_colecao varchar(120) not null,
ecolecao_id int not null,
primary key(id_colecao),
foreign key(ecolecao_id) references tipo_colecao(id_tipo)
);

create table Tecido(
id_tecido int not null auto_increment,
nome_tecido varchar(120) not null,
composicao_tecido varchar(120) not null,
valor_tecido double not null,
fornecedor_tecido varchar(120) not null,
primary key(id_tecido)
);

create table foto(
id_foto int not null auto_increment,
nome_foto varchar(120) not null,
peca_id int not null,
primary key(id_foto),
foreign key(peca_id) references peca(id_peca)
);

create table cor(
id_cor int not null auto_increment,
nome_cor varchar(60) not null,
primary key(id_cor)
);

create table Grade(
id_grade int not null auto_increment,
tamanhop_grade int,
tamanhom_grade int,
tamanhog_grade int,
peca_id int not null,
primary key(id_grade),
foreign key(peca_id) references peca(id_peca)
);

create table modelagem(
id_modelagem int not null auto_increment,
nome_material varchar(120),
quantidade_material int,
preco_material double,
peca_id int not null,
primary key(id_modelagem),
foreign key(peca_id) references peca(id_peca)
);

create table ampliacao(
id_ampliacao int not null auto_increment,
peca_id int not null,
detalhe varchar(180),
primary key(id_ampliacao)
);

create table avaliacao(
id_avaliacao int not null auto_increment,
peca_id int not null,
comentario varchar(180),
primary key(id_avaliacao)
);

create table corte(
id_corte int not null auto_increment,
peca_id int not null,
responsavel_corte int not null,
data_entrada date not null,
data_saida date not null,
primary key(id_corte),
foreign key(responsavel_corte) references usuario(id_usuario)
);

create table costura(
id_costura int not null auto_increment,
peca_id int not null,
responsavel_costura int not null,
data_entrada date not null,
data_saida date not null,
primary key(id_costura),
foreign key(responsavel_costura) references usuario(id_usuario)
);

create table etapa(
id_etapa int not null auto_increment,
nome_etapa varchar(60),
primary key(id_etapa)
);

create table tecido_cor(
id_tcor int not null auto_increment,
cor_id int not null,
tecido_id int not null,
quantidade_tcor double not null,
qtdusada_tcor double,
primary key(id_tcor),
foreign key(tecido_id) references Tecido(id_tecido),
foreign key(cor_id) references Cor(id_cor)
);

create table peca(
id_peca int not null auto_increment,
nome_peca varchar(120) not null,
colecao_id int not null,
tecido_id int,
forro_id int,
entretela_id int not null,
composicao_peca varchar(120),
referencia_peca varchar(10),
data_peca date not null,
etapa_id int not null,
qtd_peca int,
valor_peca double,
primary key(id_peca),
foreign key(colecao_id) references Colecao(id_colecao),
foreign key(tecido_id) references tecido_cor(tecido_id)
);

create table pagamento(
id_pagamento int not null auto_increment,
funcionario_id int not null,
peca_id int not null,
data_pag date not null,
valor int not null,
primary key(id_pagamento),
foreign key(peca_id) references peca(id_peca)
);

create table compras(
id_compras int not null auto_increment,
material_id int not null,
primary key(id_compras),
foreign key(material_id) references material(id_material)
);

create table impressao(
id_impressao int not null auto_increment,
peca_id int not null,
funcionario_id int not null,
etapa_id int not null,
primary key(id_impressao),
foreign key(peca_id) references peca(id_peca),
foreign key(funcionario_id) references usuario(id_usuario),
foreign key(etapa_id) references etapa(id_etapa)
);

insert into tipo_usuario (nome_tipo) values ('Gerencia');
insert into tipo_usuario (nome_tipo) values ('Costureira');
insert into tipo_usuario (nome_tipo) values ('Cortador');
insert into usuario(nome_usuario,login_usuario, senha_usuario, tipo_id, telefone_usuario) values('Usuario','usuario','123456',1,123456789);
insert into etapa(nome_etapa) values('Modelagem');
insert into etapa(nome_etapa) values('Avaliação');
insert into etapa(nome_etapa) values('Ampliação');
insert into etapa(nome_etapa) values('Corte');
insert into etapa(nome_etapa) values('Costura');
insert into etapa(nome_etapa) values('Concluido');
insert into etapa(nome_etapa) values('Aguardando');
insert into tecido(nome_tecido,composicao_tecido,fornecedor_tecido,valor_tecido) values('Nenhum','Nenhum','Nenhum',0);
insert into cor(nome_cor) values('nenhum');
insert into tecido_cor(cor_id,tecido_id,quantidade_tcor) values(1,1,0);

