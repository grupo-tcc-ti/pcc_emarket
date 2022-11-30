<?php
class Message
{
    // protected static $mensagem = [];
    protected static $mensagem;

    public static function pop($mensagem = 'Hello World!')
    {
        self::$mensagem = array($mensagem);
        if (isset(self::$mensagem)) {
            foreach (self::$mensagem as $mensagem) {
                sleep(.4);
                echo '
                <div class="mensagem">
                <span>' . $mensagem . '</span>
                <svg class="fas fa-times" onclick="this.parentElement.remove();"></svg>
                </div>
                ';
                sleep(1);
            }
        }
    }

}
?>