<?php
include_once("../config/config.php");
if(!empty($_POST["keyword"])):
$sql = "SELECT * FROM produit WHERE titre LIKE '%".$_POST["keyword"]."%' LIMIT 20";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)<>0) {
	?>
	<ul id="country-list">
	<?php
		foreach($result as $row) {
		?>
			<li onClick="selectCountry('<?php echo  utf8_encode($row["titre"]);?>');"><?php echo  utf8_encode($row["titre"]);?></li>
		<?php } ?>
	<?php }else{ ?>
		<ul id="country-list">
			<li>Aucun Résultat Trouvé</li>
		</ul>
	<?php }?>
	<?php endif?>
