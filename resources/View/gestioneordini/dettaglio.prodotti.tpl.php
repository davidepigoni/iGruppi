<div class="row">
  <div class="col-md-12">
    <h3 class="big-margin-top">Dettaglio Parziali per prodotto</h3>
<?php if( $this->ordCalcObj->isThereSomeProductsOrdered()): ?>
    <?php foreach ($this->ordCalcObj->getProdotti() AS $idprodotto => $pObj): 
        if($pObj->getQtaReale() > 0):
        ?>
        <div<?php if(!$pObj->isDisponibile()) { echo ' class="text-danger strike"';} ?>>
            <div class="sub_menu">
                <h3 class="totale">Totale prodotto: <strong<?php if(!$pObj->isDisponibile()) { echo ' class="text-danger strike"';} ?>><?php echo $this->valuta($pObj->getTotale()); ?></strong></h3>
            </div>
            <h3 class="big-margin-top"><strong><?php echo $pObj->getQtaReale();?></strong> x <?php echo $pObj->getDescrizioneListino();?></h3>
            <p>
                Codice: <strong><?php echo $pObj->getCodice();?></strong><br />
                Prezzo: <?php echo $pObj->getDescrizioneCosto();?><br />
                Ordinato da:
            </p>
            <ul>
            <?php foreach ($pObj->getUsers() AS $iduser): 
                $user = $this->ordCalcObj->getDatiUtenteById($iduser);
                ?>
                <li><?php echo $user->nome . " " . $user->cognome; ?> (<strong><?php echo $pObj->getQta_ByIduser($iduser); ?></strong>)</li>
            <?php endforeach; ?>
            </ul>        
            <div class="my_clear" style="clear:both;">&nbsp;</div>
        </div>
    <?php 
        endif;
        endforeach; ?>
        
<?php else: ?>
    <div class="lead">Nessun prodotto ordinato!</div>
<?php endif; ?>
    
  </div>
</div>
    