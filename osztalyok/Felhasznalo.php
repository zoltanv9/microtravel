<?php
class Felhasznalo extends Ab {

  public function FelhasznaloReg($kedv_varos) {
	//--adatbázis kapcsolat
    $con = $this->connect();
	$stat = 0;
	$siker = 0;
	$datum = date('Y-m-d');
	//--- shorthand, hogy a telefon mező ne maradjon üresen a DB-ben
	$tel = ($tel == '' ? 'Nem adott meg számot': $tel);
	//--- sql lekérdezés az email cím vizsgálatára, hogy ne lehessen duplikáció
	$sql = "SELECT email FROM felhasznalok WHERE email = '$email'";
                $result = $con->query($sql);
                  if ($result->num_rows > 0) {
                     $siker = 1;
                     echo '<script> alert("Az E-mail cím már foglalt."); </script>';
                  }
	//------ letárolás -----
	if($siker != 1){
	$stmt = $con->prepare("INSERT INTO felhasznalok (nev,email,tel,pass,reg_datum,stat) VALUES (?,?,?,?,?,?)");

	$stmt->bind_param("sssssi", $nev,$email,$tel,$pass,$datum,$stat);
                  if (!$stmt->execute()) {
                    echo '<script>alert("Sikertelen regisztráció");</script>';
                  }
                  else {
                    echo '<script>alert("Sikeres regisztráció!");</script>';

					               $ok = 'ok';
					               $_SESSION['user'] = 1;
				  	             $_SESSION['user_nev'] = $nev;

					      $sql = "SELECT f_id FROM felhasznalok WHERE email = '$email' ";
            			  $result = $this->connect()->query($sql);
            		while ($array = $result->fetch_assoc()) {
						            $_SESSION['user_id'] = $array['f_id'];
					      }
                $kedvVarosTomb = explode(',',$kedv_varos);
                $user_id = $_SESSION['user_id'];
                foreach($kedvVarosTomb as $key => $value) {
                  $stmtv = $con->prepare("INSERT INTO felhasznalo_meta (f_id,f_kedv_varos) VALUES (?,?)");
                	$stmtv->bind_param("is", $user_id,$value);
                  $stmtv->execute();
                }
					    echo '<meta http-equiv="refresh" content="0;url=index.php">';
                  }
              $stmt->close();
              $con->close();
	}
	return $ok;
  }

  public function felhasznaloListaAktiv($alany,$rend) {
            $con = $this->connect();

            $sql = "SELECT * FROM felhasznalok WHERE stat = 1 ORDER BY $alany $rend";
            $result = $this->connect()->query($sql);
            $idx = 0;
            while ($array = $result->fetch_assoc()) {
                $felhaszn_adat[$idx]['f_id'] = $array['f_id'];
				$felhaszn_adat[$idx]['nev'] = $array['nev'];
                $felhaszn_adat[$idx]['email'] = $array['email'];
				$felhaszn_adat[$idx]['tel'] = $array['tel'];
				$felhaszn_adat[$idx]['reg_datum'] = $array['reg_datum'];

                $idx++;
            }
            return $felhaszn_adat;
  }
  public function felhasznaloListaInaktiv() {

            $con = $this->connect();

            $sql = "SELECT * FROM felhasznalok WHERE stat = 0 ORDER BY f_id DESC";
            $result = $this->connect()->query($sql);
            $idx = 0;
            while ($array = $result->fetch_assoc()) {
                $felhaszn_adat[$idx]['f_id'] = $array['f_id'];
				$felhaszn_adat[$idx]['nev'] = $array['nev'];
                $felhaszn_adat[$idx]['email'] = $array['email'];
				$felhaszn_adat[$idx]['tel'] = $array['tel'];
				$felhaszn_adat[$idx]['reg_datum'] = $array['reg_datum'];

                $idx++;
            }
            return $felhaszn_adat;
  }
  public function felhasznaloListaFo() {

            $con = $this->connect();

            $sql = "SELECT * FROM felhasznalok ORDER BY f_id DESC LIMIT 10";
            $result = $this->connect()->query($sql);
            $idx = 0;
            while ($array = $result->fetch_assoc()) {
                $felhasznfo_adat[$idx]['f_id'] = $array['f_id'];
				        $felhasznfo_adat[$idx]['nev'] = $array['nev'];
                $felhasznfo_adat[$idx]['email'] = $array['email'];
				        $felhasznfo_adat[$idx]['tel'] = $array['tel'];
				        $felhasznfo_adat[$idx]['reg_datum'] = $array['reg_datum'];
				        $felhasznfo_adat[$idx]['stat'] = $array['stat'];

                $idx++;
            }
            return $felhasznfo_adat;
  }
  public function felhasznaloLekerdez($f_id) {

            $con = $this->connect();

            $sql = "SELECT * FROM felhasznalok WHERE f_id = '$f_id'";
            $result = $this->connect()->query($sql);

            while ($array = $result->fetch_assoc()) {
                $egyfelhaszn_adat['f_id'] = $array['f_id'];
				        $egyfelhaszn_adat['nev'] = $array['nev'];
                $egyfelhaszn_adat['email'] = $array['email'];
				        $egyfelhaszn_adat['tel'] = $array['tel'];

                $sqlm = "SELECT f_kedv_varos FROM felhasznalo_meta WHERE f_id = '$egyfelhaszn_adat[f_id]'";
                $resultm = $this->connect()->query($sqlm);
                $i = 0;
                while ($arraym = $resultm->fetch_assoc()) {
                  if($i > 0){$comma = ',';}
                  $egyfelhaszn_adat['f_kedv_varos'] .= $comma.$arraym['f_kedv_varos'];
                $i++;
                }
            }
            return $egyfelhaszn_adat;
  }
  public function FelhasznStatMod($akt,$fid,$menu){

		  $con = $this->connect();

		  $stmt = $con->prepare("UPDATE felhasznalok SET stat=? WHERE f_id=?");
					$stmt->bind_param("ii", $akt, $fid);
					if (!$stmt->execute()) {
					  echo'<script>alert("Sikertelen státusz módosítás")</script>';
						}
					else {
						if($menu == 'fooldal'){
							echo '<meta http-equiv="refresh" content="0;url=index.php">';
						}
						if($menu == 'aktiv'){
							echo '<meta http-equiv="refresh" content="0;url=index.php?menu=inaktiv-felhasznalok">';
						}
						if($menu == 'inaktiv'){
							echo '<meta http-equiv="refresh" content="0;url=index.php?menu=aktiv-felhasznalok">';
						}
					}

  }
  public function FelhasznMod($f_id, $oldal) {
			//felhasználjuk a kész db kapcsolatot
            $con = $this->connect();
            $pass_sha = sha1($pass);
			      $tel = ($tel == '' ? 'Nem adott meg számot': $tel);
            $siker = 0;
                $sql = "SELECT f_id, email FROM felhasznalok WHERE email = '$email'";
                      $result = $con->query($sql);
                          $i = 0;
                          while ($array = $result->fetch_assoc()) {
                              $f_id_check = $array['f_id'];
                              $email_check = $array['email'];
                              $i++;
                          }
                          if($i>0 && $f_id_check != $f_id){
                              $siker = 1;
                              echo '<script> alert("Az E-mail cím már foglalt."); </script>';
                          }

            if($siker != 1 && $_POST['kedv_varos'] != ''){
              $sql = "DELETE FROM felhasznalo_meta WHERE f_id = '$f_id'";
                        if ($con->query($sql) === TRUE) {
                            $kedvVarosTomb = explode(',',$_POST['kedv_varos']);
                            foreach($kedvVarosTomb as $key => $value) {
                                $stmtv = $con->prepare("INSERT INTO felhasznalo_meta (f_id,f_kedv_varos) VALUES (?,?)");
                                $stmtv->bind_param("is", $f_id,$value);
                                $stmtv->execute();
                            }
                        }
            }

            if($siker != 1 && $pass != ''){
                $stmt = $con->prepare("UPDATE felhasznalok SET nev=?, email=?, tel=?, pass=? WHERE f_id=?");
                $stmt->bind_param("ssssi", $nev, $email, $tel, $pass_sha, $f_id);
                if (!$stmt->execute()) {
				          echo '<script>alert(\'Sikertelen rögzítés\')</script>';
					      }
                else {
                  echo '<meta http-equiv="refresh" content="0;url=index.php?mod='.$f_id.'&menu='.$oldal.'">';
                }
            }
            if($siker != 1 && $pass == ''){
                $stmt = $con->prepare("UPDATE felhasznalok SET nev=?, email=?, tel=? WHERE f_id=?");
                $stmt->bind_param("sssi", $nev, $email, $tel, $f_id);
                if (!$stmt->execute()) {}
                else {
                  echo '<meta http-equiv="refresh" content="0;url=index.php?mod='.$f_id.'&menu='.$oldal.'">';
                }
            }
        }

	public function felhasznBelep() {

              $con = $this->connect();

              $email = $con->real_escape_string($_POST['email']);
              $pass = $con->real_escape_string($_POST['pass1']);
              $pass = sha1($pass);

              $sql = "SELECT * FROM felhasznalok WHERE email = '$email' AND pass = '$pass' ";
              $result = $this->connect()->query($sql);
              $idx = 0;
              while ($array = $result->fetch_assoc()) {
                  $felhaszn[$idx]['f_id'] = $array['f_id'];
                  $felhaszn[$idx]['nev'] = $array['nev'];
                  $felhaszn[$idx]['email'] = $array['email'];
				  $felhaszn[$idx]['stat'] = $array['stat'];
              $idx++;
              }
              if($idx > 0){
                  $_SESSION['user'] = 1;
				  $_SESSION['user_id'] = $felhaszn[0]['f_id'];
				  $_SESSION['user_nev'] = $felhaszn[0]['nev'];
				  $_SESSION['user_email'] = $felhaszn[0]['email'];
				  $_SESSION['user_stat'] = $felhaszn[0]['stat'];
				  echo '<meta http-equiv="refresh" content="0;url=index.php">';
              }
              if($idx == 0){
                echo '<script>alert(\'Hibás vagy nem létező felhasználó, jelszó.\')</script>';
                echo '<meta http-equiv="refresh" content="0;url=index.php">';
              }
              return $felhaszn;
        }
}
?>
