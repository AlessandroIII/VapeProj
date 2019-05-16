<?php 
	session_start();
	include "header.php";
?>
<div class="row">
	<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3" style="text-align: center">
		<label class="page_title">GUIDA</label>
	</div>
</div>
<div class="" role="tabpanel" data-example-id="togglable-tabs">
	<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li role="presentation" class="active"><a href="#tab_aromi" id="aroma-tab" role="tab" data-toggle="tab" aria-expanded="true">Aroma</a>
		</li>
		<li role="presentation" class=""><a href="#tab_liquidi" role="tab" id="liquid-tab" data-toggle="tab" aria-expanded="false">Liquido</a>
		</li>
		<li role="presentation" class=""><a href="#tab_profili" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
		Profilo</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="tab_aromi" aria-labelledby="aroma-tab" style="text-align: center">
			<label style="color:white; font-size: 20px"> INSERIMENTO</label><br>
			<div style="text-align: center">
				<img src="img/guida/inserimento_aroma.png">
			</div>
			<label style="color:white">Premere il bottone evidenziato e inserire i dati richiesti nella pagina di inserimento aroma</label>
			<br>
			<br>
			<label style="color:white; font-size: 20px"> INFORMAZIONI</label><br>
			<div style="text-align: center">
				<img src="img/guida/informazioni_aroma.png">
			</div>
			<label style="color:white">Premere il bottone evidenziato per visualizzare informazioni aggiuntive sull'aroma desiderato</label>
			<br>
			<br>
			<label style="color:white; font-size: 20px"> RICERCA</label><br>
			<div style="text-align: center">
				<img src="img/guida/ricerca_aroma.png">
			</div>
			<label style="color:white">Inserire la chiave di ricerca nella casella evidenziata. Verranno visualizzati gli aromi con una qualsiasi corrispondenza con la chiave inserita, inoltre si potranno scegliere il numero di aromi visualizzabili per pagina e scorrere tra le varie pagine.</label>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab_liquidi" aria-labelledby="liquid-tab" style="text-align: center">
			<label style="color:white; font-size: 20px"> INSERIMENTO </label><br>
			<div style="text-align: center">
				<img src="img/guida/inserimento_liquido.png">
			</div>
			<label style="color:white">
				Premere il bottone evidenziato e inserire i dati richiesti nella pagina di inserimento liquido
			</label>
			<br>
			<div style="text-align: center">
				<img src="img/guida/prefatto_liquido.png">
			</div>
			<label style="color:white">
				Se il liquido è prefatto, inserire nelle note la lista degli ingredienti, altrimenti selezionare gli aromi usati per comporre il liquido e quantità utilizzata.
			</label>
			<br>
			<br>
			<label style="color:white; font-size: 20px"> INFORMAZIONI </label>
			<br>
			<div style="text-align: center">
				<img src="img/guida/informazioni_liquido.png">
			</div>
			<label style="color:white">
				<h3>LEGENDA:</h3>
				<br>
				<img src="img/boccetta_no.png"> Liquido non prefatto
				<br>
				<br>
				<img src="img/boccetta_si.png"> Liquido prefatto<br>
				Premere il bottone evidenziato per visualizzare informazioni aggiuntive sul liquido desiderato. 
			</label>
			<br>
			<br>
			<label style="color:white; font-size: 20px"> RICERCA </label><br>
			<div style="text-align: center">
				<img src="img/guida/ricerca_liquido.png">
			</div>
			<label style="color:white">Inserire la chiave di ricerca nella casella evidenziata. Verranno visualizzati i liquidi con una qualsiasi corrispondenza con la chiave inserita, inoltre si potrà scegliere il numero di liquidi visualizzabili per pagina e scorrere tra le varie pagine.</label>			
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab_profili" aria-labelledby="profile-tab" style="text-align: center">
		</div>
	</div>
</div>