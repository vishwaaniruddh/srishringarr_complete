<?php
function to_currency($number)
{
	if($number >= 0)
	{
		return 'Rs'.number_format($number, 2, '.', '');
    }
    else
    {
    	return '-Rs'.number_format(abs($number), 2, '.', '');
    }
}


function to_currency_no_money($number)
{
	return number_format($number, 2, '.', '');
}
?>