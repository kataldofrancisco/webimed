<?php
class HistorialConsulta extends AppModel{
	var $belongsTo = array(
		'PrmGrupo' => array(
			'className' => 'PrmGrupo',
			'foreignKey' => 'PrmGrupo_CodGrupo',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PrmPrestacion' => array(
			'className' => 'PrmPrestacion',
			'foreignKey' => 'PrmGrupo_CodPrestacion',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));

		function guardarHistorial($data) {
			if (isset($data['prestacion']) && stristr($data['prestacion'], '[')) {
				$codigo_tmp =  explode(']',$data['prestacion']);
				$codigo = $codigo_tmp[0];
				$codigo = explode('[', $codigo);
				$data['PrmPrestacion_CodPrestacion'] = $codigo[1];
			}
			if ($this->save($data)) {
				$retorno = array('estado'=>0, 'glosa'=>'');
			} else {
			$retorno = array('estado'=>1, 'glosa'=>'No se guardaron datos');
			}
			return true;
		}
}
?>
