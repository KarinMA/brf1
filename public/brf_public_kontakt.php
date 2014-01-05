<h4>Kontaktinformation</h4>
<br />
<p class="centertext"><strong>Adress</strong><br />
<?php echo "BRF " . $oBrf->getName(); ?><br />
<?php echo $oBrf->getAddress(); ?><?php if ($oBrf->getStreetNumber()): ?> <?php echo $oBrf->getStreetNumber(); ?><?php endif; ?><?php if ($oBrf->getCoAddress()): ?> C/o <?php echo $oBrf->getCoAddress(); ?><?php endif; ?><br />
<?php echo $oBrf->getZip() . ' ' . $oBrf->getPostalAddress(); ?>
</p> 
<?php //include './brf_public_icons.php'; ?>