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
$GLOBALS['TL_LANG']['tl_monitoring']['disable_auto_scanClientWorkerExecute'] = array('Automatische Ausführung der Abarbeitung von MonitoringClient Daten deaktivieren', 'Wählen Sie ob die automatische Ausführung der Abarbeitung von ausgelesenen MonitoringClient Daten für diesen Monitoring Eintrag deaktiviert werden soll.');
$GLOBALS['TL_LANG']['tl_monitoring']['excluded_scanClientWorkers']           = array('Ausgenommende Abarbeitung von MonitoringClient Daten', 'Wählen Sie welche Ausführung der Abarbeitung von ausgelesenen MonitoringClient Daten für diesen Monitoring Eintrag ausgeschlossen werden soll.');

/**
 * Legends
*/
$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkerExecute_legend'] = 'Ausführung der Abarbeitung von MonitoringClient Daten';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkOffAll'] = array('MonitoringClient Daten für alle abarbeiten', 'Führt die Abarbeitung die ausgelesenen MonitoringClient Daten aller Monitoring Einträge aus.');
$GLOBALS['TL_LANG']['tl_monitoring']['scanClientWorkOffOne'] = array('MonitoringClient Daten abarbeiten', 'Führt die Abarbeitung die ausgelesenen MonitoringClient Daten des Monitoring Eintrags mit der ID %s aus.');

?>