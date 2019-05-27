<?

function modcampi($campi)
{
global $arr;
include cpanel."valoricampi.php";
for($i=0;$i<count($campi);$i++)
{
if($i%2==0) $color=INSCOL1;
	else $color=INSCOL2;
switch($campi[$i])
{
  case "url":
  $linea.='<tr><td align="center" bgcolor="'.$color.'"> Url </td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="'.$arr[$campi[$i]].'" size="40" maxlength="255" tabindex="3" ></td></tr>';
	  break;
  case "descrizione":
  case "it":
  case "en":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.$campi[$i].'</td>
  	  <td><textarea name="'.$campi[$i].'" rows="7" cols="40" wrap="virtual" dir="ltr"
               tabindex="5">'.$arr[$campi[$i]].'</textarea>
        </td></tr>';
	break;
  case "year":
  case "linkautore":
  case "titolo":
  case "img":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.$campi[$i].' </td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="'.$arr[$campi[$i]].'" size="40" maxlength="128" tabindex="3" ></td></tr>';
	  break;
 case "autore":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.AUTORE.' </td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="'.$arr[$campi[$i]].'" size="40" maxlength="48" tabindex="3" ></td></tr>';
	  break;
  case "data":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.DATA.'</td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="'.$arr[$campi[$i]].'" size="10" maxlength="10" tabindex="3" ></td></tr>';
  break;
  case "id_categoria":
  case "cat2":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.CATEGORIA.'</td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="'.$arr[$campi[$i]].'" size="4" maxlength="4" tabindex="3" ></td></tr>';
  break;
  case "click":
  case "pagine":
   $linea.='<tr><td align="center" bgcolor="'.$color.'">'.$campi[$i].'</td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="'.$arr[$campi[$i]].'" size="4" maxlength="4" tabindex="3" ></td></tr>';
  break;

  case "id_links":
  $linea.='<input type=hidden name="id_links" value="'.$arr["id_links"].'">';
  break;
  case "active":
  $linea.='<input type=hidden name="active" value="'.$arr["active"].'">';
  break;
  case "formato":
  $format_div = explode(",",$arr[$campi[$i]]);
  $formatins.='<table><tr>';
  for($j = 0; $j<count($formati);$j++)
  { 
  $checked="";
   for($k = 0; $k<count($format_div);$k++)
     {
       if($formati[$j]==trim($format_div[$k]))
           $checked="checked"; 
   }
  if($j%4==0) 
     $formatins.='</tr><tr><td><input type="checkbox" name="'.$formati[$j].'" value="'.$formati[$j].'" '.$checked.'> <b>'.$formati[$j].'</b></td>';
  else
      $formatins.='<td><input type="checkbox" name="'.$formati[$j].'" value="'.$formati[$j].'" '.$checked.'> <b>'.$formati[$j].'</b></td>';
  }
  $formatins.='</tr></table>';
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.FORMATO.' </td>
	    <td>'.$formatins.'</td></tr>';
  break;
  case "langue":
  $lingue_presenti.='<table><tr>';
  for($j = 0; $j<count($lingue);$j++)
   {
   
   if($lingue[$j]==$arr[$campi[$i]])
   $checked=" checked ";
   else 
   $checked="";
   
   if($j%4==0) 
   $lingue_presenti.='</tr><tr><td><input type="radio" name="'.$campi[$i].'" value="'.$lingue[$j].'"
    '.$checked.'>
         	<img src="../flags/'.$lingue[$j].'.png"></td>';
   else 
    $lingue_presenti.='<td><input type="radio" name="'.$campi[$i].'" value="'.$lingue[$j].'" '.$checked.'>
         	<img src="../flags/'.$lingue[$j].'.png"></td>';
   }
   $lingue_presenti.='</tr></table>';
   $linea.='<tr><td align="center" bgcolor="'.$color.'">'.LINGUA.' </td>
	    <td>'.$lingue_presenti.'</td></tr>';
  break;
  case "multilangue":
  $lingue_presenti.='<table><tr>';
  $lingue_div = explode(" ",$arr[$campi[$i]]);

  for($j = 0; $j<count($lingue);$j++)
  {
  $checked="";
   for($k = 0; $k<count($lingue_div);$k++)
       if($lingue[$j]==$lingue_div[$k])
           $checked="checked"; 

  if($j%4==0) 
  $lingue_presenti.='</tr><tr><td><input type="checkbox" name="'.$lingue[$j].'" value="'.$lingue[$j].'" '.$checked.'>  <img src="../flags/'.$lingue[$j].'.png" ></td>';
  else
  $lingue_presenti.='<td><input type="checkbox" name="'.$lingue[$j].'" value="'.$lingue[$j].'" '.$checked.'>
  <img src="../flags/'.$lingue[$j].'.png" ></td>';

  }
  $lingue_presenti.='</tr></table>';
   $linea.='<tr><td align="center" bgcolor="'.$color.'">'.LINGUA.' </td>
	    <td>'.$lingue_presenti.'</td></tr>';
  break;
  case "os":
   $os_div = explode(" ",$arr[$campi[$i]]);
  $osins.="<table><tr>";
  for($j = 0; $j<count($opsys);$j++)
  {
  $checked="";
   for($k = 0; $k<count($os_div);$k++)
       if($opsys[$j]==$os_div[$k])
	  $checked="checked";  
  if($j%3==0) 
  $osins.='</tr><tr><td><input type="checkbox" name="'.$opsys[$j].'" value="1" '.$checked.'>  <img src="../os/'.$opsys[$j].'.png" width="15"><font face=arial size=-1>'.$opsys[$j].'</font><td>';
  else
  $osins.='<td><input type="checkbox" name="'.$opsys[$j].'" value="'.$opsys[$j].'" '.$checked.'>  <img src="../os/'.$opsys[$j].'.png" width="15"> <font face=arial size=-1>'.$opsys[$j].'</font></td>';
   }
   $osins.="</tr></table><tr>";
   $linea.='<tr><td align="center" bgcolor="'.$color.'">'.OS.' </td>
	    <td>'.$osins.'</td></tr>';
  break;
   }
}
return $linea;
}


?>

