<?php
/**********************************************************************************
 *   Copyright(C) 2002 David Stevens
 *
 *   This file is part of OpenBiblio.
 *
 *   OpenBiblio is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   OpenBiblio is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with OpenBiblio; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **********************************************************************************
 */
?>


<?php if ($nav == "home") { ?>
 &raquo; Biblio Search<br>
<?php } else { ?>
 <a href="../opac/index.php" class="alt1">Bibliography Search</a><br>
<?php } ?>

<?php if ($nav == "search") { ?>
 &raquo; Search Results<br>
<?php } ?>

<?php if ($nav == "view") { ?>
 &raquo; Biblio Info<br>
<?php } ?>

<a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=".$helpPage; ?>')">Help</a>
