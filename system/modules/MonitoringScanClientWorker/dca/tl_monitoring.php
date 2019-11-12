<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2019 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2017-2019
 * @author     Cliff Parnitzky
 * @package    MonitoringScanClientWorker
 * @license    LGPL
 */

/**
 * Add css for styling global operations button
 */
$GLOBALS['TL_CSS'][] = 'system/modules/MonitoringScanClientWorker/assets/styles.css';

/**
 * Add callback
 */
$GLOBALS['TL_DCA']['tl_monitoring']['config']['onload_callback'][] = array('tl_monitoring_MonitoringScanClientWorker', 'initPalettes');

/**
 * Add global operations
 */
array_insert($GLOBALS['TL_DCA']['tl_monitoring']['list']['global_operations'], count($GLOBALS['TL_DCA']['tl_monitoring']['list']['global_operations']) - 1, array
(
    'scanClientWorkOffAll' => array
    (
        'label' => &$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkOffAll'],
        'href'  => 'key=scanClientWorkOffAll',
        'class' => 'header_icon tl_monitoring_scanClientWorkerExecute'
    )
));

/**
 * Add operations
 */
$GLOBALS['TL_DCA']['tl_monitoring']['list']['operations']['scanClientWorkOffOne'] = array
(
  'label'               => &$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkOffOne'],
  'href'                => 'key=scanClientWorkOffOne',
  'icon'                => 'system/modules/MonitoringScanClientWorker/assets/icon_scanClientWorkerExecute.png',
  'button_callback'     => array('tl_monitoring_MonitoringScanClientWorker', 'renderScanClientWorkerExecuteButton') 
);

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_monitoring']['fields']['disable_auto_scanClientWorkerExecute'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_monitoring']['disable_auto_scanClientWorkerExecute'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'clr'),
    'sql'                     => "char(1) NOT NULL default ''"
);

/**
 * Class tl_monitoring_MonitoringScanClientWorker
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2017-2019
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_monitoring_MonitoringScanClientWorker extends Backend
{
  /**
   * Default constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Generate the scan client worker execute button
   *
   * @param array  $row
   * @param string $href
   * @param string $label
   * @param string $title
   * @param string $icon
   *
   * @return string
   */
  public function renderScanClientWorkerExecuteButton($row, $href, $label, $title, $icon)
  {
    return ($row['client_scan_active']) ? '<a href="' . $this->addToUrl($href.'&amp;id='.$row['id']) . '" title="'.specialchars($title).'">'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.png$/i', '_.png', $icon)).' ';
  }

  /**
   * Initialize the palettes when loading
   * @param \DataContainer
   */
  public function initPalettes()
  {
    if (\Input::get('act') == "edit")
    {
      $objMonitoringEntry = \MonitoringModel::findByPk(\Input::get('id'));
      if ($objMonitoringEntry != null && $objMonitoringEntry->client_scan_active)
      {
        $arrDefaultPalletEntries = explode(";", $GLOBALS['TL_DCA']['tl_monitoring']['palettes']['default']);
        foreach ($arrDefaultPalletEntries as $index=>$entry)
        {
          if (strpos($entry, "{client_legend}") !== FALSE)
          {
            $entry .= ";{scanClientWorkerExecute_legend},disable_auto_scanClientWorkerExecute";
            $arrDefaultPalletEntries[$index] = $entry;
          }
        }
        $GLOBALS['TL_DCA']['tl_monitoring']['palettes']['default'] = implode(";", $arrDefaultPalletEntries);
      }
    }
  }
}

?>