<?php
// infos pour le header
//img source
$image_source = "<link rel=\"image_src\" href=\"img/jolatefri.png\" />";
// titre
$titre = 'Postez du contenu sur Jolatefr !';
// mot clées
$mot_cle_head = "Humour, video, jolatefri, buzz, offtuc, drole, blague, fun, rire, gag, delire";
// description
$descriptionhead = "Retrouvez une sélection des videos, des photos, des jeux et des liens les plus marrants du web. Tout est présent sur jolatefri.com pour passer du bon temps et découvrir les buzz du web !";
// mise en place des categories
$requeteCategorie = "SELECT categorie.id, categorie.nomCategorie FROM jolatefr.categorie ORDER BY nomCategorie";
include ('connexion.php');
$sql[0] = mysql_query($requeteCategorie);
mysql_close();
while($line = mysql_fetch_array($sql[0])){
	$categorie[] = $line;
}
include('head.php');
?>
<script language="JavaScript">

function multi_upload() {
    d = document.getElementById("attDiv");
    
    iDiv = document.createElement("div");
 
    newAttach = document.createElement("input");
    newAttach.setAttribute("type","file");
    newAttach.setAttribute("name","fichier[]"); //notez les []
 
    iDiv.appendChild(newAttach);
 
    remLink = document.createElement("a");
    remLink.appendChild(document.createTextNode("Supprimer"));
    remLink.setAttribute("href","javascript:void(0)");
    remLink.setAttribute("onclick","remAttachment()");
    remLink.setAttribute("class","form1f");
             //ci dessous on est OBLIGE de mettre la fonction comme ça pour
             // des raisons de compatibilité IE...
    remLink.onclick=function(e){
            e=e||window.event;
 
                                      //taget = Ff   et srcElement = IE
            var theTarget = e.target || e.srcElement;
 
            child = theTarget.parentNode;    
            d = document.getElementById("attDiv");
            d.removeChild(child);        
        };
        
    iDiv.appendChild(remLink);
    d.insertBefore(iDiv,d.childNodes[0]);
}
</script>
<div id="contenuVideo">
<?php
 if (!isset($_SESSION['pseudo']))
 {
 exit("<p>Désolé mais vous ne pouvez pas accéder à  cette page</p>" );
 }
?>
		<h2 class="titre">Poster : <? echo $_SESSION['pseudo'];?></h2>
		
		
		<ul id="menu">
		<li class="menu0">
			<a href="#" id="_0" class="current" onclick="multiClass(this.id)" alt="menu1">Vidéo</a>
		</li>
		<li class="menu1">
			<a href="#" id="_1" class="ghost" onclick="multiClass(this.id)" alt="menu1">Image</a>
		</li>
		<li class="menu2">
			<a href="#" id="_2" class="ghost" onclick="multiClass(this.id)" alt="menu2">Jeux</a>
		</li>
		<li class="menu3">
			<a href="#" id="_3" class="ghost" onclick="multiClass(this.id)" alt="menu3">Site</a>
		</li>
		<? 
		 include 'connexion.php';
		$reponse3 = mysql_query("SELECT * FROM membres WHERE pseudo = '".$pseudo."'");
	$donnees3 = mysql_fetch_array($reponse3);
		if($donnees3['statut'] == 'Admin')
		{?>
		<li class="menu4">
			<a href="#" id="_4" class="ghost" onclick="multiClass(this.id)" alt="menu4">News</a>
		</li>
		<?}
		mysql_close();
		?>
	</ul>
	<div id="menu_0" class="on content">
		<ol>
<li class="categorie_video_poster"><a href="" onclick="affich_menu('dailymotion_post'); return false;">dailymotion ou autres</a></li>

    <div id="dailymotion_post">
		<table>
			<form action="traitement.php" method="post" enctype="multipart/form-data" id="form1">

				<INPUT type=hidden name="mode" value="dailymotion">

				<tr><td>code vidéo <object...object> (obligatoire)</td>
				<td><img src="img/code_dailymotion.png" width=380px><br/><textarea rows="10" cols="45" name="codeDailymotion" id="1"></textarea></td></tr>
				<tr><td>titre de la vidéo (obligatoire)</td>
				<td><input type="text" name="titre" id="2" /></td></tr>
				<tr><td>Description (obligatoire)</td>
				<td><textarea name="descr" rows="8" cols="45"></textarea></td></tr>
				<tr><td>Thème (obligatoire)</td>
				<td><select name="theme">
				<?php 
				foreach($categorie as $cat){
					echo "<option value=\"".$cat['id']."\">".$cat['nomCategorie']."</option>";
				}
				?>
				</select> </td></tr>
				<tr><td>Image (obligatoire jpg, png, gif) : </td>
				<td><input type="file" name="monfichier" /></td></tr>
				<tr><td>Mots-clés</td>
				<td><input type="text" name="motcle" id="2" /></td></tr>
				<tr><td><input type="submit" name="bouton_submit" value="Envoyer les infos"></td></tr>
				</form>  
			</table>
		</div>

  <li class="categorie_video_poster"><a href="" onclick="affich_menu('youtube_post'); return false;">youtube</a></li>

    <div id="youtube_post">

			<form action="traitement.php" method="post" enctype="multipart/form-data" id="form2">

				<INPUT type=hidden name="mode" value="youtube">
				<table>
				<tr><td></td><td><img src="img/code_youtube.png" width=300px></td></tr>
				<tr><td>code vidéo (obligatoire)</td>
				<td><input type="text" name="code"/></td></tr>
				<tr><td>titre de la vidéo (obligatoire)</td>
				<td><input type="text" name="titre" id="2" /></td></tr>
				<tr><td>Description (obligatoire)</td>
				<td><textarea name="descr" rows="8" cols="45"></textarea></td></tr>
				<tr><td>Thème (obligatoire)</td>
					<td><select name="theme">
					<?php 
					foreach($categorie as $cat){
						echo "<option value=\"".$cat['id']."\">".$cat['nomCategorie']."</option>";
					}
					?>
					</select> </td></tr>
				<tr><td>Image (taille inferieure à 30 Ko jpg, png, gif)  (obligatoire) : </td>
				<td><input type="file" name="monfichier" /></td></tr>
				<tr><td>Mots-clés</td>
				<td><input type="text" name="motcle" id="2" /></td></tr>
				<tr><td><input type="submit" name="bouton_submit" value="Envoyer les infos"></td></tr>
				</table>
</form>  

		</div>

    

  </div>

    </ol>
<div id="menu_1" class="off content">
				<form action="traitement.php" method="post" enctype="multipart/form-data">

				<INPUT type=hidden name="mode" value="image">
				<table>
				<tr><td>Titre de la Photo (obligatoire)</td>
				<td><input type="text" name="titre" id="2" /></td></tr>
				<tr><td>Description (obligatoire)</td>
				<td><textarea name="descr" rows="8" cols="45"></textarea></td></tr>
				<tr><td>Thème (obligatoire)</td>
					<td><select name="theme">
					<?php 
					foreach($categorie as $cat){
						echo "<option value=\"".$cat['id']."\">".$cat['nomCategorie']."</option>";
					}
					?>
					</select> </td></tr>
				<tr><td>Image (obligatoire jpg, png, gif) : </td>
				<td><div id="attDiv"><input type="file" name="fichier[]" /> <a href="javascript:void(0)" onClick="multi_upload(this)" class="form1">Ajoutez un Fichier</a></div></td></tr>
				<tr><td>Mots-clés</td>
				<td><input type="text" name="motcle" id="2" /></td></tr>
				<tr><td><input type="submit" name="bouton_submit" value="Envoyer les infos"></td></tr>
				</table>
</form>  

</div>
<div id="menu_2" class="off content">
<form action="traitement.php" method="post" enctype="multipart/form-data">

				<INPUT type=hidden name="mode" value="jeu_flash">
				<table>
				<tr><td>Titre du jeu (obligatoire)</td>
				<td><input type="text" name="titre"/></td></tr>
				<tr><td>Adress du sit ou se trouve le jeu (obligatoire)</td>
				<td><input type="text" name="lien" /></td></tr>
				<tr><td>Description du jeu (obligatoire)</td>
				<td><textarea name="descr" rows="8" cols="45"></textarea></td></tr>
				<tr><td>Thème (obligatoire)</td>
					<td><select name="theme">
					<?php 
					foreach($categorie as $cat){
						echo "<option value=\"".$cat['id']."\">".$cat['nomCategorie']."</option>";
					}
					?>
					</select> </td></tr>
				<tr><td>Image du jeu (obligatoire jpg, png, gif) : </td>
				<td><input type="file" name="monfichier" /></td></tr>
				<tr><td>Mots-clés</td>
				<td><input type="text" name="motcle" id="2" /></td></tr>
				<tr><td><input type="submit" name="bouton_submit" value="Envoyer les infos"></td></tr>
				</table>
</form>  
</div>
<div id="menu_3" class="off content">
	<form action="traitement.php" method="post" enctype="multipart/form-data">

				<INPUT type=hidden name="mode" value="site">
				<table>
				<tr><td>Titre du Site (obligatoire)</td>
				<td><input type="text" name="titre"/></td></tr>
				<tr><td>Adress du site (obligatoire)</td>
				<td><input type="text" name="lien" /></td></tr>
				<tr><td>Description du site (obligatoire)</td>
				<td><textarea name="descr" rows="8" cols="45"></textarea></td></tr>
				<tr><td>Thème (obligatoire)</td>
					<td><select name="theme">
					<?php 
					foreach($categorie as $cat){
						echo "<option value=\"".$cat['id']."\">".$cat['nomCategorie']."</option>";
					}
					?>
					</select> </td></tr>
				<tr><td>Image du site (obligatoire jpg, png, gif) : </td>
				<td><input type="file" name="monfichier" /></td></tr>
				<tr><td>Mots-clés</td>
				<td><input type="text" name="motcle" id="2" /></td></tr>
				<tr><td><input type="submit" name="bouton_submit" value="Envoyer les infos"></td></tr>
				</table>
</form>  
</div> 
<div id="menu_4" class="off content">
 <form action="traitement_news.php" method="post" enctype="multipart/form-data">

	 <p>News</p>
				    <label>
				    <textarea name="message" rows="5" cols="45">Votre message ici.</textarea>
				    </label>

				
				  <p><input type="submit" name="bouton_submit" value="Envoyer le Message"></p>
				  			 </form>
</div>
</div>
<div class="moduleDroite">
	<h2>Menu Profil</h2>
	<?
	include 'connexion.php';
	if (isset($_SESSION ['pseudo'] )) 
	{
		$titreUser = $_SESSION ['pseudo'];
		if($_SESSION['avatar'] == 0)
		{
			$imageAvatar = "invite.png";
		}
		else
		{
			$imageAvatar = "user_profile".$_SESSION['uid'].".png";
		}
		?>
		<div class="infoUser">
			<span>
				<img src="img/avatar/<?php echo $imageAvatar;?>" width="100px" class="avatar_img">
				<p><?php echo $_SESSION ['pseudo'];?></p>
			</span>
			<span id="menu_profil">
			</span>
		</div>
		<script type="text/javascript">
		menuprofil();
		setInterval('menuprofil()', 10300);
		</script>
		<?
	} 
	else{
	?>
		
		<h4>Bienvenu sur Jolatefri.com</h4>
		<ul>
			<li>
				<a href="jolatefri_rss.xml">Nous suivre <img src="img/rss.gif" alt="Flux RSS" title="Flux RSS"></a>
			</li>
			<li>
				<a href="inscription.php">S'inscrire</a>
			</li>
		</ul>
		<?php
	}
	?>
</div>
<?php
if (isset($_SESSION ['pseudo'] )) 
{
?>
<div class="moduleDroite">
	<h2>Chat</h2>
	<form class="formChat" action="" onsubmit="envoyerchat(); return false;">
		<input type="text" size="39" maxlength="100" name="message" id="message" value="message" onFocus="javascript: effacer('message', 'message');" onBlur="javascript: reecrire('message', 'message');" /> 
		<input type="submit" name="submit" value="Envoyer" />
	</form>
	<div id="chat"></div>
	<script type="text/javascript">
		afficher();
		setInterval('afficher()', 5000);
	</script>
</div>
<?php
}
?>

<?

include('foot.php');
?>