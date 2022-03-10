<?php
class Utazas extends Ab {

  public function UtazasReg($kepnev) {
    $con = $this->connect();

    $utazas_nev = $con->real_escape_string($_POST['utazas_nev']);
    $utazas_tipus = $con->real_escape_string($_POST['utazas_tipus']);
    $utazas_jelleg = $con->real_escape_string($_POST['utazas_jelleg']);
    $utazas_leiras = $con->real_escape_string($_POST['utazas_leiras']);
    $utazas_ind_datum = $con->real_escape_string($_POST['date1']);
    $utazas_ar = $con->real_escape_string($_POST['utazas_ar']);
    $utazas_reg_date = date('Y-m-d');
    $utazas_stat = 1;

    $sql = "SELECT ut_id FROM utazasok ORDER BY ut_id DESC LIMIT 1";
                  $result = $this->connect()->query($sql);
                  while ($array = $result->fetch_assoc()) {
                     $ut_id = $array['ut_id'];
                  }
                  if(!$ut_id){
                     $ut_id = 1;
                  }
                  else{
                     $ut_id = $ut_id+1;
                  }
                  $datum = date('Y');
                  $utazas_id = 'T-'.$datum.'-'.$ut_id;
                  if($kepnev == ''){$kepnev = 'Nincs foto';}
                  $stmt = $con->prepare("INSERT INTO utazasok (utazas_id,utazas_nev,utazas_tipus,utazas_jelleg,utazas_leiras,utazas_ar,utazas_kep,utazas_ind_datum,utazas_reg_datum,utazas_stat)
                  VALUES (?,?,?,?,?,?,?,?,?,?)");
                  $stmt->bind_param("sssssssssi", $utazas_id,$utazas_nev,$utazas_tipus,$utazas_jelleg,$utazas_leiras,$utazas_ar,$kepnev,$utazas_ind_datum,$utazas_reg_date,$utazas_stat);
                  if (!$stmt->execute()) {
                    echo '<script>alert("Sikertelen utazás rögzítés.");</script>';
                  }
                  else {
                    echo '<script>alert("Sikeres utazás rögzítés.");</script>';
                    echo '<meta http-equiv="refresh" content="0;url=index.php?menu=utazas-szerkesztes">';
                    $ok = $utazas_id;
                  }

              $stmt->close();
              $con->close();

             return $ok;
  }
  public function UtazasLista() {
    $con = $this->connect();
    $sql = "SELECT * FROM utazasok ORDER BY ut_id DESC";
            $result = $this->connect()->query($sql);
            $idx = 0;
            while ($array = $result->fetch_assoc()) {
                $utazasLista[$idx]['ut_id'] = $array['ut_id'];
                $utazasLista[$idx]['utazas_id'] = $array['utazas_id'];
                $utazasLista[$idx]['utazas_nev'] = $array['utazas_nev'];
                $utazasLista[$idx]['utazas_tipus'] = $array['utazas_tipus'];
                $utazasLista[$idx]['utazas_jelleg'] = $array['utazas_jelleg'];
                $utazasLista[$idx]['utazas_leiras'] = $array['utazas_leiras'];
                $utazasLista[$idx]['utazas_ar'] = $array['utazas_ar'];
                $utazasLista[$idx]['utazas_ind_datum'] = $array['utazas_ind_datum'];
                $utazasLista[$idx]['utazas_kep'] = $array['utazas_kep'];
                $utazasLista[$idx]['utazas_stat'] = $array['utazas_stat'];
                $idx++;
            }
    return $utazasLista;
  }
  public function UtazasKonkret($utazas_id) {
    $con = $this->connect();
    $sql = "SELECT * FROM utazasok WHERE utazas_id = '$utazas_id'";
            $result = $this->connect()->query($sql);
            $idx = 0;
            while ($array = $result->fetch_assoc()) {
                $utazasKonkret[$idx]['ut_id'] = $array['ut_id'];
                $utazasKonkret[$idx]['utazas_id'] = $array['utazas_id'];
                $utazasKonkret[$idx]['utazas_nev'] = $array['utazas_nev'];
                $utazasKonkret[$idx]['utazas_tipus'] = $array['utazas_tipus'];
                $utazasKonkret[$idx]['utazas_jelleg'] = $array['utazas_jelleg'];
                $utazasKonkret[$idx]['utazas_leiras'] = $array['utazas_leiras'];
                $utazasKonkret[$idx]['utazas_ar'] = $array['utazas_ar'];
                $utazasKonkret[$idx]['utazas_ind_datum'] = $array['utazas_ind_datum'];
                $utazasKonkret[$idx]['utazas_kep'] = $array['utazas_kep'];
                $utazasKonkret[$idx]['utazas_stat'] = $array['utazas_stat'];
                $idx++;
            }
    return $utazasKonkret;
  }
  public function UtazasListaEgyed($ut_id) {
    $con = $this->connect();
    $sql = "SELECT * FROM utazasok WHERE ut_id = '$ut_id'";
            $result = $this->connect()->query($sql);

            while ($array = $result->fetch_assoc()) {
                $utazasListaEgyed['ut_id'] = $array['ut_id'];
                $utazasListaEgyed['utazas_id'] = $array['utazas_id'];
                $utazasListaEgyed['utazas_nev'] = $array['utazas_nev'];
                $utazasListaEgyed['utazas_tipus'] = $array['utazas_tipus'];
                $utazasListaEgyed['utazas_jelleg'] = $array['utazas_jelleg'];
                $utazasListaEgyed['utazas_leiras'] = $array['utazas_leiras'];
                $utazasListaEgyed['utazas_kep'] = $array['utazas_kep'];
                $utazasListaEgyed['utazas_ar'] = $array['utazas_ar'];
                $utazasListaEgyed['utazas_ind_datum'] = $array['utazas_ind_datum'];
                $utazasListaEgyed['utazas_stat'] = $array['utazas_stat'];
            }
    return $utazasListaEgyed;
  }
  public function UtazasStatMod($akt,$ut_id,$menu){

      		  $con = $this->connect();

      		  $stmt = $con->prepare("UPDATE utazasok SET utazas_stat=? WHERE ut_id=?");
      					$stmt->bind_param("ii", $akt,$ut_id);
      					if (!$stmt->execute()) {
      					  echo'<script>alert("Sikertelen státusz módosítás")</script>';
      					}
      					else {
      					  echo '<meta http-equiv="refresh" content="0;url=index.php?menu=utazas-szerkesztes">';
      					}
  }
  public function utazasMod($ut_id,$kepnev,$logokep) {

            $con = $this->connect();

            $utazas_nev = $con->real_escape_string($_POST['utazas_nev']);
            $utazas_tipus = $con->real_escape_string($_POST['utazas_tipus']);
            $utazas_jelleg = $con->real_escape_string($_POST['utazas_jelleg']);
            $utazas_leiras = $con->real_escape_string($_POST['utazas_leiras']);
            $utazas_ar = $con->real_escape_string($_POST['utazas_ar']);
            $utazas_ind_datum = $con->real_escape_string($_POST['date1']);

            if($kepnev == ''){$kep_nev = $logokep;}
            if($kepnev != ''){
                $kep_nev = $kepnev;
                if($logokep != 'travellogo.jpg'){
                unlink('../uploads/'.$logokep);
                }
            }

                $stmt = $con->prepare("UPDATE utazasok SET utazas_nev=?, utazas_tipus=?, utazas_jelleg=?, utazas_leiras=?, utazas_ar=?, utazas_ind_datum=?, utazas_kep=? WHERE ut_id=?");
                $stmt->bind_param("sssssssi", $utazas_nev, $utazas_tipus, $utazas_jelleg, $utazas_leiras, $utazas_ar, $utazas_ind_datum, $kep_nev, $ut_id);
                if (!$stmt->execute()) {}
                else {
                  echo '<meta http-equiv="refresh" content="0;url=index.php?utmod='.$ut_id.'&menu=utazas-szerkesztes">';
                }

        }
}
?>
