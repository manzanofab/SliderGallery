<?php
/**
 * @copyright	Copyright (C) 2013 Fabian Manzano. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE.'/components/com_content/helpers/route.php');

abstract class modSliderGalleryHelper
{
public static function check($params,$folder_name) 
		{
	$files = glob("images/".$folder_name."/*.*");
	$numberFiles = count($files);
	$list         = array();
	$imageContent = array();	
	$totalWidth   = 0 ;
	$error        = "";
	$cont = 0;

	if ($numberFiles == 0) 
	{
	$error = "
<div class=\"alert alert-error alert-block\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
<p><strong>Warning!</strong>
Unfortunately I couldnt find any images in the folder or maybe the folder is spelled wrongly?<br>
The folder name is: <span class=\"label label-warning\">$folder_name</span></p>
</div>
		";
	}
	else
	{
		for ($i=0; $i<count($files); $i++) 
		{ 
		$image = $files[$i]; 
		list($width, $height) = getimagesize($image);
			if (is_numeric($width)) 
			{
			$cont++;
			$totalWidth = $width + $totalWidth ;
			$imageContent [$cont-1] = "<div id=\"img-$i\" class=\"contentbox\"><img src=\"$image\" ></div>";
				if ($cont == 1) //save the links in this loop to display later and avoid doing this 
				{
$list[$cont-1] = "<li><a class=\"active\" href=\"#\" onClick=\"goto('#img-$i', this); return false\">Image $i</a></li>";
				}
				else
				{
$list[$cont-1] = "<li><a href=\"#\" onClick=\"goto('#img-$i', this); return false\">Image $i</a></li>";			
				}
			}
		}
		if ($cont == 0 )
		{
		$error = "
<div class=\"alert alert-error alert-block\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
<p><strong>Warning!</strong>
Unfortunately I couldnt find any images in the folder or maybe the folder is spelled wrongly?<br>
The folder name is: <span class=\"label label-warning\">$folder_name</span></p>
</div>
			";
		}
	}
if ( $totalWidth != 0 ) 
{	$totalWidth = $totalWidth."px";}
else                    
{	$totalWidth = "100%";}

$allInformation = array (
					"file"         => $numberFiles,
					"images"       => $cont,
					"list"         => $list,
					"imageContent" => $imageContent,
					"width"        => $totalWidth,
					"error"        => $error
					);

return $allInformation;
		}
}	