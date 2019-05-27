function oggi() {
data = new Date();
giorno = data.getDay();
if (giorno == "0") {
   giorno1 = "Domenica";
}
else if (giorno == "1") {
   giorno1 = "Lunedì";
}
else if (giorno == "2") {
   giorno1 = "Martedì";
}
else if (giorno == "3") {
   giorno1 = "Mercoledì";
}
else if (giorno == "4") {
   giorno1 = "Giovedì";
}
else if (giorno == "5") {
   giorno1 = "Venerdì";
}
else if (giorno == "6") {
   giorno1 = "Sabato";
}
giorno2 = data.getDate();
mese = data.getMonth() + 1;
if (mese == "1") {
   mese1 = "Gennaio";
}
else if (mese == "2") {
   mese1 = "Febbraio";
}
else if (mese == "3") {
   mese1 = "Marzo";
}
else if (mese == "4") {
   mese1 = "Aprile";
}
else if (mese == "5") {
   mese1 = "Maggio";
}
else if (mese == "6") {
   mese1 = "Giugno";
}
else if (mese == "7") {
   mese1 = "Luglio";
}
else if (mese == "8") {
   mese1 = "Agosto";
}
else if (mese == "9") {
   mese1 = "Settembre";
}
else if (mese == "10") {
   mese1 = "Ottobre";
}
else if (mese == "11") {
   mese1 = "Novembre";
}
else if (mese == "12") {
   mese1 = "Dicembre";
}

anno = data.getFullYear();
}




function doLoad()
{
setTimeout( 'refresh()', 300*1000 );
}
function refresh()
{
window.location.reload( true );
}




