<?php 
?>
<style type="text/css">
.tg-outer  {color: #666; font-size :13px; box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); margin: 5px 15px 2px;padding: 20px; max-width: 1111px;}
.emph  {color:#000}
.tg  {border-collapse:collapse;border-spacing:0; border-color:#ccc; background: #fff;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;;border-color:#ccc;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;;border-color:#ccc;}
.tg .tg-n4rq{background-color:#f1f1f1;border-color:#ccc;text-align:left;vertical-align:middle}
.tg .tg-879b{background-color:#f1f1f1;text-align:left;vertical-align:middle}
.tg .tg-0pky{border-color:#ccc;text-align:left;vertical-align:middle}
.tg .tg-g7sd{font-weight:bold;border-color:#ccc;text-align:left;vertical-align:middle}
.tg .tg-fymr{font-weight:bold;border-color:#ccc;text-align:left;vertical-align:middle}
.tg .tg-y698{background-color:#f1f1f1;border-color:#ccc;text-align:left;vertical-align:middle; font-size: 0.9em;}
.tg .tg-0lax{text-align:left;vertical-align:middle}
</style>

<div class="tg-outer">

<h2>Perfecto Portfolio Shortcode</h2>

<table class="form-table">
  <tr valign="top">
    <th scope="row">Default shortcode</th>
    <td>
      <p><b class="emph">[perfecto-portfolio]</b></p>
      <p>To simply use the shortcode with default options place the code above in any page or post.</p>
    </td>
  </tr>
</table>

<h3>Options (Parameters)</h3>

<table class="form-table">
  <tr valign="top">
    <th scope="row">Build your shortcode</th>
    <td>
      <input type="text" name="new_option_name" size="100" style="width:100%;" value='[perfecto-portfolio columns = "4" filters-show-all-option = "true"  ]' />
      <p>Build your shortcode by copy and pasting parameters from the options table below inside the brackets. Once your shortcode is ready just place it in any page or post.</p>
    </td>
  </tr>
</table>

<p>The following options are available to customize the output of your Perfecto Portfolio grid. Multiple parameters can be used at the same time, in any order. Mix & match them to create the perfect portfolio grid for your site.</p>

<table class="tg">
  <tr>
    <th class="tg-0pky"><span style="font-weight:bold">Feature</span></th>
    <th class="tg-g7sd">Parameter</th>
    <th class="tg-fymr">Default Value</th>
    <th class="tg-fymr">Possible Value</th>
    <th class="tg-fymr">Pro Version Only</th>
    <th class="tg-fymr">Description</th>
  </tr>
  <tr>
    <td class="tg-y698" colspan="6">General Display options</td>
  </tr>
  <tr>
    <td class="tg-0pky">Grid Columns</td>
    <td class="tg-0pky"><span style="font-weight:bold">columns = "4"</span></td>
    <td class="tg-0pky">4</td>
    <td class="tg-0pky"> 1, 2, 3, 4, 5</td>
    <td class="tg-n4rq">Only in Pro.<br></td>
    <td class="tg-0pky">Sets the number of columns for the portfolio grid.</td>
  </tr>
  <tr>
    <td class="tg-0pky">Grid Gap</td>
    <td class="tg-0pky"><span style="font-weight:bold">grid-gap = "medium"</span></td>
    <td class="tg-0pky">"medium"</td>
    <td class="tg-0pky">"small", "medium", "large" or "collapse"</td>
    <td class="tg-n4rq">Only in Pro.</td>
    <td class="tg-0pky">Sets the space around the grid items.</td>
  </tr>
  <tr>
    <td class="tg-0pky">Show Titles in Grid</td>
    <td class="tg-0pky"><span style="font-weight:bold">show-titles = "false"</span></td>
    <td class="tg-0pky">false</td>
    <td class="tg-0pky">true or false</td>
    <td class="tg-n4rq">Only in Pro.</td>
    <td class="tg-0pky">Allows you to show or hide the individual portfolio item titles in the grid.</td>
  </tr>
  <tr>
    <td class="tg-0pky">Title placement</td>
    <td class="tg-0pky"><span style="font-weight:bold">title-style = "below"</span></td>
    <td class="tg-0pky">"below"</td>
    <td class="tg-0pky">"below", "overlay" or "hover"</td>
    <td class="tg-n4rq">Only in Pro.</td>
    <td class="tg-0pky">Works only if <span style="font-weight:bold">show-titles = "true"</span> is set. This extra option gives you the ability to position and refine the appearance of the titles of the individual items in the grid.</td>
  </tr>
  <tr>
    <td class="tg-y698" colspan="6">Modal Oltions</td>
  </tr>
  <tr>
    <td class="tg-0pky">Show Modal<br></td>
    <td class="tg-0pky"><span style="font-weight:bold">modal = "true"</span></td>
    <td class="tg-0pky">true</td>
    <td class="tg-0pky">true or false</td>
    <td class="tg-0pky">Available.</td>
    <td class="tg-0pky"><span style="font-weight:normal">Turns on modal feature. Makes a portfolio item open in a modal window when it's is clicked in the grid.</span></td>
  </tr>
  <tr>
    <td class="tg-0pky">Modal Type</td>
    <td class="tg-0pky"><span style="font-weight:bold">modal-type = "modal"</span></td>
    <td class="tg-0pky"><span style="font-weight:normal">modal</span></td>
    <td class="tg-0pky"><span style="font-weight:normal">"modal", "gallery" or "lightbox"</span></td>
    <td class="tg-n4rq">Only in Pro.</td>
    <td class="tg-0pky">Works only if <span style="font-weight:bold">modal = "true"</span>. This extra option can change the position and layout of the modal.<br></td>
  </tr>
  <tr>
    <td class="tg-y698" colspan="6">Filters above display grid</td>
  </tr>
  <tr>
    <td class="tg-0pky">Tag Filters<br></td>
    <td class="tg-0pky"><span style="font-weight:bold">filters = "true"</span></td>
    <td class="tg-0pky">true</td>
    <td class="tg-0pky">true or false</td>
    <td class="tg-0pky">Availabe.</td>
    <td class="tg-0pky">Prints filter tags above the grid. Clicking one of the filters will only show the portfolio items that were tagged with that specific filter.</td>
  </tr>
  <tr>
    <td class="tg-0pky">Filter Alignment</td>
    <td class="tg-0pky"><span style="font-weight:bold">filters-alignment = "left"</span></td>
    <td class="tg-0pky">left</td>
    <td class="tg-0pky">"left", "right" or "center"</td>
    <td class="tg-0pky">Available</td>
    <td class="tg-0pky">Works only if <span style="font-weight:bold">filters = "true</span>". This extra option gives you the ability to align the filters.</td>
  </tr>
  <tr>
    <td class="tg-0pky">Remove Filters "All"</td>
    <td class="tg-0pky"><span style="font-weight:bold">filters-show-all-option= "true"</span></td>
    <td class="tg-0pky">true</td>
    <td class="tg-0pky">true or false</td>
    <td class="tg-0pky">Available</td>
    <td class="tg-0pky">Works only if <span style="font-weight:bold">filters = "true"</span>. This extra option gives you the ability to show or hide an extra filter named "All" that returns to an unfiltered result of the portfolio grid.</td>
  </tr>
  <tr>
    <td class="tg-0lax">Rename "All" Filter</td>
    <td class="tg-0lax"><span style="font-weight:bold">filters-all-label="Show All"</span></td>
    <td class="tg-0lax">"All"</td>
    <td class="tg-0lax">any string less than 30 characters</td>
    <td class="tg-879b">Only in Pro.</td>
    <td class="tg-0lax">Works only if <span style="font-weight:bold">filters = "true"</span> and <span style="font-weight:bold">filters-show-all-option= "true"</span>. This extra option gives you the ability rename the "All" filter to display a custom text.</td>
  </tr>
  <tr>
    <td class="tg-0pky">Allow certain filters only</td>
    <td class="tg-0pky"><span style="font-weight:bold">filter-tags = "tag-1"</span></td>
    <td class="tg-0pky">none</td>
    <td class="tg-0pky">tag-1, tag-2, tag-3 etc<br></td>
    <td class="tg-n4rq">Only in Pro.</td>
    <td class="tg-0pky">Works only if <span style="font-weight:bold">"filters" = true</span>. This extra option gives you the ability to only show certain filters at the top of the portfolio grid. It takes comma separated tag slugs of the tags you used on the Perfecto Portfolio post type.</td>
  </tr>
</table>
</div>
