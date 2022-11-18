<?php
class cleaner
{
    public static function cleanFileName($file_name)
    {
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name_str = pathinfo($file_name, PATHINFO_FILENAME);

        // Replaces all spaces with hyphens. 
        $file_name_str = str_replace(' ', '-', $file_name_str);

        $file_name_str = self::removeSpecialChars($file_name_str);

        // Removes persistent special chars. 
        $file_name_str = preg_replace('/[^A-Za-z0-9\-\_]/', '', $file_name_str);

        // Replaces multiple hyphens with single one. 
        $file_name_str = preg_replace('/-+/', '-', $file_name_str);

        $clean_file_name = $file_name_str . '.' . $file_ext;

        return $clean_file_name;
    }
    public static function cleanName($file_name)
    {
        $file_name_str = pathinfo($file_name, PATHINFO_FILENAME);

        // Replaces all spaces with hyphens. 
        $file_name_str = str_replace(' ', '-', $file_name_str);

        $file_name_str = self::removeSpecialChars($file_name_str);

        // Removes persistent special chars. 
        $file_name_str = preg_replace('/[^A-Za-z0-9\-\_]/', '', $file_name_str);

        // Replaces multiple hyphens with single one. 
        $clean_file_name = preg_replace('/-+/', '-', $file_name_str);

        return $clean_file_name;
    }
    public static function cleanURL($file_name)
    {

        // Replaces all spaces with hyphens. 
        $file_name_str = str_replace(' ', '-', $file_name);

        $file_name_str = self::removeSpecialChars($file_name_str);


        $file_name_str = preg_replace('/[.,]/', '-', $file_name_str);

        // Removes persistent special chars. 
        $file_name_str = preg_replace('/[^A-Za-z0-9\-\_]/', '-', $file_name_str);

        // Replaces multiple hyphens with single one. 
        $file_name_str = preg_replace('/-+/', '-', $file_name_str);
        
        // $file_name_str = preg_replace('/-+/', '-', $file_name_str);
        // $clean_file_name = $file_name_str;

        // Replaces last hyphen
        $pos = strrpos($file_name_str, "-");
        if ($pos !== false) {
            $clean_file_name = substr($file_name_str, 0, $pos);
        }

        return $clean_file_name;
    }

    public static function removeSpecialChars($str)
    {
        // Removes special chars. 
        $unwanted_chars = array(
            'Š' => 'S',
            'š' => 's',
            'Ž' => 'Z',
            'ž' => 'z',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y'
        );
        $str = strtr($str, $unwanted_chars);
        return $str;
    }
    
}
