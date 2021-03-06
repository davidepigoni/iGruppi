<div id="ordine_header">
    <?php include $this->template('gestioneordini/gestione-header.tpl.php'); ?>
</div>

    <div class="row">
        <div class="col-md-8">
            <h3>Prodotti inseriti in quest'ordine:</h3>
        </div>
        <div class="col-md-4 col-right">
<!--            <a class="btn btn-default btn-mylg" href="/gestione-ordini/addprodotto/idordine/<?php echo $this->ordine->getIdOrdine();?>"><span class="glyphicon glyphicon-plus"></span> Aggiungi prodotto</a> -->
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12">
    <?php 
    $arProductsGrid = array();
    $categorie = $this->ordine->getProdottiWithCategoryArray();
    if(count($categorie) > 0): 
        foreach ($categorie AS $cat): 
            foreach ($cat->getSubcat() AS $subcat):
                foreach ($subcat->getProdotti() AS $prodotto):
                    $pObj = $prodotto->getProdotto(); 
                    $arProductsGrid[] = array(
                        'idprodotto'        => $pObj->getIdProdotto(),
                        'idlistino'         => $pObj->getIdListino(),
                        'codice'            => $pObj->getCodice(),
                        'subcat'            => $subcat->getDescrizione(),
                        'costo_ordine'      => $pObj->getCostoOrdine(),
                        'udm'               => $pObj->getUdm() .($pObj->hasPezzatura() ? "<br /><small>(Minimo " . $pObj->getDescrizionePezzatura() . ")</small>" : ""),
                        'offerta_ordine'    => $pObj->getOffertaOrdine(),
                        'sconto_ordine'     => $pObj->getScontoOrdine(),
                        'descrizione'       => $pObj->getDescrizioneListino(),
                        'disponibile_ordine'=> $pObj->isDisponibile()
                    );
                endforeach;
            endforeach;
        endforeach; 
        //Zend_Debug::dump($arProductsGrid);
        ?>
            <div id="grid-prodotti" class="handsontable myhandsontable"></div>
<?php else: ?>
            <h3>Nessun prodotto inserito</h3>        
<?php endif; ?>
        </div>
    </div>

<script>    
$(document).ready(function () {
  // store my idordine
  var idordine = <?php echo $this->ordine->getIdOrdine(); ?>;
  // init Container for Handsontable
  $('#grid-prodotti').handsontable({
      data: <?php echo json_encode($arProductsGrid); ?>,
      manualColumnMove: true,
      manualColumnResize: true,
      colHeaders: ['Disp.', 'Codice', 'Descrizione', 'Prezzo', 'Udm', 'Offerta', 'Sconto', 'Categoria'],
      colWidths: [50, 80, 380, 70, 120, 70, 70, 280],
      columnSorting: true,
      currentRowClassName: 'currentRow',
      columns: [
        {
          data: 'disponibile_ordine',
          type: 'checkbox'
        },
        {
          data: 'codice',
          readOnly: true
        },
        {
          data: 'descrizione',
          readOnly: true
        },
        {
          data: 'costo_ordine',
          type: 'numeric',
          format: '0,0.00 $',
          language: 'it'
        },
        {
          data: 'udm',
          renderer: "html",
          readOnly: true
        },
        {
          data: 'offerta_ordine',
          type: 'checkbox'
        },
        {
          data: 'sconto_ordine',
          type: 'numeric',
          format: '0,0.00 %',
          language: 'it'
        },
        {
          data: 'subcat',
          readOnly: true
        }
      ],
      afterChange: function (changes, source) {
          if (source === 'edit') {
            for(var i = changes.length - 1; i >= 0; i--)
            {
                // NOT SORTED (as Default value), logicalIndex = physicalIndex
                var physicalIndex = changes[i][0];
                if(isSorted(this)) {
                    // SORTED, convert logicalIndex to physicalIndex to get the right SourceData
                    physicalIndex = this.sortIndex[changes[i][0]][0];
                }
                // get SourceData by physicalIndex
                var rowSourceData = this.getSourceDataAtRow(physicalIndex);
                // get value changed fields
                var field = changes[i][1];
                var old_value = changes[i][2];
                var new_value = changes[i][3];
                // check if it is really changed
                if(old_value !== new_value)
                {   
                    $.getJSON(
                        '/gestione-ordini/updateprodotto/',
                        {idordine: idordine, idprodotto: rowSourceData.idprodotto, idlistino: rowSourceData.idlistino, field: field, value: new_value},
                        function(data) {
                            if(!data.res)
                            {
                                console.log('ERROR!');
                            }
                        });
                }
            }
          }
      }
              
    });
    
});
</script>
