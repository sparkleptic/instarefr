<div id="primary" class="content-area container" role="main">
<h1>Company List</h1>
<?php
function compareByName($a, $b) {
  return strcmp($a->insta_company_name, $b->insta_company_name);
}
usort($company_list, 'compareByName'); 
//echo "<pre>";
if(!empty($company_list)) {
$big_alphas = range('A', 'Z');
// $small_alphas = range('a', 'z');
foreach($big_alphas as $char)
{
	echo "<a href='#".$char."'><span>".$char."</span></a>&nbsp&nbsp&nbsp&nbsp";
} 
echo "<br>";
 $i=0;
foreach($company_list as $val)
{ 
	$first_char = $val->insta_company_name[0];
	if($i==0)
	{
		$i++;
		$check_char = $first_char;
		echo "<h2 id='".strtoupper($val->insta_company_name[0])."'>".$val->insta_company_name[0]."</h2>";
	}
	else if($first_char !=  $check_char)
	{
		$check_char = $first_char;
		echo "<h2 id='".strtoupper($val->insta_company_name[0])."'>".$val->insta_company_name[0]."</h2>";
	}
	
    echo "<a href='".base_url()."company-jobs/".$val->insta_company_id."/".$val->insta_company_name."/'>".$val->insta_company_name."</a><br>";
}
}

?>
</div>