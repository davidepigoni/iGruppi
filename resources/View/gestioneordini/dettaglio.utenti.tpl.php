<div class="row">
  <div class="col-md-12">
    <h3 class="big-margin-top">Dettaglio Parziali per utente</h3>
<?php if($this->ordCalcObj->getProdottiUtenti() > 0): ?>
    <?php foreach ($this->ordCalcObj->getProdottiUtenti() AS $iduser => $user): ?>
        <h3 class="big-margin-top"><strong><?php echo $user["nome"] . " " . $user["cognome"]; ?></strong></h3>
        <table class="table table-condensed">
            <thead>
              <tr>
                <th>Quantità</th>
                <th>Codice</th>
                <th>Prezzo unitario</th>
                <th>Descrizione</th>
                <th class="text-right">Totale</th>
              </tr>
            </thead>
            <tbody>
        <?php foreach ($user["prodotti"] AS $idprodotto => $pObj): ?>
            <?php if( $pObj->isDisponibile()): ?>
                <tr>
            <?php else: ?>
                <tr class="danger strike">
            <?php endif; ?>
                    <td><strong><?php echo $pObj->getQtaReale_ByIduser($iduser);?></strong></td>
                    <td><strong><?php echo $pObj->getCodice();?></strong></td>
                    <td><?php echo $pObj->getDescrizioneCosto();?></td>
                    <td><?php echo $pObj->getDescrizioneListino();?></td>
                    <td class="text-right"><strong><?php echo $this->valuta($pObj->getTotale_ByIduser($iduser)); ?></strong></td>
                </tr>        
        <?php endforeach; ?>
        <?php if($this->ordCalcObj->getSpeseExtra()->has() && $this->ordCalcObj->getTotaleByIduser($iduser)): ?>
            <?php foreach ($this->ordCalcObj->getSpeseExtra()->get() AS $extra): ?>
                <tr class="warning">
                    <td colspan="3">&nbsp;</td>
                    <td><b><?php echo $extra->getDescrizione(); ?></b></td>
                    <td class="text-right"><strong><?php echo $this->valuta($extra->getParzialeByIduser($this->ordCalcObj, $iduser)); ?></strong></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
            </tbody>
        </table>        
        
        <div class="sub_menu">
            <h3 class="totale">Totale utente: <strong><?php echo $this->valuta($this->ordCalcObj->getTotaleConExtraByIduser($iduser)) ?></strong></h3>
        </div>                    
        <div class="my_clear" style="clear:both;">&nbsp;</div>
    <?php endforeach; ?>
        
<?php else: ?>
    <div class="lead">Nessun prodotto ordinato!</div>
<?php endif; ?>
    
  </div>
</div>
    