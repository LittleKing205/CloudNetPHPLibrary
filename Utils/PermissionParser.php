<?php
namespace CloudNetLibrary\Utils;

use CloudNetLibrary\Interfaces\Permission;

class PermissionParser {
    
    public static function parse($serverGroupArray) {
        $groupData = array();
        $permissionReadMode = false;
        $permissionGroupReadMode = false;
        $groupIndex = -1;
        $permGroupTmpName = "";
        foreach ($serverGroupArray as $row) {
            $matches = null;
            if (preg_match("#^\* (.*) \| ([0-9]{1,3})$#", $row, $matches)) {
                $groupIndex = $matches[1];
                $permissionReadMode = false;
                $permissionGroupReadMode = false;
                $permGroupTmpName = "";
                $groupData[$groupIndex]["potency"] = $matches[2];
            }
            if (preg_match("#^Default: (true|false) \| SortId: ([0-9]{1,4})$#", $row, $matches)) {
                $groupData[$groupIndex]["default"] = ($matches[1] = "true") ? true : false;
                $groupData[$groupIndex]["sortId"] = intval($matches[2]);
            }
            if (preg_match("#^Prefix: (.*)$#", $row, $matches)) {
                $groupData[$groupIndex]["prefix"] = $matches[1];
            }
            if (preg_match("#^Color: (.*)$#", $row, $matches)) {
                $groupData[$groupIndex]["color"] = $matches[1];
            }
            if (preg_match("#^Suffix: (.*)$#", $row, $matches)) {
                $groupData[$groupIndex]["suffix"] = $matches[1];
            }
            if (preg_match("#^Display: (.*)$#", $row, $matches)) {
                $groupData[$groupIndex]["display"] = $matches[1];
            }
            if (preg_match("#Permissions:#", $row, $matches)) {
                $permissionReadMode = true;
                $permissionGroupReadMode = false;
                $groupData[$groupIndex]["permissions"] = array();
            }
            if (preg_match("#^\* (.\w*)$#", $row, $matches)) {
                $permGroupTmpName = $matches[1];
                $permissionReadMode = false;
                $permissionGroupReadMode = true;
            }
            if (preg_match("#^- (.*):([0-9]{1,3}) \| Timeout (.*)$#", $row, $matches) && $permissionReadMode) {
                if ($matches[3] == "LIFETIME")
                    $tmpTime = -1;
                else
                    $tmpTime = \DateTimeImmutable::createFromFormat('d.m.Y H:i:s', '13.01.2021 22:17:53')->getTimestamp()*1000 - round(microtime(true) * 1000);
                $groupData[$groupIndex]["permissions"][] = new Permission(array(
                    "name" => $matches[1],
                    "potency" => intval($matches[2]),
                    "timeOutMillis" => $tmpTime
                ));
            }
            if (preg_match("#^- (.*):([0-9]{1,3}) \| Timeout (.*)$#", $row, $matches) && $permissionGroupReadMode) {
                if (!$groupData[$groupIndex]["groupPermissions"][$permGroupTmpName])
                    $groupData[$groupIndex]["groupPermissions"][$permGroupTmpName] = array();
                if ($matches[3] == "LIFETIME")
                    $tmpTime = -1;
                else
                    $tmpTime = \DateTimeImmutable::createFromFormat('d.m.Y H:i:s', $matches[3])->getTimestamp()*1000 - round(microtime(true) * 1000);
                $groupData[$groupIndex]["groupPermissions"][$permGroupTmpName][] = new Permission(array(
                    "name" => $matches[1],
                    "potency" => intval($matches[2]),
                    "timeOutMillis" => $tmpTime
                ));
            }
        }
        return $groupData;
    }
}