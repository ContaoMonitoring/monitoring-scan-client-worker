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
 * Run in a custom namespace, so the class can be replaced
 */
namespace Monitoring;

/**
 * Class MonitoringScanClientWorker
 *
 * Contains functions to work off the scanned client data.
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class MonitoringScanClientWorker extends \Backend
{
  /**
   * Constructor
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Work off the scanned client data of the current (identified by $_GET['id']) monitoring entry.
   */
  public function scanClientWorkOffOne()
  {
      $this->scanClientWorkOffMonitoringEntry(\MonitoringModel::findByPk(\Input::get('id')));

      \Message::addConfirmation(sprintf($GLOBALS['TL_LANG']['MSC']['monitoringScanClientWorkedOffOne'], \Input::get('id')));
      $this->logDebugMsg("Executed the workers for scannned client data of monitoring entry with ID " . \Input::get('id'), __METHOD__);

      $urlParam = \Input::get('do');

      if (\Input::get('table') == "tl_monitoring_test" && \Input::get('id'))
      {
          $urlParam .= "&table=tl_monitoring_test&id=" . \Input::get('id');
      }

      $this->returnToList($urlParam);
  }

  /**
   * Work off the scanned client data of all monitoring entries.
   */
  public function scanClientWorkOffAll()
  {
      $arrMonitoringEntrys = \MonitoringModel::findAll();
      foreach ($arrMonitoringEntrys as $objMonitoringEntry)
      {
        $this->scanClientWorkOffMonitoringEntry($objMonitoringEntry);
      }

      \Message::addConfirmation($GLOBALS['TL_LANG']['MSC']['monitoringScanClientWorkedOffAll']);
      $this->logDebugMsg("Executed the workers for scanned client data of all monitoring entries.", __METHOD__);

      $this->returnToList(\Input::get('do'));
  }

  /**
   * Automatically (CRON triggered) executing the workers for scanned client data.
   */
  public function scanClientWorkOffAllAuto()
  {
    if (\Config::get('monitoringAutoScanClientWorkOffActive') === TRUE)
    {
      $arrMonitoringEntrys = \MonitoringModel::findAll();
      foreach ($arrMonitoringEntrys as $objMonitoringEntry)
      {
        if (!$objMonitoringEntry->disable_auto_scanClientWorkerExecute)
        {
          $this->scanClientWorkOffMonitoringEntry($objMonitoringEntry);
        }
      }
      $this->log('Automatically executed the workers  for scanned client data.', __METHOD__, TL_CRON);
    }
  }

  /**
   * Executed the workers for scanned client data of the given monitoring entry.
   *
   * @param $objMonitoringEntry The monitoring entry
   */
  private function scanClientWorkOffMonitoringEntry($objMonitoringEntry)
  {
    if ($objMonitoringEntry != null && !$objMonitoringEntry->disable && $objMonitoringEntry->client_scan_active)
    {
      $monitoringScanClient = new \MonitoringScanClient();
      $response = $monitoringScanClient->scanClient($objMonitoringEntry->client_url, $objMonitoringEntry->client_token);
      if (is_array($response))
      {
        if (isset($GLOBALS['TL_HOOKS']['monitoringScanClientWork']) && is_array($GLOBALS['TL_HOOKS']['monitoringScanClientWork']))
        {
          foreach ($GLOBALS['TL_HOOKS']['monitoringScanClientWork'] as $callback)
          {
            $this->import($callback[0]);
            $this->{$callback[0]}->{$callback[1]}($objMonitoringEntry, $response);
          }
        }
      }
      else
      {
        $this->log('Error when executing the workers for scanned client data of monitoring entry ID ' . $objMonitoringEntry->id . " with message: " . $response, __METHOD__, TL_ERROR);
      }
    }
  }

  /**
   * Redirect to the list.
   */
  private function returnToList($act)
  {
    $path = \Environment::get('base') . 'contao/main.php?do=' . $act;
    $this->redirect($path, 301);
  }

  /**
   * Logs the given message if the debug mode is anabled.
   */
  private function logDebugMsg($msg, $origin)
  {
    if (\Config::get('monitoringDebugMode') === TRUE)
    {
      $this->log($msg, $origin, TL_GENERAL);
    }
  }
}

?>