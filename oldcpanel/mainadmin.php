<?
global $HTTP_HOST; 
global $HTTP_USER_AGENT; 
global $REMOTE_ADDR;
global $REMOTE_PORT;  
global $SCRIPT_FILENAME;
global $SERVER_ADDR;
global $SERVER_ADMIN; 
global $SERVER_NAME; 
global $SERVER_PORT; 
$main='
<center><h2>Benvenuto nel pannello di controllo</h2>
	<table width="70%"  align="center" border=0 cellpading=0 cellspacing=2 bgcolor="navy" bordercolor="navy">
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>HTTP_HOST</b></td><td align="left">'.$HTTP_HOST.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>HTTP_USER_AGENT</b></td><td align="left">'.$HTTP_USER_AGENT.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>REMOTE_ADDR</b></td><td align="left">'.$REMOTE_ADDR.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>REMOTE_PORT</b></td><td align="left">'.$REMOTE_PORT.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>SCRIPT_FILENAME</b></td><td align="left">'.$SCRIPT_FILENAME.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>SERVER_ADDR</b></td><td align="left">'.$SERVER_ADDR.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>SERVER_ADMIN</b></td><td align="left">'.$SERVER_ADMIN.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>SERVER_NAME</b></td><td align="left">'.$SERVER_NAME.'</td></tr>
			<tr valign="baseline" bgcolor="#cccccc"><td bgcolor="#ccccff" ><b>SERVER_PORT</b></td><td align="left">'.$SERVER_PORT.'</td></tr>
	</table>
	</center>';

?>
	
