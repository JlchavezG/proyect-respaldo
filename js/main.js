// funcion para ver el password
function verpass(cb) {
  if(cb.checked)
  $('#pwd').attr("type","text");
  else
  $('#pwd').attr("type","password");
}
