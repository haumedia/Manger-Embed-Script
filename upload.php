<?php 

header('Content-Type: application/json');
$outData = upload();
echo json_encode($outData);
exit();

function upload() {
    $preview = $config = $errors = [];
    $input = 'subFile';
    if (empty($_FILES[$input])) {
        return [];
    };

    $total = count($_FILES[$input]['name']);

    $path = 'files/';

    for ($i = 0; $i < $total; $i++) {

        $tmpFilePath = $_FILES[$input]['tmp_name'][$i];

        $fileName = $_FILES[$input]['name'][$i];

        $fileName = str_replace( array(' ', '_.', '._', '-', '..'), '.', $fileName);

        $fileName = str_replace( '..', '.', $fileName);

        $fileSize = $_FILES[$input]['size'][$i];
        
        if ($tmpFilePath != ""){
           
            $newFilePath = $path . $fileName;

            $domainServer = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);

            $newFileUrl = $domainServer . '/files/' . $fileName;
            
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $fileId = time() . '.' . $fileName . $i;
                $preview[] = $newFileUrl;
                $config[] = [
                    'key' => $fileId,
                    'caption' => $fileName,
                    'size' => $fileSize,
                    'downloadUrl' => $newFileUrl,
                    //'url' => 'delete.php',
                ];
            } else {
                $errors[] = $fileName;
            }
        } else {
            $errors[] = $fileName;
        }
    }
    $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
    if (!empty($errors)) {
        $img = count($errors) === 1 ? 'file "' . $error[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
        $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
    }
    return $out;
}


?>