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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_monitoring']['disable_auto_scanClientWorkerExecute'] = array('Disable automatic execution of workers for MonitoringClient data', 'Select whether the automatic execution of workers for scanned MonitoringClient data for this monitoring entry should be disabled.');
$GLOBALS['TL_LANG']['tl_monitoring']['excluded_scanClientWorkers']           = array('Excluded workers for MonitoringClient data', 'Select which workers should not be executed for scanned MonitoringClient data for this monitoring entry.');

/**
 * Legends
*/
$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkerExecute_legend'] = 'Execution of workers for MonitoringClient data';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkOffAll'] = array('Work off MonitoringClient data for all', 'Execute the workers for scanned MonitoringClient data for all monitoring entries.');
$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkOffOne'] = array('Work off MonitoringClient data', 'Execute the workers for scanned MonitoringClient data for monitoring entry with ID %s.');

?>