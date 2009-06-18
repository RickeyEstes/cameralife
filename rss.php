<?php

/**Creates RSS feed of photos
@link http://fdcl.sourceforge.net
*@version 2.6.2
*@author Will Entriken <cameralife@phor.net>
*@copyright Copyright (c) 2001-2009 Will Entriken
*@access public
*/
/**
*/
  $features=array('database','theme','security', 'photostore');
  require "main.inc";

  $search = new Search($_GET['q']);
  $searchicon = $search->GetIcon();
  $search->SetSort('newest');
  $photos = $search->GetPhotos();

  header('Content-type: text/xml');
  echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0">
  <channel>
    <title><![CDATA[<?= $cameralife->GetPref('sitename') ?> - <?= $searchicon['name'] ?>]]></title>
    <link><?= $cameralife->base_url ?></link>
    <description>'<? $searchicon['name'] ?>'</description>
    <language>en-us</language>
<?php
  foreach($photos as $photo)
  {
    $icon = $photo->GetIcon();
    $date = strtotime($photo->Get('created'));

    echo "    <item>\n";
    echo "      <title><![CDATA[".$photo->Get('description')."]]></title>\n";
    echo "      <link>".$icon['href']."</link>\n";
    echo "      <guid isPermaLink=\"true\">".$icon['href']."</guid>\n";
    echo "      <description><![CDATA[<a href=\"".$icon['href']."\"><img border=\"0\" src=\"".$icon['image']."\"></a>]]></description>\n";
    echo "      <category>photo</category>\n";
    echo "      <pubDate>".date('r',$date)."</pubDate>\n";
#    echo "      <enclosure url=\"".$icon['image']."\" type=\"image/jpeg\" length=\"0\"></enclosure>\n";
    echo "    </item>\n";
  }
?>
  </channel>
</rss>
