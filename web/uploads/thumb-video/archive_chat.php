<?php
$css_style = "style_jolatefri.css";
$titre = Jolatefri;

// feuille de style
$css_style = "style_profil.css";
// Titre de la page
$titre = "Archives du chat";
// Head
include('head.php');
// Connexion
?>

	<div id="contenuVideo">
	<h2 class="titre">Archives du chat</h2>
		<table class="chatarchive">
				<form action=""> 
						<tr><td><input type="text" size="64" maxlength="100" id="message" 
						onFocus="javascript: effacer('message', 'message');" 
						onBlur="javascript: reecrire('message', 'message');"/></td>
                          <td><input type="submit" value="Envoyer" onclick="envoyerchatarchive(); return false;" /></td></tr>
						  </table>
                </form>
               <a href"" onclick="ecrire_smiley('[-!fuck!-]'); return false;"><img src="img/smiley/emotions_0054.gif"></a>
<script type="text/javascript">
						afficherarchive();
                        setInterval('afficherarchive()', 10300);
                </script>
				<div id="chatarch"></div>
				


	</div>
<? include('foot.php');?>