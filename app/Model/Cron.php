<?php
App::uses('AppModel', 'Model');
/**
 * Prospect Model
 *
 * @property State $State
 * @property Language $Language
 * @property OriginType $OriginType
 * @property DeviceType $DeviceType
 * @property ProspectProduct $ProspectProduct
 * @property ProspectResponse $ProspectResponse
 */
class Cron extends AppModel {
	public $useTable = 'prospects';
}
