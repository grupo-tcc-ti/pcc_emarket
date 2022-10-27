<?php
class Image {
    protected static $instance;
    protected static $path_valid, $size_valid, $upload_valid = false;
    public static function AddProces($files_img = []) {
        try {
        //Image handling procedure starts --------->
        // $name_valid = $path_valid = $size_valid = $upload_valid = false;
        $path_valid = $size_valid = $upload_valid = false;
        $prod_path = "../image/produtos_teste/";
        $image = [];
        $files_img = array_filter($files_img);

        if (isset($files_img)){
            $image_error = $files_img['error'];
            foreach ($image_error as $image_error){
                if ($image_error == 0 ) {
                    $upload_valid = true;
                    // echo ':upload_valid; '; //debug
                    
                }
                else if($image_error == 4){
                    $upload_valid = true;
                    $path_valid = true;
                    $size_valid = true;
                }
                else if ($image_error != 0 ) {
                    // echo ':upload_invalid; '; //debug
                    $mensagem[] = 'Ocorreu um erro ao enviar os arquivos de imagem!';
                }
            }
            
            if (count($files_img['name']) > 1 && $upload_valid){
                // echo ':isarray; '; //debug
                // print_r($prod_path.$files_img['name'][1].':ispath'."\n"); //debug
                //Loop através da array image
                for ($i = 0; $i < count($files_img['name']); $i++) {
                    // echo ':isforeach; '; //debug
                    $image[$i] = $prod_path.$files_img['name'][$i]; //O nome original do arquivo na máquina do cliente.
                    $image[$i] = filter_var($image[$i], FILTER_SANITIZE_FULL_SPECIAL_CHARS); //filtrar processo de arquivos e caracteres especiais
                    //O caminho temporario do arquivos é armazenado
                    //tmp_name O nome temporário com o qual o arquivo enviado foi armazenado no servidor.
                    $image_tmp = $files_img['tmp_name'][$i];
                    //Verifica se caminho vazio
                    if ($image_tmp != "") {
                        //Configura novo caminho
                        $image_folder = $prod_path . $files_img['name'][$i];
                        //O arquivo e enviado ao caminho temporario
                        if (move_uploaded_file($image_tmp, $image_folder)) {
                            $path_valid = true;
                            // echo $size_valid.':arrayimg_path; '; //debug
                        }
                    }
                    //Verifica o tamanho do arquivo
                    $image_size = $files_img['size'][$i]; //O tamanho, em bytes, do arquivo enviado.
                    if ($image_size > 2000000) {
                        $mensagem[] = 'Tamanho do arquivo é maior que o permitido!';
                        $size_valid = false;
                    } else { $size_valid = true; 
                        // echo $size_valid.':arrayimg_size; '; //debug
                    }
                }
            // } else if (!is_array($files_img) && $upload_valid){
            } else if (count($files_img['name']) == 1 && implode($files_img['error']) != 4) {
                // echo ':isstring'; //debug
                $img_name = implode($files_img['name']);
                $image = $prod_path.$img_name;
                $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $image_tmp = implode($files_img['tmp_name']);
                if ($image_tmp != "") {
                    //Configura novo caminho
                    $image_folder = $prod_path . $img_name;
                    //O arquivo e enviado ao caminho temporario
                    if (move_uploaded_file($image_tmp, $image_folder)) {
                        $path_valid = true;
                        // echo $size_valid.':singleimg_path; '; //debug
                    }
                }
                //Verifica o tamanho do arquivo
                if (implode($files_img['size']) > 2000000) { //O tamanho, em bytes, do arquivo enviado.
                    $mensagem[] = 'Tamanho do arquivo é maior que o permitido!';
                    $size_valid = false;
                } else { $size_valid = true;
                    // echo $size_valid.':singleimg_size; '; //debug
                }
                
            }
        }
        self::$path_valid = $path_valid;
        self::$size_valid = $size_valid;
        self::$upload_valid = $upload_valid;
        // var_dump($image);
        return $image;
        //Image handling procedure ends--------->
        
        // var_dump($codProduto); //debug
        // echo $name_valid.':last_name; '; //debug
        // echo $path_valid.':last_path; '; //debug
        // echo $size_valid.':last_size; '; //debug
        // echo $upload_valid.':last_upload; '; //debug
        } catch (PDOException $msg) {
            echo $msg->getMessage();
        }
    }
    public static function Validate() {

        if (self::$path_valid && self::$size_valid && self::$upload_valid) {
            self::$path_valid=  false;
            self::$size_valid =  false;
            self::$upload_valid =  false;
            return true;
        }
    }
}

?>