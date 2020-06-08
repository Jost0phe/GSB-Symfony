<?php

namespace App\Controller;

use App\Entity\LigneFraisHorsForfait;
use App\Form\LigneFraisHorsForfaitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LigneFraisHorsForfaitController extends AbstractController
{
    
    /**
    * @Route("/saisirFFnoforfait", name="saisirhorsforfait")
    **/
    public function saisirhorsForfait(Request $request, Session $session) {

        $fichefrais = new LigneFraisHorsForfait;
        $form = $this->createForm(LigneFraisHorsForfaitType::class, $fichefrais);
        
        $table = $request->request->all();

        if(!empty($table)) {
            //dump($table);exit;
            $libelle = $table['ligne_frais_hors_forfait']['libelle'];
            $date = $table['ligne_frais_hors_forfait']['date']['year'].'-'.$table['ligne_frais_hors_forfait']['date']['month'].'-'.$table['ligne_frais_hors_forfait']['date']['day'];
            $montant = $table['ligne_frais_hors_forfait']['montant'];

            //var_dump($date);

            $rawSql = "INSERT INTO ligne_frais_hors_forfait(visiteur_id,mois_id,libelle,date,montant) VALUES
            (".$session->get('id').", NOW(), '$libelle', '$date', $montant);";

            $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql);
            $stmt->execute();

            $this->addFlash("success", "Fiche frais hors horfait bien enregistrée.");
            //echo $rawSql.'<br>'; exit;
            return $this->render('fichefrais/saisirFFnoforfait.html.twig', array('form'=>$form->createView()));
        }else{
            return $this->render('fichefrais/saisirFFnoforfait.html.twig', array('form'=>$form->createView()));
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
        
        $req = $request->request->all();
        
        $rawSql2 = "SELECT mois_id, libelle, montant from ligne_frais_hors_forfait WHERE visiteur_id = ".$session->get('id')." ";
        if(!empty($req)){
            if(isset($req['date'])){
                $rawSql2 .= "ORDER BY mois_id ";
            }
            elseif(isset($req['libelle'])){
                $rawSql2 .= "ORDER BY libelle ";
            }
            elseif(isset($req['montant'])){
                $rawSql2 .= "ORDER BY montant ";
                }
            }

        $rawSql .= ";";
        
        $stmt2 = $this->getDoctrine()->getManager()->getConnection()->prepare($rawSql2);
        
        $stmt2->execute();

        $table2 = $stmt2->fetchAll();

        //var_dump($table2);var_dump($rawSql2);exit;
        return $this->render('fichefrais/consultFF.html.twig', array('fiche'=>$table, 'horsforfait'=>$table2));
    }
}
