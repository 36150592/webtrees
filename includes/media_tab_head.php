<?php
// Provides media tab header for reorder media Items using drag and drop
//
// webtrees: Web based Family History software
// Copyright (C) 2011 webtrees development team.
//
// Derived from PhpGedView
// Copyright (C) 2009  PHPGedView Development Team.  All rights reserved.
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
//
// $Id$

if (!defined('WT_WEBTREES')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

global $gedrec, $pid;
?>
<script type="text/javascript">
<!--
	function reorder_media() {
	var win02 = window.open("edit_interface.php?action=reorder_media&pid=<?php echo $pid; ?>", "win02", "resizable=1, menubar=0, scrollbars=1, top=20, height=840, width=450 ");
	if (window.focus) {win02.focus();}
	}
-->
</script>

<?php
	// Find if indi and family associated media exists and then count them ( $tot_med_ct)
	require WT_ROOT.'includes/media_reorder_count.php';

	$gedrec = find_gedcom_record($pid, WT_GED_ID);
	$regexp = "/OBJE @(.*)@/";
	$ct = preg_match_all($regexp, $gedrec, $match, PREG_SET_ORDER);

	// If media exists and is greater than 1 item ---------------------
	if ($tot_med_ct>1) {
			//Popup Reorder Media
			echo "<button type=\"button\" title=\"". WT_I18N::translate('Re-order media')."\" onclick=\"reorder_media();\">". WT_I18N::translate('Re-order media') ."</button>";
	}
