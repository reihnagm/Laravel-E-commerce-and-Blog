<?php 

function presentPrice($price) 
{

     return money_format($price / 100, 2);

}

