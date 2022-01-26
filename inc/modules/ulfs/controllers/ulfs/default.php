<?php
class defaultController extends Controller{
	function defaultAct(){
global $db;
$sql="select id, `release` from releases";
$db->execute($sql);
$x=$db->dataset;
$releases=array();


echo "Select release: ";
foreach($x as $v){
echo "<a href=".$this->yaps->config['site_path']."/ulfs/release/".$v['release'].">".$v['release']."</a>";
}


//		echo "tasty";
	}

function releaseAct(){
$release=$this->request['release'];

echo "<li><a href=".$this->yaps->config['site_path']."/ulfs/release/".$release."/packages/>Packages</a>";
echo "<li><a href=".$this->yaps->config['site_path']."/ulfs/release/".$release."/patches/>Patches</a>";
echo "<li><a href=".$this->yaps->config['site_path']."/ulfs/release/".$release."/addons/>Addons</a>";

}


function packagesAct(){
$release=$this->request['release'];

echo $release;
}

function patchesAct(){
$release=$this->request['release'];

echo $release;
}


function addonsAct(){
$release=$this->request['release'];

echo $release;
}




}
