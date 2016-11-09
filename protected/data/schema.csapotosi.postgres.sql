CREATE TABLE IF NOT EXISTS pais(
  cod_pais    VARCHAR(4)  NOT NULL PRIMARY KEY ,
  nombre_pais VARCHAR(64) NOT NULL ,
  gentilicio  VARCHAR(32)
);
--Insert todos los paises
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
--insert para persona admin admin
CREATE TABLE IF NOT EXISTS empleado(
  id_empleado INT PRIMARY KEY ,
  fecha_contratacion DATE,
  estado_emp BOOLEAN DEFAULT TRUE ,
  cod_maquina INT,
  FOREIGN KEY (id_empleado) REFERENCES persona(id_persona)
);
--insert para empleado admin admin
CREATE TABLE IF NOT EXISTS medico(
  id_medico INT PRIMARY KEY ,
  matricula VARCHAR(16) UNIQUE NOT NULL ,
  estado_med BOOLEAN DEFAULT TRUE ,
  FOREIGN KEY (id_medico) REFERENCES persona (id_persona)
);
create table if not exists especialidad(
  id_especialidad SERIAL primary key not null,
  nombre_especialidad  varchar(50) not null,
  descripcion varchar(128)
);
--*insert especialidades medicas*
create table if not exists medico_especialidad(
  id_m_e serial not null primary key,
  id_medico int ,
  id_especialidad int,
  foreign key (id_medico)references medico(id_medico),
  foreign key(id_especialidad) references especialidad(id_especialidad)
);
CREATE TABLE IF NOT EXISTS paciente(
  id_paciente INT PRIMARY KEY NOT NULL ,
  codigo_paciente VARCHAR(16),
  grupo_sanguineo VARCHAR(8),
  fecha_deceso TIMESTAMP,
  estado_paciente SMALLINT DEFAULT 1,--0 inhabilitado o muerto, 1 habilitado ,2 internado
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
--insert un usuario admin admin

/***********/

create table if not exists unidad(
  id_unidad serial primary key ,
  nombre_unidad varchar(32) not null unique,
  descripcion_unidad varchar(128)
);
create table if not exists horario(
  id_horario serial primary key ,
  nombre_horario varchar(32) not null unique,
  descripcion varchar (32),
  ciclo_total int
);
create table if not exists cargo(
  id_cargo serial primary key ,
  nombre_cargo varchar (32) not null unique ,
  descripcion_cargo varchar(128),
  id_unidad int,
  id_horario int,
  foreign key (id_unidad) references unidad(id_unidad),
  foreign key (id_horario) REFERENCES horario(id_horario)
);
create table if not exists periodo(
  id_periodo serial primary key,
  hora_entrada time not null,
  inicio_entrada int default 0,
  fin_entrada int default 0,
  hora_salida time not null,
  inicio_salida int default 0,
  fin_salida int DEFAULT 0,
  tolerancia int default 15,
  tipo_periodo int
);
create table if not EXISTS horario_periodo(
  id_horario_periodo serial primary key not null,
  id_horario int,
  id_periodo int,
  dia int,
  foreign key (id_horario) references horario(id_horario),
  foreign key (id_periodo) references periodo(id_periodo)
);
create table if not exists asignacion_empleado(
  id_asignacion serial primary key,
  fecha_inicio date not null,
  fecha_fin date default null,
  vigente bool default false,
  id_empleado int,
  id_cargo int,
  foreign key (id_empleado) references empleado(id_empleado),
  foreign key (id_cargo) references cargo(id_cargo)
);
create table if not exists registro(
  id_asignacion int not null,
  fecha date not null,
  hora_asistencia time not null,
  observaciones varchar(128),
  estado bool,
  primary key(fecha,hora_asistencia,id_asignacion),
  foreign key (id_asignacion) references asignacion_empleado(id_asignacion)
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
--insert capitulo_cie
CREATE TABLE IF NOT EXISTS categoria_cie(
  id_cat SERIAL PRIMARY KEY NOT NULL,
  titulo_cat TEXT UNIQUE NOT NULL,
  cod_ini VARCHAR(8) NOT NULL ,
  cod_fin VARCHAR(8) NOT NULL ,
  num_cap VARCHAR(8) NOT NULL,
  FOREIGN KEY (num_cap) REFERENCES capitulo_cie(num_cap)
);
--insert categoria_cie
CREATE TABLE IF NOT EXISTS item_cie(
  codigo VARCHAR(8) PRIMARY KEY NOT NULL ,
  titulo TEXT NOT NULL ,
  descripcion TEXT,
  codigo_padre VARCHAR(8),
  id_cat INT NOT NULL,
  FOREIGN KEY (codigo_padre) REFERENCES item_cie(codigo),
  FOREIGN KEY (id_cat) REFERENCES categoria_cie(id_cat)
);
--insert item_cie
CREATE TABLE IF NOT EXISTS medicamento(
  codigo VARCHAR(8) NOT NULL PRIMARY KEY ,
  nombre_med VARCHAR(64) NOT NULL ,
  forma_farm VARCHAR(64) NOT NULL ,
  concentracion VARCHAR(32) NOT NULL,
  "ATQ" VARCHAR(8) NOT NULL ,
  restringido BOOLEAN DEFAULT FALSE,
  estado_med SMALLINT DEFAULT 1 -- 0:Excluido, 1:normal, 2:incluido
);
--*insert cargar liname*

-- modulo servicios

CREATE TABLE IF NOT EXISTS entidad(
  id_entidad SERIAL NOT NULL PRIMARY KEY,
  razon_social VARCHAR(128) NOT NULL,
  direccion VARCHAR(64),
  telefono VARCHAR(16),
  tipo_entidad SMALLINT NOT NULL,-- consumidor,  proveedor,
  naturaleza_juridica SMALLINT NOT NULL-- 0 natural, 1 juridica
);
--insert ID=1
--       RAZON_SOCIAL=SANTA ANA, --PARTICULAR
--		 DIRECCION=10 DE NOCIEMBRE,--""
--		 TELEFONO=8768757,-""
--		 PROVEEDOR=2-""
CREATE TABLE IF NOT EXISTS servicio(
  id_serv SERIAL NOT NULL PRIMARY KEY ,
  cod_serv VARCHAR(8) NOT NULL,
  nombre_serv VARCHAR(64) NOT NULL,
  tipo_cobro SMALLINT DEFAULT 1, -- 1:por cantidad, 2 por dia,
  fecha_creacion TIMESTAMP,
  fecha_edicion TIMESTAMP,
  activo BOOLEAN DEFAULT TRUE,
  id_entidad INT NOT NULL,
  FOREIGN KEY (id_entidad) REFERENCES entidad(id_entidad)
);

CREATE TABLE IF NOT EXISTS precio(
  id_precio SERIAL NOT NULL PRIMARY KEY ,
  id_serv INT NOT NULL ,
  monto DECIMAL NOT NULL,
  fecha_inicio TIMESTAMP NOT NULL,
  fecha_fin TIMESTAMP,
  activo BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)
);

CREATE TABLE IF NOT EXISTS categoria_serv_examen(
  id_cat_ex SERIAL NOT NULL PRIMARY KEY,
  cod_cat_ex VARCHAR(8) NOT NULL,
  nombre_cat_ex VARCHAR(64) NOT NULL ,
  descripcion_cat_ex TEXT,
  activo BOOLEAN DEFAULT TRUE,
  tipo_ex SMALLINT -- 0: No definido, 1: laboratorio, 2: rayosX, 3: ecografia
);

CREATE TABLE IF NOT EXISTS serv_examen(
  id_serv INT NOT NULL PRIMARY KEY,
  condiciones_ex TEXT,
  id_cat_ex INT NOT NULL,
  FOREIGN KEY (id_serv) REFERENCES servicio(id_serv),
  FOREIGN KEY (id_cat_ex) REFERENCES categoria_serv_examen(id_cat_ex)
);

--enfermeria, otros,
CREATE TABLE IF NOT EXISTS categoria_serv_clinico(
  id_cat_cli SERIAL NOT NULL PRIMARY KEY,
  cod_cat_cli VARCHAR(8) NOT NULL,
  nombre_cat_cli VARCHAR(64) NOT NULL ,
  descripcion_cat_cli TEXT,
  activo BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS serv_clinico(
  id_serv INT NOT NULL PRIMARY KEY,
  descripcion_cli TEXT,
  unidad_medida VARCHAR(32),
  id_cat_cli INT NOT NULL,
  FOREIGN KEY (id_serv) REFERENCES servicio(id_serv),
  FOREIGN KEY (id_cat_cli) REFERENCES categoria_serv_clinico(id_cat_cli)
);

CREATE TABLE IF NOT EXISTS serv_tipo_sala(
  id_serv INT NOT NULL PRIMARY KEY,
  descripcion_t_sala TEXT,
  FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)
);

CREATE TABLE IF NOT EXISTS sala(
  id_sala SERIAL NOT NULL PRIMARY KEY,
  cod_sala VARCHAR (8) NOT NULL,
  ubicacion_sala VARCHAR (32),
  estado_sala SMALLINT NOT NULL DEFAULT 1,--1 activo, 0 inactivo, 2:ocupado, 3 mantenimiento
  id_t_sala INT NOT NULL,
  FOREIGN KEY (id_t_sala) REFERENCES serv_tipo_sala(id_serv)
);

CREATE TABLE IF NOT EXISTS serv_atencion_medica(
  id_serv INT NOT NULL PRIMARY KEY,
  id_m_e INT NOT NULL,  --id medico_especialidad
  cod_espe varchar(8),
  FOREIGN KEY (id_m_e) REFERENCES medico_especialidad(id_m_e)
);
create table if not exists internacion(
  id_inter serial not null primary key ,
  id_historial int not null ,
  fecha_ingreso timestamp not null,
  motivo_ingreso SMALLINT not null,--accidente,enfermedad, parto
  observacion_ingreso varchar(256),
  procedencia_ingreso SMALLINT,--consulta exterma,emergencia,externo
  fecha_alta timestamp,
  tipo_alta SMALLINT,--medica, fuga, solicitada,transferencia
  observacion_alta varchar (256),
  fecha_egreso timestamp,
  estado SMALLINT DEFAULT 0, -- 0 novigente, 1 vigente
  foreign key (id_historial) references historial_medico(id_historial)
);

/*create table if NOT EXISTS insti_direrido_transferencia (
  id     SERIAL PRIMARY KEY NOT NULL,
  nombre VARCHAR(64)
);

create table internacion_insti_diferido_transferencia(
  id_inter int  primary key not null,
  id_ext int,
  tipo varchar(16),
  FOREIGN KEY (id_inter) REFERENCES internacion(id_inter),
  FOREIGN KEY (id_ext) REFERENCES insti_direrido_transferencia(id)
);*/
=======
create table if not exists prestacion_servicio(
  id_prestacion serial not null primary key,
  id_historial int not null,
  observaciones varchar(256),
  tipo int not null,--0 externo 1 internacion
  fecha_solicitud timestamp,
  foreign key(id_historial) references historial_medico(id_historial)
);
create table if not exists detalle_prestacion(
  id_detalle serial not null primary key,
  id_prestacion int not null,
  id_servicio int not null,
  fecha_solicitud TIMESTAMP not null,
  cantidad float not null,
  subtotal  float not null,
  pagado boolean default false,
  realizado boolean DEFAULT false,
  foreign key (id_prestacion) references prestacion_servicio(id_prestacion),
  foreign key (id_servicio) references servicio(id_serv)
);
create table if not exists internacion_sala(
  id_inter int not null,
  id_sala int not null,
  fecha_entrada timestamp not null,
  fecha_salida timestamp,
  foreign key(id_inter) references internacion (id_inter),
  foreign key(id_sala) references sala(id_sala),
  primary key(id_inter,id_sala,fecha_entrada)
);
create table if not exists convenio(
  id_convenio serial not null primary key,
  fecha_creacion timestamp not null,
  fecha_edicion timestamp not null,
  nombre_convenio varchar (128) not null,
  id_entidad int not null,
  activo boolean DEFAULT false,
  foreign key (id_entidad) references entidad(id_entidad)
);
create table if not exists convenio_servicios(
  id_con_ser serial not null primary key,
  descuento_servicio float not null,
  activo bool default false,
  id_convenio int not null,
  id_servicio int not null,
  foreign key (id_convenio) references convenio(id_convenio),
  foreign key (id_servicio) references  servicio(id_servicio)
);

create table if not exists diagnostico(
  id_diag serial primary key not null ,
  fecha_diag timestamp not null ,
  anamnesis text not NULL,
  exploracion text ,
  conclusion text ,
  observaciones text ,
  tipo SMALLINT not NULL DEFAULT 0,--0externo, 1 internacion
  id_historial int not null ,
  id_diag_padre int,
  foreign key (id_historia) references historial_medico(id_historial),
  foreign key (id_diag_padre) references diagnostico(id_diag)
);
create table if not exists consulta_cie10(
  id_diag int not null ,
  codigo varchar(8) not null ,
  foreign key (id_diag) references consulta(id_diag),
  foreign key (codigo) references item_cie(codigo),
  primary key (id_diag,codigo)
);
