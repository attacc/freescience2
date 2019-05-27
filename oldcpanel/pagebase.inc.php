<?
class f_template {
	var $title;
	var $top;
	var $bottom;
	var $menu;
	var $page;
	var $bgcolor;
	var $link;
	var $description;
	var $keywords;
	var $sfondo;

	
	Function Set_sfondo($sfondo)
	{
	$this->sfondo=$sfondo;
	}

	
	Function Set_Color($bgcolor)
	{
	$this->bgcolor=$bgcolor;
	}
	Function Set_Description($description)
	{
	$this->description=$description;
	}
	
	Function Set_Keywords($keywords)
	{
	$this->keywords=$keywords;
	}
		

	Function Set_Link($link)
	{
	$this->link=$link;
	}
	
	Function Set_Title($title)
	{
	$this->title=$title;
	}
	
	Function Set_Top($top)
	{
	$this->top=$top;
	}
	
	Function Set_Bottom($bot)
	{
	$this->bottom=$bot;
	}	
	
	Function Set_Menu($menu)
	{
	$this->menu=$menu;
	}
	
	Function Set_Page($page)
	{
	$this->page=$page;
	}

	Function ShowPage()
	{	
	global $language;
	print('
		<html>
		<head>	
		<title>'.$this->title.	'</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="author" CONTENT="FreeScience.info">
		<META NAME="description" CONTENT="'.$this->description.'">
		<META NAME="keywords" CONTENT="'.$this->keywords.'">		
		<meta name="country" CONTENT="IT">
		<meta name="revisit_after" CONTENT="30">
                <meta name="title" CONTENT="'.$this->title.'">
                <meta name="language" CONTENT="IT">
		<meta name="Microsoft Border" content="none">
		<meta name="robots" content="index, follow">
		<meta name="robots" content="all">
		<meta name="robots" content="Aladin">
		<meta name="robots" content="scooter">
		<meta name="robots" content="google">
		<meta name="robots" content="altavista">
		<meta name="robots" content="Crawler">
		<meta name="robots" content="Eule-Robot">
		<meta name="robots" content="excite">
		<meta name="robots" content="Flipper/1.1">
		<meta name="robots" content="SmartCrawl">
		<meta name="robots" content="Motor0.5">
		<meta name="robots" content="Mariner">
		<meta name="robots" content="Lycos">
		<meta name="revisit-after" content="15 days">
		<meta name="generator" content="FreeScience.info metamaker">
	        <link rel="shortcut icon" href="http://www.freescience.info/favicon.ico">
		</head>
		<body link="'.$this->link.'" bgcolor="'.$this->bgcolor.'" background="'.$this->sfondo.'">');
	require($this->top);
	require($this->menu);	
	print("
		<table width=\"100%\" border=\"0\">
		<tr>
		<td width=\"18%\" valign=\"top\">".$menu."
		</td>
		<td width=\"82%\" valign=\"top\">".$this->page);
	print("</td></tr>
	</table>".$this->bottom);
	print("</BODY></HTML>");
		}
	}
?>
