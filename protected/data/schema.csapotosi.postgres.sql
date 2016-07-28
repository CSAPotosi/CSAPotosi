CREATE TABLE IF NOT EXISTS pais(
  cod_pais    VARCHAR(4)  NOT NULL PRIMARY KEY ,
  nombre_pais VARCHAR(64) NOT NULL ,
  gentilicio  VARCHAR(32)
);

CREATE TABLE IF NOT EXISTS persona(
  id_persona SERIAL NOT NULL PRIMARY KEY ,
  num_doc VARCHAR(32) NOT NULL DEFAULT '0',
  tipo_doc SMALLINT DEFAULT 0,
  nombres VARCHAR(128) NOT NULL ,
  primer_apellido VARCHAR(32) NOT NULL ,
  segundo_apellido VARCHAR(32),
  genero BOOLEAN,
  fecha_nac TIMESTAMP DEFAULT '01-01-0001',
  estado_civil VARCHAR(32),
  ocupacion VARCHAR(32),
  nacionalidad VARCHAR(4),
  localidad VARCHAR(64),
  domicilio VARCHAR(64),
  telefono VARCHAR(32),
  email VARCHAR(128),
  foto VARCHAR(256),
  FOREIGN KEY (nacionalidad) REFERENCES pais(cod_pais)
);

CREATE TABLE IF NOT EXISTS empleado(
  id_empleado INT PRIMARY KEY ,
  fecha_contratacion DATE,
  estado_emp BOOLEAN DEFAULT TRUE ,
  cod_maquina INT,
  FOREIGN KEY (id_empleado) REFERENCES persona(id_persona)
);

CREATE TABLE IF NOT EXISTS medico(
  id_medico INT PRIMARY KEY ,
  matricula VARCHAR(16) UNIQUE NOT NULL ,
  estado_med BOOLEAN DEFAULT TRUE ,
  FOREIGN KEY (id_medico) REFERENCES persona (id_persona)
);

CREATE TABLE IF NOT EXISTS paciente(
  id_paciente INT PRIMARY KEY NOT NULL ,
  codigo_paciente VARCHAR(16),
  grupo_sanguineo VARCHAR(8),
  fecha_deceso TIMESTAMP,
  estado_paciente SMALLINT DEFAULT 1,
  responsable VARCHAR(512),
  FOREIGN KEY (id_paciente) REFERENCES persona(id_persona)
);

CREATE TABLE IF NOT EXISTS historial_medico(
  id_historial INT PRIMARY KEY NOT NULL ,
  fecha_creacion TIMESTAMP NOT NULL ,
  fecha_edicion TIMESTAMP NOT NULL ,
  FOREIGN KEY (id_historial) REFERENCES paciente(id_paciente)
);

CREATE TABLE IF NOT EXISTS usuario(
  id_usuario INT PRIMARY KEY NOT NULL ,
  nombre_usuario VARCHAR(32) UNIQUE NOT  NULL ,
  clave VARCHAR(128) NOT NULL ,
  estado_usuario SMALLINT DEFAULT 1 ,
  FOREIGN KEY (id_usuario) REFERENCES persona(id_persona)
);

/*************/
create table if not exists "AuthItem"
(
  "name"                 varchar(64) not null,
  "type"                 integer not null,
  "description"          text,
  "bizrule"              text,
  "data"                 text,
  primary key ("name")
);

create table if not exists "AuthItemChild"
(
  "parent"               varchar(64) not null,
  "child"                varchar(64) not null,
  primary key ("parent","child"),
  foreign key ("parent") references "AuthItem" ("name") on delete cascade on update cascade,
  foreign key ("child") references "AuthItem" ("name") on delete cascade on update cascade
);

create table if not exists "AuthAssignment"
(
  "itemname"             varchar(64) not null,
  "userid"               varchar(64) not null,
  "bizrule"              text,
  "data"                 text,
  primary key ("itemname","userid"),
  foreign key ("itemname") references "AuthItem" ("name") on delete cascade on update cascade,
  foreign key ("userid") references usuario ("nombre_usuario") on delete cascade on update cascade
);
/*************/
CREATE TABLE IF NOT EXISTS capitulo_cie(
  num_cap VARCHAR(8) PRIMARY KEY NOT NULL,
  titulo_cap TEXT UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS categoria_cie(
  id_cat SERIAL PRIMARY KEY NOT NULL,
  titulo_cat TEXT UNIQUE NOT NULL,
  cod_ini VARCHAR(8) NOT NULL ,
  cod_fin VARCHAR(8) NOT NULL ,
  num_cap VARCHAR(8) NOT NULL,
  FOREIGN KEY (num_cap) REFERENCES capitulo_cie(num_cap)
);

CREATE TABLE IF NOT EXISTS item_cie(
  codigo VARCHAR(8) PRIMARY KEY NOT NULL ,
  titulo TEXT NOT NULL ,
  descripcion TEXT,
  codigo_padre VARCHAR(8),
  id_cat INT NOT NULL,
  FOREIGN KEY (codigo_padre) REFERENCES item_cie(codigo),
  FOREIGN KEY (id_cat) REFERENCES categoria_cie(id_cat)
);

CREATE TABLE IF NOT EXISTS medicamento(
  codigo VARCHAR(8) NOT NULL PRIMARY KEY ,
  nombre_med VARCHAR(64) NOT NULL ,
  forma_farm VARCHAR(64) NOT NULL ,
  concentracion VARCHAR(32) NOT NULL,
  "ATQ" VARCHAR(8) NOT NULL ,
  restringido BOOLEAN DEFAULT FALSE,
  estado_med SMALLINT DEFAULT 1 -- 0:Excluido, 1:normal, 2:incluido
);


-- modulo servicios
CREATE TABLE IF NOT EXISTS servicio(
  id_serv SERIAL NOT NULL PRIMARY KEY ,
  cod_serv VARCHAR(8) NOT NULL,
  nombre_serv VARCHAR(64) NOT NULL,
  unidad_medida VARCHAR(32),
  precio_serv FLOAT NOT NULL,
  tipo_cobro SMALLINT DEFAULT 1, -- 1:unidad, 2:mas de uno, 3:uso, 4:por dia
  fecha_creacion TIMESTAMP,
  fecha_edicion TIMESTAMP,
  activo BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS categoria_serv_examen(
  id_cat_ex SERIAL NOT NULL PRIMARY KEY,
  cod_cat_ex VARCHAR(8) NOT NULL,
  nombre_cat_ex VARCHAR(64) NOT NULL ,
  descripcion_cat_ex TEXT,
  tipo_ex SMALLINT -- 0: No definido, 1: laboratorio, 2: rayosX, 3: ecografia
);

CREATE TABLE IF NOT EXISTS serv_examen(
  id_serv INT NOT NULL PRIMARY KEY,
  condiciones_ex TEXT,
  id_cat_ex INT NOT NULL,
  FOREIGN KEY (id_serv) REFERENCES servicio(id_serv),
  FOREIGN KEY (id_cat_ex) REFERENCES categoria_serv_examen(id_cat_ex)
);
