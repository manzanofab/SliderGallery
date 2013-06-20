<?php
/**
 * @copyright	Copyright (C) 2013 Fabian Manzano. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php 
$folder_name   = $params->get('folder');
$allInformation = modSliderGalleryHelper::check($params,$folder_name);
?>

<div id="content"> 
    <div class="contentbox-wrapper" style="width:<?php echo $allInformation["width"]; ?>" > 
<?php
//print_r(array_keys($allInformation));
if (count($allInformation["imageContent"])==0){echo $allInformation["error"];}
else
{
$arrlength=count($allInformation["imageContent"]);
for($x=0;$x<$arrlength;$x++)
  {
  echo $allInformation["imageContent"][$x];
  }
}
?>
    </div>
 
</div>
<div id="nav">
    <ul>
<?php
$arrlength=count($allInformation["list"]);
for($x=0;$x<$arrlength;$x++)
  {
  echo $allInformation["list"][$x];
  }
?>

    </ul>
</div>

<script>
function goto(id, t){
    //animate to the div id.
    $(".contentbox-wrapper").animate({"left": -($(id).position().left)}, 600);
 
    // remove "active" class from all links inside #nav
    $('#nav a').removeClass('active');
 
    // add active class to the current link
    $(t).addClass('active');
}
</script>
