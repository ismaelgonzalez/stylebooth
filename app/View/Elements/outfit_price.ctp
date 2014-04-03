<?php
$outfit_price = $this->requestAction('/outfits/getOutfitTotalPrice/' . $id);
echo $this->Number->currency($outfit_price, 'USD');
