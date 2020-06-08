<?php

namespace App\Controller;

use App\Entity\FicheFrais;
use App\Form\FicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class FicheFraisController extends AbstractController
{
    /**
    * @Route("/saisirFF", name="saisirforfait")
    **/
    public function saisirForfait(Request $request, Session $session) {

        $fichefrais = new FicheFrais;
        $form = $this->createForm(FicheFraisType::class, $fichefrais);
        
        $table = $request->request->all();

        if(!empty($table)) {
            //dump($table);exit;
            $etp = $table['fiche_frais']['ETP'];
            $km = $table['fiche_frais']['KM'];
            $nui = $table['fiche_frais']['NUI'];
            $rep = $table['fiche_frais']['REP'];

            $total = $etp + $km + $nui + $rep;

            $rawSql = "SELECT * FROM fiche_frais WHERE mois LIKE '%".date("Y")."-".date("m")."%';";

            $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql);
            $stmt->execute();

            if(empty($stmt->fetchAll())){
                $rawSql = "INSERT INTO fiche_frais (visiteur_id, etat_id, libelle, mois, nb_justificatifs, montant_valide, date_modif, etp, km, nui, rep) VALUES
                (".$session->get('id').", 1, NULL, NOW(), 0, $total, NOW(), $etp, $km, $nui, $rep);";
    
                $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql);
                $stmt->execute();
    
                $this->addFlash("success", "Fiche frais bien enregistrée.");
            }else{
                $rawSql = "UPDATE fiche_frais SET montant_valide = $total, date_modif = NOW(), etp = $etp, km = $km, nui = $nui, rep = $rep
                WHERE visiteur_id = ".$session->get('id')." AND CONCAT(YEAR(mois), MONTH(mois)) LIKE '%".date("Y").date("n")."%';";
    
                // $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql);
                // $stmt->execute();
                    echo $rawSql.'<br>'; exit;
                $this->addFlash("success", "Fiche frais bien enregistrée.");
            }

            
            //echo $rawSql.'<br>'; exit;
            return $this->render('fichefrais/saisirFF.html.twig', array('form'=>$form->createView()));
        }else{
            return $this->render('fichefrais/saisirFF.html.twig', array('form'=>$form->createView()));
        }
        
        
    }


    /**
    * @Route("/consultFF", name="consultforfait")
    **/
    public function consultForfait(Request $request, Session $session) {
        $rawSql = "SELECT * from fiche_frais WHERE visiteur_id = ".$session->get('id').";";

        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql);
        $stmt->execute();

        $table = $stmt->fetchAll();

        $rawSql2 = "SELECT mois_id, libelle, montant from ligne_frais_hors_forfait WHERE visiteur_id = ".$session->get('id').";";

        $stmt2 = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql2);
        $stmt2->execute();

        $table2 = $stmt2->fetchAll();

        //var_dump($table2);var_dump($rawSql2);exit;
        return $this->render('fichefrais/consultFF.html.twig', array('fiche'=>$table, 'horsforfait'=>$table2));
    }


}
