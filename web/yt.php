<?php
$clientLibraryPath = '/library';
$oldPath = set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);

require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_YouTube'); 
Zend_Loader::loadClass('Zend_Uri_Http');

$sessionToken = '[whatever this is]';
$developerKey = '[whatever this is]';

$httpClient = new Zend_Gdata_HttpClient();
$httpClient->setAuthSubToken($sessionToken);

$yt = new Zend_Gdata_YouTube($httpClient, '23', '234', $developerKey);

$myVideoEntry = new Zend_Gdata_YouTube_VideoEntry();

$file= '../path_to_file/filename.mp4';
$file = realpath($file);  

$filesource = $yt->newMediaFileSource($file); 
$filesource->setContentType('video/mp4'); 
$filesource->setSlug($file);  
$myVideoEntry->setMediaSource($filesource);  
$myVideoEntry->setVideoTitle('My Test Movie'); 
$myVideoEntry->setVideoDescription('My Test Movie'); 

$myVideoEntry->setVideoCategory('Entertainment');  
$myVideoEntry->SetVideoTags('testme');  
$myVideoEntry->setVideoDeveloperTags(array('tester', 'test'));  

$uploadUrl = 'http://uploads.gdata.youtube.com/feeds/api/users/default/uploads';  


try {  

    $newEntry = $yt->insertEntry($myVideoEntry, $uploadUrl, 'Zend_Gdata_YouTube_VideoEntry'); 

} catch (Zend_Gdata_App_HttpException $httpException) {   

    echo $httpException->getRawResponseBody();

} catch (Zend_Gdata_App_Exception $e) {

    echo $e->getMessage();

}

?>
