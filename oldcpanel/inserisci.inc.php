<?

function showcampo($campi)
{
include "valoricampi.php";
for($i=0;$i<count($campi);$i++)
{
if($i%2==0) $color=INSCOL1;
	else $color=INSCOL2;
switch($campi[$i])
{
  case "url":
  $linea.='<tr><td align="center" bgcolor="'.$color.'"> Url </td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="http://" size="40" maxlength="255" tabindex="3" ></td></tr>';
	  break;
  case "descrizione":
  case "it":
  case "en":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.$campi[$i].'</td>
  	  <td><textarea name="'.$campi[$i].'" rows="7" cols="40" wrap="virtual" dir="ltr"
               tabindex="5"></textarea>
        </td></tr>';
	break;
  case "linkautore":
  case "titolo":
  case "pagine":
  case "year":
  case "img":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.$campi[$i].' </td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="" size="40" maxlength="128" tabindex="3" ></td></tr>';
	  break;
 case "autore":
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.AUTORE.' </td>
  	  <td> <input type="text" name="'.$campi[$i].'" value="" size="40" maxlength="64" tabindex="3" ></td></tr>';
	  break;
  case "data":
  $linea.='<input type=hidden name="data" value="'.date('y-m-j').'">';
  break;
  case "active":
  $linea.='<input type=hidden name="active" value="0">';
  break;
  case "formato":
   $formatins.='<table><tr>';
  for($j = 0; $j<count($formati);$j++)
  { 
  if($j%4==0) 
     $formatins.='</tr><tr><td><input type="checkbox" name="'.$formati[$j].'" value="'.$formati[$j].'"> <b>'.$formati[$j].'</b></td>';
  else
      $formatins.='<td><input type="checkbox" name="'.$formati[$j].'" value="'.$formati[$j].'"> <b>'.$formati[$j].'</b></td>';
  }
  $formatins.='</tr></table>';
  $linea.='<tr><td align="center" bgcolor="'.$color.'">'.FORMATO.' </td>
	    <td>'.$formatins.'</td></tr>';
  break;
  case "langue":
  $lingue_presenti.='<table><tr>';
  for($j = 0; $j<count($lingue);$j++)
   {
    if($j%4==0) 
   $lingue_presenti.='</tr><tr><td><input type="radio" name="'.$campi[$i].'" value="'.$lingue[$j].'">
         	<img src="../flags/'.$lingue[$j].'.png"></td>';
   else 
    $lingue_presenti.='<td><input type="radio" name="'.$campi[$i].'" value="'.$lingue[$j].'">
         	<img src="../flags/'.$lingue[$j].'.png"></td>';
   }
   $lingue_presenti.='</tr></table>';
   $linea.='<tr><td align="center" bgcolor="'.$color.'">'.LINGUA.' </td>
	    <td>'.$lingue_presenti.'</td></tr>';
  break;
  case "multilangue":
  $lingue_presenti.='<table><tr>';
  for($j = 0; $j<count($lingue);$j++)
  {
  if($j%4==0) 
  $lingue_presenti.='</tr><tr><td><input type="checkbox" name="'.$lingue[$j].'" value="'.$lingue[$j].'">  <img src="../flags/'.$lingue[$j].'.png" ></td>';
  else
  $lingue_presenti.='<td><input type="checkbox" name="'.$lingue[$j].'" value="'.$lingue[$j].'">
  <img src="../flags/'.$lingue[$j].'.png" ></td>';

  }
  $lingue_presenti.='</tr></table>';
   $linea.='<tr><td align="center" bgcolor="'.$color.'">'.LINGUA.' </td>
	    <td>'.$lingue_presenti.'</td></tr>';
  break;
  case "os":
  $osins.="<table><tr>";
  for($j = 0; $j<count($opsys);$j++)
  {
  if($j%3==0) 
  $osins.='</tr><tr><td><input type="checkbox" name="'.$opsys[$j].'" value="1">  <img src="../os/'.$opsys[$j].'.png" width="15"><font face=arial size=-1>'.$opsys[$j].'</font><td>';
  else
  $osins.='<td><input type="checkbox" name="'.$opsys[$j].'" value="'.$opsys[$j].'">  <img src="../os/'.$opsys[$j].'.png" width="15"> <font face=arial size=-1>'.$opsys[$j].'</font></td>';
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

