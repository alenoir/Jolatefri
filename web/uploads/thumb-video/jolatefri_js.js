function effacer(value_defaut, id)
{
      if (document.getElementById(id).value==value_defaut)
         document.getElementById(id).value='';
}
function reecrire(value_defaut,id)
{
      if (document.getElementById(id).value=='')
         document.getElementById(id).value=value_defaut;
}
function reecrirechat(value_defaut,id)
{
         document.getElementById(id).value=value_defaut;
}
function verifPseudo(champ) {
	if(champ.value.length < 3 || champ.value.length > 15)
	{
  document.images["imgpseudo"].src='img/icon_faux.png';
	}
	else
	{
		  document.images["imgpseudo"].src='img/icon_ok.png';

	}
}
function verifPass() {
	if(document.getElementById('confirm').value != document.getElementById('password').value || document.getElementById('confirm').value.length < 6 
			|| document.getElementById('confirm').value.length > 10)
	{
			document.images["imgpass1"].src='img/icon_faux.png';
			document.images["imgpass2"].src='img/icon_faux.png';
	}
	else
	{
		  document.images["imgpass1"].src='img/icon_ok.png';
		  document.images["imgpass2"].src='img/icon_ok.png';

	}
}
function verifMail(adrr){
	  var reg= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
	  if(reg.test(adrr.value)==true) 
	  {
		  document.images["imgmail"].src='img/icon_ok.png';
	  }
		  
	  else
	  {
		  document.images["imgmail"].src='img/icon_faux.png';
	  }
	}
function multiClass(eltId) {
	arrLinkId = new Array('_0','_1','_2','_3','_4');
	intNbLinkElt = new Number(arrLinkId.length);
	arrClassLink = new Array('current','ghost');
	strContent = new String()
	for (i=0; i<intNbLinkElt; i++) {
		strContent = "menu"+arrLinkId[i];
		if ( arrLinkId[i] == eltId ) {
			document.getElementById(arrLinkId[i]).className = arrClassLink[0];
			document.getElementById(strContent).className = 'on content';
		} else {
			document.getElementById(arrLinkId[i]).className = arrClassLink[1];
			document.getElementById(strContent).className = 'off content';
		}
	}	
}

function getXhr(){
                                var xhr = null; 
				if(window.XMLHttpRequest) // Firefox et autres
				   xhr = new XMLHttpRequest(); 
				else if(window.ActiveXObject){ // Internet Explorer 
				   try {
			                xhr = new ActiveXObject("Msxml2.XMLHTTP");
			            } catch (e) {
			                xhr = new ActiveXObject("Microsoft.XMLHTTP");
			            }
				}
				else { // XMLHttpRequest non supporté par le navigateur 
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
				   xhr = false; 
				} 
                                return xhr
			}
function go(c){
				if(!c.data.replace(/\s/g,''))
					c.parentNode.removeChild(c);
			}

function clean(d){
				var bal=d.getElementsByTagName('*');

				for(i=0;i<bal.length;i++){
					a=bal[i].previousSibling;
					if(a && a.nodeType==3)
						go(a);
					b=bal[i].nextSibling;
					if(b && b.nodeType==3)
						go(b);
				}
				return d;
			} 
function afficher(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						var reponse = xhr.responseXML.documentElement;
						var chat = '';
						chat = "<table class=\"chat\">";
						var pla = 0;
						var col = 0;
						var nb_en_ligne = reponse.getElementsByTagName("nb_en_ligne")[0].firstChild.nodeValue;
						while( pla <= 5)
						{
						var pseudo = reponse.getElementsByTagName("pseudo")[pla].firstChild.nodeValue;
						var date = reponse.getElementsByTagName("date")[pla].firstChild.nodeValue;
						var avatar = reponse.getElementsByTagName("avatar")[pla].firstChild.nodeValue;
						var message = reponse.getElementsByTagName("message")[pla].firstChild.nodeValue;
						if(col%2 == 0)
						{
						chat = chat+"<tr  class=\"chat_vert\"><td class=\"titre_chat\" width=110px><img src=\"img/avatar/"+avatar+" \"width=20px><b><a href=\"fiche_membre.php?pseudo="+pseudo+"\">"+pseudo+"</a></b></td><td class=\"titre_chat\">"+date+"</td></tr><tr class=\"chat_vert\"><td colspan=\"2\" class=\"message_ie\"><p class=\"messagge_chat\">"+message+"</p></td></tr>";
						pla = pla + 1;
						col = col + 1;
						}
						else
						{
						chat = chat+"<tr  class=\"chat_bleu\"><td class=\"titre_chat\" width=110px><img src=\"img/avatar/"+avatar+" \"width=20px><b><a href=\"fiche_membre.php?pseudo="+pseudo+"\">"+pseudo+"</a></b></td><td class=\"titre_chat\">"+date+"</td></tr><tr class=\"chat_bleu\"><td colspan=\"2\" class=\"message_ie\"><p class=\"messagge_chat\">"+message+"</p></td></tr>";
						pla = pla + 1;
						col = col + 1;
						}
						}
						chat = chat+"</table>";
						chat = chat+"<div class=\"membre_en_ligne\"><p>En ligne : </p><p>";
						var nb_ligne = 0;
						while(nb_ligne < nb_en_ligne)
					       {
					    var en_ligne = reponse.getElementsByTagName("en_ligne")[nb_ligne].firstChild.nodeValue;
						nb_ligne = nb_ligne + 1;
							if(nb_ligne == 1)
							{
								chat = chat+"<a href=\"http://www.jolatefri.com/fiche_membre.php?pseudo="+en_ligne+"\">"+en_ligne+"</a>";
							}
							else
							{
								chat = chat+" . <a href=\"http://www.jolatefri.com/fiche_membre.php?pseudo="+en_ligne+"\">"+en_ligne+"</a>";
							}
						}
					
						chat = chat+"</p></div>";
						document.getElementById("chat").innerHTML = chat; 
					}
				}
				xhr.open("GET","affich_chat.php",true);
				xhr.send(null);
				
			}
function envoyerchat(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
							reecrirechat('', 'message');
							afficher();
							
						}
						
					}
				
				 xhr.open("POST",'envoyer_chat.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); // On recupere la valeur de l'input ayant pour id: nserie 
				 var message = document.getElementById('message').value; // On envoie a verifnserie le nserie recupéré 
				 xhr.send("message="+message); 
			}
function envoyerchatarchive(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
							afficherarchive();
							reecrirechat('', 'message');
						}
						
					}
				
				 xhr.open("POST",'envoyer_chat.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); // On recupere la valeur de l'input ayant pour id: nserie 
				 message = document.getElementById('message').value; // On envoie a verifnserie le nserie recupéré 
				 xhr.send("message="+message); 
			}
function afficherarchive(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						var reponse = clean(xhr.responseXML.documentElement);
						var chat = "<table class=\"chatarchive\">";
						pla = 0;
						col = 0;
						nb_message = reponse.getElementsByTagName("nb_message")[0].firstChild.nodeValue;
						while(pla <70)
						{
						pseudo = reponse.getElementsByTagName("pseudo")[pla].firstChild.nodeValue;
						date = reponse.getElementsByTagName("date")[pla].firstChild.nodeValue;
						avatar = reponse.getElementsByTagName("avatar")[pla].firstChild.nodeValue;
						message = reponse.getElementsByTagName("message")[pla].firstChild.nodeValue;
						if(col%2 == 0)
						{
						chat = chat+"<tr  class=\"chat_vert\"><td class=\"titre_chat\" width=110px><img src=\"img/avatar/"+avatar+" \"width=20px><b><a href=\"fiche_membre.php?pseudo="+pseudo+"\">"+pseudo+"</a></b></td><td class=\"titre_chat\">"+date+"</td></tr><tr class=\"chat_vert\"><td colspan=\"2\" class=\"message_ie\"><p class=\"messagge_chat\">"+message+"</p></td></tr>";
						pla = pla + 1;
						col = col + 1;
						}
						else
						{
						chat = chat+"<tr  class=\"chat_bleu\"><td class=\"titre_chat\" width=110px><img src=\"img/avatar/"+avatar+" \"width=20px><b><a href=\"fiche_membre.php?pseudo="+pseudo+"\">"+pseudo+"</a></b></td><td class=\"titre_chat\">"+date+"</td></tr><tr class=\"chat_vert\"><td colspan=\"2\" class=\"message_ie\"><p class=\"messagge_chat\">"+message+"</p></td></tr>";
						pla = pla + 1;
						col = col + 1;
						}
						}
						document.getElementById("chatarch").innerHTML = chat; 
					}
				}
				xhr.open("GET","affich_chat.php",true);
				xhr.send(null);
			}
function affichercommentaire(nom_video){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						var reponse = clean(xhr.responseXML.documentElement);
						var commentaire = "";
						pla = 0;
						col = 0;
						nbcom = reponse.getElementsByTagName("nbcom")[0].firstChild.nodeValue;
						while( pla < nbcom)
						{
						pseudo = reponse.getElementsByTagName("pseudo")[pla].firstChild.nodeValue;
						statut = reponse.getElementsByTagName("statut")[pla].firstChild.nodeValue;
						jour = reponse.getElementsByTagName("jour")[pla].firstChild.nodeValue;
						heure = reponse.getElementsByTagName("heure")[pla].firstChild.nodeValue;
						min = reponse.getElementsByTagName("min")[pla].firstChild.nodeValue;
						avatar = reponse.getElementsByTagName("avatar")[pla].firstChild.nodeValue;
						message = reponse.getElementsByTagName("message")[pla].firstChild.nodeValue;
						
						if(col%2 == 0)
						{
						commentaire = commentaire+"<table class=\"table_commentaire_vert\"><tr><td class=\"utilisateur_com\" ROWSPAN=2 width=150px><img src=\"img/avatar/"+avatar+"\" width=50px><ol><li><a href=\"fiche_membre.php?pseudo="+pseudo+"\">"+pseudo+"</a></li><li>"+statut+"</li></ol></td><td class=\"date_com\">"+jour+" a "+heure+":"+min+"</td></tr><tr><td><p class=\"message_com\">"+message+"</p></td></tr></table>";
						pla = pla + 1;
						col = col + 1;
						}
						else
						{
						commentaire = commentaire+"<table class=\"table_commentaire_bleu\"><tr><td class=\"utilisateur_com\" ROWSPAN=2 width=150px><img src=\"img/avatar/"+avatar+"\" width=50px><ol><li><a href=\"fiche_membre.php?pseudo="+pseudo+"\">"+pseudo+"</a></li><li>"+statut+"</li></ol></td><td class=\"date_com\">"+jour+" a "+heure+":"+min+"</td></tr><tr><td><p class=\"message_com\">"+message+"</p></td></tr></table>";
						pla = pla + 1;
						col = col + 1;
						}
						}
						document.getElementById("affichage_commenaire").innerHTML = commentaire; 
					}
				}
				xhr.open("POST",'afficher_commentaire.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				 xhr.send("nom_video="+nom_video);
			}
function envoyercommentaire(nom_video){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
							affichercommentaire(nom_video);
							reecrirechat('', 'commentaire');
						}
						
					}
				
				 xhr.open("POST",'traitement_commentaire.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				 pseudo = document.getElementById('pseudo').value;
				 message = document.getElementById('commentaire').value;
				 titre_video = document.getElementById('titre_video').value;
				 xhr.send("message="+message+"&nom_video="+nom_video+"&titre_video="+titre_video+"&pseudo="+pseudo); 
			}
function afficherfritejquery(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						var reponse = clean(xhr.responseXML.documentElement);
						pla = 0;
						col = 0;
						cpt = 0;
						var reception_frite = "";
						reception_frite = reception_frite+"<table><tr>";
						nbfrite = reponse.getElementsByTagName("nbfrite")[0].firstChild.nodeValue;
						var nbfritemembre = reponse.getElementsByTagName("nbfritemembre")[0].firstChild.nodeValue;
						while( pla < nbfrite)
						{
						var expediteur = reponse.getElementsByTagName("expediteur")[pla].firstChild.nodeValue;
						frite = reponse.getElementsByTagName("frite")[pla].firstChild.nodeValue;
						statut = reponse.getElementsByTagName("statut")[pla].firstChild.nodeValue;
						heure = reponse.getElementsByTagName("heure")[pla].firstChild.nodeValue;
						avatar = reponse.getElementsByTagName("avatar")[pla].firstChild.nodeValue;
						date = reponse.getElementsByTagName("date")[pla].firstChild.nodeValue;
						var id = reponse.getElementsByTagName("id")[pla].firstChild.nodeValue;
						renvoye = reponse.getElementsByTagName("renvoye")[pla].firstChild.nodeValue;
						reception_frite = reception_frite+"<td><table class=\"table_frite\" width=200px><tr height=150px><td class=\"utilisateur_com\"><img src=\"img/avatar/"+avatar+"\" width=50px ><ol><li>"+expediteur+"</li><li>"+statut+"</li><li>"+date+" a "+heure+"</li></ol></td><td><img src=\"img/frites/"+frite+"\" width=50px ></td></tr>";
				if(renvoye == 0)
				{
				reception_frite = reception_frite+"<tr colspan=\"3\"><td><p class=\"modif_profil\"><a href=\"\" onClick=\"choix_frite('"+id+"', '"+expediteur+"', '"+nbfritemembre+"');return false;\">Renvoyer</a></p></td><td><a href=\"\" class=\"modif_profil\" onclick=\"effacerfrite("+id+"); return false;\">X</a></td></tr>";
				}
				else
				{
					reception_frite = reception_frite+"<tr><td><p>Renvoyée</p></td><td><a href=\"\" class=\"modif_profil\" onclick=\"effacerfrite("+id+"); return false;\">X</a></td></tr>";
				}
				reception_frite = reception_frite+"</table></td>";
				
				
				cpt = cpt+1;
				if(cpt == 3)
				{
				reception_frite = reception_frite+"</tr><tr>";
				cpt = 0;
				}
				pla++;
				}
				reception_frite = reception_frite+"</tr></table><a href=\"\" class=\"modif_profil\" onclick=\"touteffacerfrite("+id+"); return false;\">Tout effacer</a>"
				reception_frite = reception_frite+"</table></td>";
						document.getElementById("reception_frite").innerHTML = reception_frite; 
						
					}
				}
				xhr.open("GET","afficher_frite.php",true);
				xhr.send(null);
			}
function afficherfrite(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						var reponse = clean(xhr.responseXML.documentElement);
						pla = 0;
						col = 0;
						cpt = 0;
						var reception_frite = "";
						nbfrite = reponse.getElementsByTagName("nbfrite")[0].firstChild.nodeValue;
						var nbfritemembre = reponse.getElementsByTagName("nbfritemembre")[0].firstChild.nodeValue;
						while( pla < nbfrite)
						{
						var expediteur = reponse.getElementsByTagName("expediteur")[pla].firstChild.nodeValue;
						frite = reponse.getElementsByTagName("frite")[pla].firstChild.nodeValue;
						statut = reponse.getElementsByTagName("statut")[pla].firstChild.nodeValue;
						heure = reponse.getElementsByTagName("heure")[pla].firstChild.nodeValue;
						avatar = reponse.getElementsByTagName("avatar")[pla].firstChild.nodeValue;
						date = reponse.getElementsByTagName("date")[pla].firstChild.nodeValue;
						var id = reponse.getElementsByTagName("id")[pla].firstChild.nodeValue;
						renvoye = reponse.getElementsByTagName("renvoye")[pla].firstChild.nodeValue;
						reception_frite = reception_frite+"<table class=\"table_frite\" id=\"frite_no"+pla+"\" width=200px><tr height=150px><td class=\"utilisateur_com\"><img src=\"img/avatar/"+avatar+"\" width=50px ><ol><li>"+expediteur+"</li><li>"+statut+"</li><li>"+date+" a "+heure+"</li></ol></td><td><img src=\"img/frites/"+frite+"\" width=50px ></td></tr>";
				if(renvoye == 0)
				{
				reception_frite = reception_frite+"<tr colspan=\"3\"><td><p class=\"modif_profil\"><a href=\"\" onClick=\"choix_frite('"+id+"', '"+expediteur+"', '"+nbfritemembre+"');return false;\">Renvoyer</a></p></td><td><a href=\"\" class=\"modif_profil\" onclick=\"effacerfrite("+id+"); return false;\">X</a></td></tr>";
				}
				else
				{
					reception_frite = reception_frite+"<tr><td><p>Renvoyée</p></td><td><a href=\"\" class=\"modif_profil\" onclick=\"effacerfrite('"+id+"', 'frite_no"+pla+"'); return false;\">X</a></td></tr>";
				}
				
				reception_frite = reception_frite+"</table></div>";
				pla++;
				}
				reception_frite = reception_frite+"<a href=\"\" class=\"modif_profil\" onclick=\"touteffacerfrite("+id+"); return false;\">Tout effacer</a>"
						document.getElementById("reception_frite").innerHTML = reception_frite; 
						
					}
				
				}
				xhr.open("GET","afficher_frite.php",true);
				xhr.send(null);
			}
function effacerfrite(id, id_div){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
	
							afficherfritejquery();
							
						}
						
					}
				
				 xhr.open("POST",'effacer_frite.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); // On recupere la valeur de l'input ayant pour id: nserie 
				 xhr.send("id="+id); 
			}
function choix_frite(id, expediteur, nbfritemembre){
				var choix_frite = "";
				var choix_frite = "<h2 class=\"titre\"><a href=\"\" class=\"fermer_choix_frite\" onclick=\"hide_choix_frite(); return false;\"> x </a> Choix des frites </h2>";
				choix_frite = choix_frite+"<table class=\"choix_frite\"><tr><td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=frite.gif&id="+id+"'); return false;\"><img src=\"img/frites/frite.gif\"><br/>Choisir</a></td><td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=frites2.jpg&id="+id+"'); return false;\"><img src=\"img/frites/frites2.jpg\"><br/>Choisir</a></td><td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=I_Love_Fries.gif&id="+id+"'); return false;\"><img src=\"img/frites/I_Love_Fries.gif\"><br/>Choisir</a></td><td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=nyf.jpg&id="+id+"'); return false;\"><img src=\"img/frites/nyf.jpg\"><br/>Choisir</a></td></tr><tr>";
				if(nbfritemembre >= 10)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=4frite.gif&id="+id+"'); return false;\"><img src=\"img/frites/4frite.gif\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 20)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=frite3.png&id="+id+"'); return false;\"><img src=\"img/frites/frite3.png\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 30)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=barquette_frite.jpg&id="+id+"'); return false;\"><img src=\"img/frites/barquette_frite.jpg\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 40)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=mrfrite.gif&id="+id+"'); return false;\"><img src=\"img/frites/mrfrite.gif\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 60)
				{
				choix_frite = choix_frite+"</tr><tr><td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=LAFRITE.jpg&id="+id+"'); return false;\"><img src=\"img/frites/LAFRITE.jpg\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 70)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=fries70.gif&id="+id+"'); return false;\"><img src=\"img/frites/fries70.gif\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 80)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=fries80.jpg&id="+id+"'); return false;\"><img src=\"img/frites/fries80.jpg\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 90)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=JunkFoodFries.png&id="+id+"'); return false;\"><img src=\"img/frites/JunkFoodFries.png\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 110)
				{
				choix_frite = choix_frite+"</tr><tr><td><a href=\"\" onclick=\"envoyer_frite('choix_frite', 'traitement_frite.php?membre="+expediteur+"&frite=jolatefrfriteserveuri.png&id="+id+"'); return false;\"><img src=\"img/frites/jolatefrfriteserveuri.png\"><br/>Choisir</a></td>";
				}
				
				choix_frite = choix_frite+"</tr></table>";

				
						document.getElementById("choix_frite").innerHTML = choix_frite; 
						$("#choix_frite").fadeIn("slow");
					}
function choix_frite_membre(div, destinataire, nbfritemembre){
				var choix_frite = "";
				var choix_frite = "<h2 class=\"titre\">Choix des frites </h2>";
				choix_frite = choix_frite+"<table class=\"choix_frite_membre\"><tr><td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=frite.gif');   return false;\"><img src=\"img/frites/frite.gif\"><br/>Choisir</a></td><td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=frites2.jpg');  hide('"+div+"'); return false;\"><img src=\"img/frites/frites2.jpg\"><br/>Choisir</a></td><td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=I_Love_Fries.gif');   return false;\"><img src=\"img/frites/I_Love_Fries.gif\"><br/>Choisir</a></td><td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=nyf.jpg');  return false;\"><img src=\"img/frites/nyf.jpg\"><br/>Choisir</a></td></tr><tr>";
				if(nbfritemembre >= 10)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=4frite.gif'); return false;\"><img src=\"img/frites/4frite.gif\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 20)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=frite3.png');   return false;\"><img src=\"img/frites/frite3.png\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 30)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=barquette_frite.jpg'); return false; \"><img src=\"img/frites/barquette_frite.jpg\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 40)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=mrfrite.gif');   return false;\"><img src=\"img/frites/mrfrite.gif\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 60)
				{
				choix_frite = choix_frite+"</tr><tr><td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=LAFRITE.jpg');  return false;\"><img src=\"img/frites/LAFRITE.jpg\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 70)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=fries70.gif');   return false;\"><img src=\"img/frites/fries70.gif\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 80)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=fries80.jpg');   return false;\"><img src=\"img/frites/fries80.jpg\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 90)
				{
				choix_frite = choix_frite+"<td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=JunkFoodFries.png'); return false;\"><img src=\"img/frites/JunkFoodFries.png\"><br/>Choisir</a></td>";
				}
				if(nbfritemembre >= 110)
				{
				choix_frite = choix_frite+"</tr><tr><td><a href=\"\" onclick=\"envoyer_frite('"+div+"', 'traitement_frite.php?membre="+destinataire+"&frite=jolatefrfriteserveuri.png'); return false;\"><img src=\"img/frites/jolatefrfriteserveuri.png\"><br/>Choisir</a></td>";
				}
				
				
				choix_frite = choix_frite+"</tr></table>";

				
						document.getElementById(div).innerHTML = choix_frite; 
						$("#"+div+"").toggle("slow");
					}
function hide_choix_frite(){
    $("#choix_frite").hide("slow");
    
  }
function hide(div){
    $("#"+div+"").fadeOut("slow");
    
  }
function deselect_vote()
{
		document.getElementById("vote1").src = "img/vote.gif"; 
		document.getElementById("vote2").src = "img/vote.gif"; 
		document.getElementById("vote3").src = "img/vote.gif"; 
		document.getElementById("vote4").src = "img/vote.gif"; 
		document.getElementById("vote5").src = "img/vote.gif"; 
}
function afficher_vote(nom_video)
{
var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						
					
					 document.getElementById("infos_video").innerHTML = xhr.responseText; 
					 }
  
				}
				
					  xhr.open("POST",'afiche_vote.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); // On recupere la valeur de l'input ayant pour id: nserie 
				 xhr.send("nom_video="+nom_video); 
}
function vote(valeur, id)
{
	switch (valeur)
	{
	case '1':
		document.getElementById("vote1").src = "img/frite.gif"; 
		document.getElementById("vote2").src = "img/vote.gif"; 
		document.getElementById("vote3").src = "img/vote.gif"; 
		document.getElementById("vote4").src = "img/vote.gif"; 
		document.getElementById("vote5").src = "img/vote.gif"; 
		break;
	case '2':
		document.getElementById("vote1").src = "img/frite.gif"; 
		document.getElementById("vote2").src = "img/frite.gif"; 
		document.getElementById("vote3").src = "img/vote.gif"; 
		document.getElementById("vote4").src = "img/vote.gif"; 
		document.getElementById("vote5").src = "img/vote.gif"; 
		break;
	case '3':
		document.getElementById("vote1").src = "img/frite.gif"; 
		document.getElementById("vote2").src = "img/frite.gif"; 
		document.getElementById("vote3").src = "img/frite.gif"; 
		document.getElementById("vote4").src = "img/vote.gif"; 
		document.getElementById("vote5").src = "img/vote.gif"; 
		break;
	case '4':
		document.getElementById("vote1").src = "img/frite.gif"; 
		document.getElementById("vote2").src = "img/frite.gif"; 
		document.getElementById("vote3").src = "img/frite.gif"; 
		document.getElementById("vote4").src = "img/frite.gif"; 
		document.getElementById("vote5").src = "img/vote.gif"; 
		break;
	case '5':
		document.getElementById("vote1").src = "img/frite.gif"; 
		document.getElementById("vote2").src = "img/frite.gif"; 
		document.getElementById("vote3").src = "img/frite.gif"; 
		document.getElementById("vote4").src = "img/frite.gif"; 
		document.getElementById("vote5").src = "img/frite.gif"; 
		break;
	}
}
function envoyer_vote(nom_video, posteur, note){
var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						afficher_vote(nom_video);
					}
  
				}
				 xhr.open("POST",'envoyer_vote.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); // On recupere la valeur de l'input ayant pour id: nserie 
				 xhr.send("nom_video="+nom_video+"&posteur="+posteur+"&note="+note); 
			}
function envoyer_frite(div, url){
var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
					
				document.getElementById(""+div+"").innerHTML = xhr.responseText;
				setTimeout("hide('"+div+"')", 1500);
				if(div == 'choix_frite')
				{
				afficherfritejquery();
				}
					}
  
				}
				xhr.open("GET",""+url+"",true);
				xhr.send(null);
			}
function touteffacerfrite(id){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
							afficherfritejquery();
						}
						
					}
				
				 xhr.open("POST",'tout_effacer_frite.php',true); 
				 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); // On recupere la valeur de l'input ayant pour id: nserie 
				 xhr.send("id="+id); 
			}
function menuprofil(){
				var xhr = getXhr()
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						var reponse = xhr.responseXML.documentElement;
						var menu_profil = "";
						var pseudo = reponse.getElementsByTagName("pseudo")[0].firstChild.nodeValue;
						var statut = reponse.getElementsByTagName("statut")[0].firstChild.nodeValue;
						var message_non_lu = reponse.getElementsByTagName("message_non_lu")[0].firstChild.nodeValue;
						var frite = reponse.getElementsByTagName("frite")[0].firstChild.nodeValue;
						var nb_commentaire = reponse.getElementsByTagName("nb_commentaire")[0].firstChild.nodeValue;
						menu_profil = menu_profil+"<ol><li><a href=\"index.php\">Accueil</a></li><li><a href=\"fiche_membre.php?pseudo="+pseudo+"\">Mon compte</a></li><li><a href=\"membres.php\">Membres</a></li><li><a href=\"commentaire_reponse.php\">Commentaire";
						if(nb_commentaire != 0)
						{
						menu_profil = menu_profil+" ("+nb_commentaire+")";
						}
						menu_profil = menu_profil+"</a></li>";
						menu_profil = menu_profil+"<li><a href=\"boite_reception.php\">Boite de réception";
						if(message_non_lu != 0)
						{
						menu_profil = menu_profil+" ("+message_non_lu+")";
						}
						menu_profil = menu_profil+"</a></li>";
						menu_profil = menu_profil+"<li><a href=\"frite.php\">Frite";
						if (frite != 0)
							{
							menu_profil = menu_profil+"("+frite+")";
							}
						menu_profil = menu_profil+"</a></li>";
						menu_profil = menu_profil+"<li><a href=\"envoyer_frite.php\">Envoyer une frite</a></li>";
							if (statut == 'Admin')
							{
							menu_profil = menu_profil+"<li><a href=\"page_admin.php\">Page d'admin</a></li>";
							}
							if ((statut == 'cho') || (statut == 'Admin'))
							{
							
						menu_profil = menu_profil+"<li><a href=\"formulaire-denvoi.php\">Poster du contenu</a></li>";
							}
						menu_profil = menu_profil+"<li><a href=\"toutes_les_video.php\">Toutes les vidéos</a></li>";
						menu_profil = menu_profil+"<li><a href=\"http://www.jolatefri.com/jolatefri_rss.xml\">Souscrire <img src=\"img/rss.gif\"></a></li></ol>";
						}
						if(menu_profil)
						{
						document.getElementById("menu_profil").innerHTML = menu_profil; 
						}
					}
				
				xhr.open("GET",'menu_profil.php',true); 
				 xhr.send(null);
				 
			}
function affich_menu(div)
{
   $("#"+div+"").toggle("slow");
}
function cacher_menu_video()
{
     $("#menu_video").slideUp("slow");
}
function refresh()
				{
                        settimout('afficher()', 5000);
                }
function refresh2()
				{
                        settimeout('afficherarchive()', 5000);
                }
function ecrire_smiley(code)
{
    var message = document.getElementById('message').value;
    document.getElementById('message').value = message+code;
}