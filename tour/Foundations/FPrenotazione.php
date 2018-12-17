<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FPrenotazione
 *
 * @author Stefano
 */
require_once 'Foundations/Fdb.php';
class FPrenotazione extends Fdb 
{
  public function inserisci(EPrenotazione & $prenotazione)
	{
		$query="INSERT INTO Prenotazione VALUES ( null ,?,?,?,?,?, null )";
                //$dataPrenotazione=$prenotazione->getData();
                //$dataPrenotazioneS=$dataPrenotazione->format("Y-m-d H:i:s");
                $arr= array($prenotazione->getLido()->getIdLido(), $prenotazione->getOmbrellone()->getID(), $prenotazione->getUtente()->getNomeUtente(), $prenotazione->getDataInizio(), $prenotazione->getDataFine());
                
                //$arr= array($this->obj->get_ristorante()->get-id(),$this->obj->get_utente()->get_nome_utente(),$this->obj->get_tavolo()->get_id(),$this->obj->get_effettuata(),$this->obj->get_data_prenotazione(),$this->obj->get_visualizzata(),$this->obj->get_info());
		$stmt=$this->db->prepare($query);
                $stmt->execute($arr);
		
	}
        
  public function verificaDisp(EPrenotazione & $prenotazione)
  {
      $idLido=$prenotazione->getLido()->getIdLido();
      $numOmbrellone=$prenotazione->getOmbrellone()->getID();
      $dataInizio=$prenotazione->getDataInizio();
      $dataFine=$prenotazione->getDataFine();
      $query="SELECT * FROM Prenotazione WHERE idLido = ? AND numOmbrellone = ?";
      $stmt=$this->db->prepare($query);
      $stmt->execute([$idLido,$numOmbrellone]);
      $i=0;
      $res=true;
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
          if($dataInizio>=$row["dataInizio"] && $dataInizio<=$row["dataFine"])
          {
              $i++;
          }
          elseif ($dataFine>=$row["dataInizio"] && $dataFine<=$row["dataFine"]) 
          {
              $i++;
          }
          
      }
      if ($i>0)
      {
          $res=false;
      }
      return $res;
      //print var_dump($row);
      /*$query= "SELECT * FROM Prenotazione WHERE idLido = ? AND numOmbrellone = ? AND dataPrenotazione = ?";
      $stmt=$this->db->prepare($query);
      $stmt->execute([$idLido,$numOmbrellone,$dataPrenotazione]);
      $i=0;
      $res=true;
      while($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
      $i++;
      }
      if($i>0) {$res=false;}
      //print var_dump($res);
      return $res;
      
      */
      
      
  }
    
 
        
        
        
    }
    
    
    //put your code here


