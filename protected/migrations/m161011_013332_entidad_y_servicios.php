<?php

class m161011_013332_entidad_y_servicios extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('entidad',[
			'id_entidad' => "pk",
			'razon_social' => "VARCHAR(128) NOT NULL",
			'direccion' => "VARCHAR(64)",
			'telefono' => "VARCHAR(16)",
			'tipo_entidad' => "SMALLINT NOT NULL",
			'naturaleza_juridica' => "SMALLINT NOT NULL"
		]);

		$this->createTable('servicio',[
			'id_serv' => "pk",
			'cod_serv' => "VARCHAR(8) NOT NULL",
			'nombre_serv' => "VARCHAR(64) NOT NULL",
			'tipo_cobro' => "SMALLINT DEFAULT 1",
			'fecha_creacion' => "TIMESTAMP",
			'fecha_edicion' => "TIMESTAMP",
			'activo' => "BOOLEAN DEFAULT TRUE",
			'id_entidad' => "INT NOT NULL",
			"FOREIGN KEY (id_entidad) REFERENCES entidad(id_entidad)"
		]);

		$this->createTable('precio',[
			'id_precio' => "pk",
			'id_serv' => "INT NOT NULL",
			'monto' => "FLOAT NOT NULL",
			'fecha_inicio' => "TIMESTAMP NOT NULL",
			'fecha_fin' => "TIMESTAMP",
			'activo' => "BOOLEAN DEFAULT FALSE",
			"FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)"
		]);

		$this->createTable('categoria_serv_examen',[
			'id_cat_ex' => "pk",
			'cod_cat_ex' => "VARCHAR(8) NOT NULL",
			'nombre_cat_ex' => "VARCHAR(64) NOT NULL",
			'descripcion_cat_ex' => "TEXT",
			'activo' => "BOOLEAN DEFAULT TRUE",
			'tipo_ex' => "SMALLINT"
		]);
		
		$this->createTable('serv_examen',[
			'id_serv' => "INT NOT NULL PRIMARY KEY",
			'condiciones' => "TEXT",
			'id_cat_ex' => "INT NOT NULL",
			"FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)",
			"FOREIGN KEY (id_cat_ex) REFERENCES categoria_serv_examen(id_cat_ex)"
		]);

		$this->createTable('categoria_serv_clinico',[
			'id_cat_cli' => "pk",
			'cod_cat_cli' => "VARCHAR(8) NOT NULL",
			'nombre_cat_cli' => "VARCHAR(64) NOT NULL",
			'descripcion_cat_cli' => "TEXT",
			'activo' => "BOOLEAN DEFAULT TRUE"
		]);

		$this->createTable('serv_clinico',[
			'id_serv' => "INT NOT NULL PRIMARY KEY",
			'descripcion_cli' => "TEXT",
			'unidad_medida' => "VARCHAR(32)",
			'id_cat_cli' => "INT NOT NULL",
			"FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)",
			"FOREIGN KEY (id_cat_cli) REFERENCES categoria_serv_clinico(id_cat_cli)"
		]);

		$this->createTable('serv_tipo_sala',[
			'id_serv' => "INT NOT NULL PRIMARY KEY",
			'descripcion_t_sala' => "TEXT",
			"FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)"
		]);

		$this->createTable('sala',[
			'id_sala' => "pk",
			'cod_sala' => "VARCHAR(8) NOT NULL",
			'ubicacion_sala' => "VARCHAR(32)",
			'estado_sala' => "SMALLINT NOT NULL DEFAULT 1",
			'id_t_sala' => "INT NOT NULL",
			"FOREIGN KEY (id_t_sala) REFERENCES serv_tipo_sala(id_serv)"
		]);

		$this->createTable('serv_atencion_medica',[
			'id_serv' => "INT NOT NULL PRIMARY KEY",
			'id_m_e' => "INT NOT NULL",
			'cod_espe' => "VARCHAR(8)",
			"FOREIGN KEY (id_m_e) REFERENCES medico_especialidad(id_m_e)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('serv_atencion_medica');
		$this->dropTable('sala');
		$this->dropTable('serv_tipo_sala');
		$this->dropTable('serv_clinico');
		$this->dropTable('categoria_serv_clinico');
		$this->dropTable('serv_examen');
		$this->dropTable('categoria_serv_examen');
		$this->dropTable('precio');
		$this->dropTable('servicio');
		$this->dropTable('entidad');
	}

}