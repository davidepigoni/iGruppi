
Un nuovo utente si è iscritto al gruppo <b><?php echo $this->gruppo; ?></b>!<br />
Nome: <b><?php echo $this->new_user; ?></b><br />
Email: <a href="mailto:<?php echo $this->email_user; ?>"><?php echo $this->email_user; ?></a><br />
<br />
<i>Come ci hai conosciuti?</i><br />
Risposta: <b><?php echo $this->q1_conosciuti; ?></b><br />
<br />
Puoi abilitarlo dal menù:<br />
<em>Gruppo -> Utenti iscritti</em> (<a href="http://<?php echo $this->url_environment; ?>/gruppo/iscritti"><?php echo $this->url_environment; ?>/gruppo/iscritti</a>)