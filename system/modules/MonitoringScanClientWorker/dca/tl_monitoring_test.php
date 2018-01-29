<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2017 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    MonitoringScanClientWorker
 * @license    LGPL
 */
 
/**
 * Add css for styling global operations button
 */
$GLOBALS['TL_CSS'][] = 'system/modules/MonitoringScanClientWorker/assets/styles.css';

/**
 * Add global operations
 */
array_insert($GLOBALS['TL_DCA']['tl_monitoring_test']['list']['global_operations'], count($GLOBALS['TL_DCA']['tl_monitoring_test']['list']['global_operations']) - 1, array
(
    'scanClientWorkOffOne' => array
    (
        'label'               => &$GLOBALS['TL_LANG']['tl_monitoring_test']['scanClientWorkOffOne'],
        'href'                => 'key=scanClientWorkOffOne',
        'class'               => 'header_icon tl_monitoring_test_scanClientWorkerExecute',
        'attributes'          => 'onclick="Backend.getScrollOffset()"',
        'button_callback'     => array('tl_monitoring_test_MonitoringScanClientWorker', 'renderScanClientWorkerExecuteButton') 
    )
));

/**
 * Class tl_monitoring_test_MonitoringScanClientWorker
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_monitoring_test_MonitoringScanClientWorker extends Backend
{
  /**
   * Default constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Return the scan client worker execute button
   *
   * @param string $href
   * @param string $label
   * @param string $title
   * @param string $class
   * @param string $attributes
   *
   * @return string
   */
  public function renderScanClientWorkerExecuteButton($href, $label, $title, $class, $attributes)
  {
    $objMonitoringEntry = \MonitoringModel::findByPk(\Input::get('id'));
    return ($objMonitoringEntry != null && $objMonitoringEntry->client_scan_active) ? '<a href="'.$this->addToUrl($href).'" class="'.$class.'" title="'.specialchars($title).'"'.$attributes.'>'.$label.'</a> ' : '';
  }
}

?>